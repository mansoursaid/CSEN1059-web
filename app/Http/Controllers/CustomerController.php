<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Validator;
use Response;
use Redirect;
use Session;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'email|unique:customers',
        ]);
        if ($validator->fails()) {
            return redirect()->action('CustomerController@create')->withErrors($validator);
        }
        if (!$request->has('phone_number') && !$request->has('twitter_handle')) {
            return redirect()->action('CustomerController@create')->withErrors([
                'Please enter either twitter handle or phone number']);
        } else {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'numeric|unique:customers',
                'twitter_handle' => 'regex:(@[a-zA-z0-9])|unique:customers'
            ]);
            if ($validator->fails()) {
                return redirect()->action('CustomerController@create')->withErrors($validator);
            }
        }
        $customer = new Customer($request->all());
        if ($customer->save()) {
            Session::flash('success', 'Created successfully');
            return redirect()->action('CustomerController@index');
        } else {
            return redirect()->action('CustomerController@create')->withErrors(['Failed']);
        }
    }

    public function destroy(Customer $customers)
    {
        return $customers->delete();
    }

    public function edit(Customer $customers)
    {
        if ($customers->twitter_handle != null) {
            $identifier = 'twitter handle';
            $identifierValue = $customers->twitter_handle;
        } else {
            $identifier = 'phone number';
            $identifierValue = $customers->phone_number;
        }
        return view('customers.edit', compact('customers', 'identifier', 'identifierValue'));
    }

    public function update(Request $request, Customer $customers)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'min:3',
            'email' => 'email|unique:customers,email,'. $customers->id,
            'phone_number' => 'numeric|unique:customers,phone_number,'.$customers->id,
            'twitter_handle' => 'regex:(@[a-zA-z0-9])|unique:customers,twitter_handle,'.$customers->id
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages());
            return redirect()->action('CustomerController@edit', [$customers->id])->withErrors($validator);
        }
        if ($customers->update($request->all())) {
            Session::flash('success', 'Edited successfully');
            return redirect()->action('CustomerController@edit', [$customers->id]);
        } else {
            return redirect()->action('CustomerController@edit', [$customers->id])->withErrors(['Failed']);
        }
    }
}
