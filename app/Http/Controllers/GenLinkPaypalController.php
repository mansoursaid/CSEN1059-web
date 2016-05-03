<?php

namespace App\Http\Controllers;

use App\PaypalConfig;
use Illuminate\Http\Request;

use App\Http\Requests;

use Mockery\CountValidator\Exception;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\Amount;
use PayPal\Api\ItemList;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use Illuminate\Support\Facades\Input;

class GenLinkPaypalController extends Controller
{
    //

    public function create() {
        return view('paypal.create');
    }

    public function store(Request $request) {
//        dd($request);
        $paypal = new ApiContext(new OAuthTokenCredential(PaypalConfig::getClientID(), PaypalConfig::getSecretKey()));

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $price = Input::get('price');
        $quantity = Input::get('quantity');
        $currency = Input::get('currency');
        $name = Input::get('name');

//        dd($quantity * $price);

        $item1 = new Item();
        $item1->setName($name)
            ->setCurrency($currency)
            ->setQuantity($quantity)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($quantity * $price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Pay for premium service")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:8000/paypal?success=true")
            ->setCancelUrl("http://localhost:8000/paypal?success=false");

        $payment = new Payment();
        $payment->setIntent("order")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try{

            $payment->create($paypal);
//            dd('hello');
        }catch (\PayPal\Exception\PayPalConnectionException $ex) {
//            echo $ex->getCode(); // Prints the Error Code
//            echo $ex->getData(); // Prints the detailed error message
//            die($ex);
            return response()->json([
                'message' => 'Try again',
            ], 404);
        } catch (\Exception $ex) {
//            die($ex);
            return response()->json([
                'message' => 'Try again',
            ], 404);
        }

        $approvalUrl = $payment->getApprovalLink();

//        return $approvalUrl;
        return response()->json(['link' => $approvalUrl]);


    }


    public function handleTransaction() {
        if (!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])) {
            echo "Something is wrong";
        } else {
            if ((bool)$_GET['success'] == false) {
                echo "The request is cancelled";
            } else {
                $paypal = new ApiContext(new OAuthTokenCredential(PaypalConfig::getClientID(), PaypalConfig::getSecretKey()));
                $paymentId = $_GET['paymentId'];
                $PayerID = $_GET['PayerID'];

                $payment = Payment::get($paymentId, $paypal);

                $execute = new PaymentExecution();
                $execute->setPayerId($PayerID);

                try {
                    $result = $payment->execute($execute, $paypal);
                } catch(Exception $e) {
                    echo "Error : ".$e;
                }
                echo "Executed!";
            }
        }


    }




}
