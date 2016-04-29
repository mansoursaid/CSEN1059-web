<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TwitterFunctions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return $tickets;
    }

    public function show($id)
    {

        try {
            $ticket = Ticket::findOrfail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }


        $admins = \App\User::ofType(0)->get();
        $supportSupervisors = \App\User::ofType(1)->get();
        $supportAgents = \App\User::ofType(10)->get();


        $assignedToUser = $ticket->with('assigned_to')->first();


        if (Cache::has('conv'."-".$ticket->tweet_id))
        {
            $conversation = Cache::get('conv'."-".$ticket->tweet_id);

        } else {
            $conversation = TwitterFunctions::getConversation($ticket->tweet_id);
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::add('conv'."-".$ticket->tweet_id, $conversation, $expiresAt);
        }

       // $conversation = array_reverse($conversation);



        return view('tickets.show', compact('ticket', 'conversation', 'admins', 'supportSupervisors', 'supportAgents', 'assignedToUser'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
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
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrfail($id);
        return view('tickets.edit')->with('ticket', $ticket);
    }

    public function update($id)
    {
        $ticket = Ticket::findOrfail($id);
        $ticket->status = Input::get('status');
        $ticket->save();
        return $ticket;
    }
}
