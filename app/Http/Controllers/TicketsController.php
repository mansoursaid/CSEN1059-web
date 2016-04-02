<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

use App\Http\Requests;

class TicketsController extends Controller
{
    public function index(){
        $tickets = Ticket::all();
        return $tickets;
    }

    public function show($id){
        $ticket = Ticket::find($id);
        return $ticket;
    }

    /*public function create(){

    }*/

    public function store(Request $request){
        $rules = array(
                'tweet_id' => 'required',
                'premium'  => 'required',
                'urgency'  => 'required'
            );

        $validator = Validator::make(Input::all(), $rules);

        if (!$validator->fails()) {
            $ticket = new Ticket;
            $ticket->tweet_id = Input::get('tweet_id');
            $ticket->premium    = Input::get('premium');
            $ticket->urgency = Input::get('urgency');
            $ticket->save();
        }

    }


}
