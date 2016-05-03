<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Ticket;
use App\TwitterFunctions;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Redirect;
use App\MailNotification;
use App\NotificationHandler;

class TicketsController extends Controller
{


    public function index()
    {

        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {

        try {
            $ticket = Ticket::findOrfail($id);
//            return $ticket;
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }


        if (Cache::has('conv' . "-" . $ticket->tweet_id)) {
            $conversation = Cache::get('conv' . "-" . $ticket->tweet_id);

        } else {
            $conversation = TwitterFunctions::getConversation($ticket->tweet_id);
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::add('conv' . "-" . $ticket->tweet_id, $conversation, $expiresAt);
        }

        // $conversation = array_reverse($conversation);


        try {

            $temp = $conversation->errors;

            Cache::forget('conv' . "-" . $ticket->tweet_id);

            return view('errors.api.error.rate.limit.exceed');

        } catch (\Exception $e) {

            $admins = \App\User::ofType(0)->get();
            $supportSupervisors = \App\User::ofType(1)->get();
            $supportAgents = \App\User::ofType(10)->get();
            try {
                $assignedToUser = User::findOrFail($ticket->assigned_to);
            } catch (ModelNotFoundException $e) {
                return view('errors.404');
            }
            return view('tickets.show', compact('ticket', 'conversation', 'admins', 'supportSupervisors', 'supportAgents', 'assignedToUser'));
        }


        return view('tickets.show', compact('ticket', 'conversation', 'admins', 'supportSupervisors', 'supportAgents', 'assignedToUser'));
    }

    public function create()
    {
        return view('tickets.create');
    }


    public function store(Request $request)
    {

        if (Input::get('online') == null) {
            $rules = array(
                'tweet_id' => 'required',
                'premium' => 'required',
                'urgency' => 'required',
                'opened_by' => 'required',
                'assigned_to' => 'required',
                'customer_id' => 'required'


            );


            $this->validate($request, $rules);
            $ticket = new Ticket;
            $ticket->tweet_id = Input::get('tweet_id');
            $ticket->premium = Input::get('premium');
            $ticket->urgency = Input::get('urgency');
            $ticket->opened_by = Input::get('opened_by');
            $ticket->assigned_to = Input::get('assigned_to');
            $ticket->customer_id = Input::get('customer_id');
            $ticket->status = Input::get('status');
            $ticket->save();
            return $ticket;

        } else {


            $rules = array(
                'tweet_id' => 'required',
                'assigned_to' => 'required',
                'tweet_handle' => 'required',
                'status' => 'required',
                'urgency' => 'required',
                'premium' => 'required'
            );

//            dd(Input::get());

            $this->validate($request, $rules);

            $customers = Customer::where('twitter_handle', Input::get('tweet_handle'));
            if ($customers == null || $customers->count() == 0) {
                $customer = new Customer();
                $customer->twitter_handle = Input::get('tweet_handle');
                $customer->email = 'temp'.Carbon::now();
                $customer->save();
            }
            else {
                $customer = $customers->first();
            }


            $ticket = new Ticket;
            $ticket->tweet_id = Input::get('tweet_id');
            $user = Auth::user();
            $ticket->opened_by = $user->id;
            $ticket->assigned_to = Input::get('assigned_to');
            $ticket->customer_id = $customer->id; // will be changed later
            $ticket->status = Input::get('status'); // will be changed later
            $ticket->urgency = Input::get('urgency'); // will be changed later
            $ticket->premium = Input::get('premium');
            $ticket->save();
            try {
                $user = User::findOrFail($ticket->assigned_to);
                NotificationHandler::makeNotification($user, $ticket);
            } catch(ModelNotFoundException $e) {
                Session::flash('error', $e->getMessage());
            } catch(\Exception $e) {
                Session::flash('error', $e->getMessage());
            }

            return redirect()->action('TicketsController@show', [$ticket->id]);


        }


    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }


    public function edit($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            return view('tickets.edit')->with('ticket', $ticket);
        } catch (ModelNotFoundException $ex) {
            return view('errors.404');
        }

    }

    public function update($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->status = Input::get('status');
            $ticket->save();

            $user = User::findOrFail($ticket->assigned_to);
            NotificationHandler::makeNotification($user, $ticket);

            return Redirect::back();
        } catch (ModelNotFoundException $ex) {
            return view('errors.404');
        }

    }

    /*public function deleteStatus($id){
        $ticket = get_ticket($id);
        $ticket->status = 0;
        $ticket->save();
        return $ticket;

    }




    }*/


}
