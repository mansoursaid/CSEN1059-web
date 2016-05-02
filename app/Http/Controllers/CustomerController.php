<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Validator;
use Response;

class CustomerController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(){
        return Customer::all();
    }

    public function show(Customer $customer){
        return $customer;
    }

    public function create(){
        //return customer create view
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:customers',
        ]);
        if($validator->fails()){
            return Response::make($validator->messages(), 400);
        }
        if(!$request->has('phone_number') && !$request->has('twitter_handle')){
            return Response::make('Please enter either phone number or twitter handle', 400);
        }else{
            $validator = Validator::make($request->all(),[
               'phone_number' => 'numeric',
                'twitter_handle' => 'regex:(@[a-zA-z0-9])'
            ]);
            if($validator->fails())
                return Response::make($validator->messages(), 400);
        }
        $customer = new Customer($request->all());
        if($customer->save())
            return Response::make($customer, 200);
        else
            return Response::make([], 400);
    }

    public function destroy(Customer $customer){
        return $customer->delete();
    }

    public function edit(){
        //return edit customer view
    }

    public function update(Request $request, Customer $customer){
        $validator = Validator::make($request->all(), [
            'name' => 'min:3',
            'email' => 'email|unique:customers',
            'phone_number' => 'numeric',
            'twitter_handle' => 'regex:(@[a-zA-z0-9])'
        ]);
        if($validator->fails()){
            return Response::make($validator->messages(), 400);
        }
        if($customer->update($request->all()))
            return Response::make($customer, 200);
        else
            return Response::make([], 400);
    }
}
