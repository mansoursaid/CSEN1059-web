<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Ticket_User;
use App\User;
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

    public function getTicketsPerAgent(){
        $users = User::all();
        $allTickets = array();
        $status1 = 0;
        $status2 = 0;
        $status3 = 0;
        foreach ($users as $user){
            $id = $user->id;
            $name = $user->name;
            $tickets = Ticket_User::where('user_id', $id)->get();
            foreach ($tickets as $ticket){
                $status = $ticket->status;
                if($status == 0){
                    $status1++;
                }else if($status == 1){
                    $status2++;
                }else{
                    $status3++;
                }
            }
            #$tmp = array($name => sizeof($tickets));
            $tmp = array($name => array('status1' => $status1 ,'status2' => $status2 ,'status3' => $status3 ));
            $allTickets[] = $tmp;
        }
        return $allTickets;
    }
}
