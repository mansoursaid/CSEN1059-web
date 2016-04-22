<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TicketsController extends Controller
{
    public function index(){
        $tickets = Ticket::all();
        return $tickets;
    }

    public function show($id){
        $ticket = Ticket::findOrfail($id);
        return $ticket;
    }

    public function create(){
        return view('tickets.create');
    }

    public function store(Request $request){
       $rules = array(
                'tweet_id' => 'required',
                'premium'  => 'required',
                'urgency'  => 'required',
                'opened_by'=> 'required',
                'assigned_to'=>'required',
                'customer_id'=>'required'

            );

        $this->validate($request,$rules);
        $ticket = new Ticket;
        $ticket->tweet_id = Input::get('tweet_id');
        $ticket->premium    = Input::get('premium');
        $ticket->urgency = Input::get('urgency');
        $ticket->opened_by = Input::get('opened_by');
        $ticket->assigned_to = Input::get('assigned_to');
        $ticket->customer_id = Input::get('customer_id');
        $ticket->status = Input::get('status');
        $ticket->save();
        return $ticket;
    }

    public function destroy(Ticket $ticket){
        $ticket->delete();
    }

    public function edit($id){
        $ticket = Ticket::findOrfail($id);
        return view('tickets.edit')->with('ticket',$ticket);
    }

    public function update($id){
        $ticket = Ticket::findOrfail($id);
        $ticket->status = Input::get('status');
        $ticket->save();
        return $ticket;
    }
    public function deleteStatus($id){
        $ticket = Ticket::findOrfail($id);
        $ticket->status = 0;
        $ticket->save();
        return $ticket;
    }
    
}
