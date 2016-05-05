<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Ticket;
use App\TwitterFunctions;
use App\User;
use App\Ticket_User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Mockery\CountValidator\Exception;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Redirect;
use App\MailNotification;
use App\NotificationHandler;

class TicketsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('toShowTicket', ['only' => ['show']]);
    }

    public function index()
    {

        $myTickets = Ticket::where('assigned_to', Auth::id())->where('status', '<', 2)->get();

        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets', 'myTickets'));
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


            return view('errors.api_error_rate_limit_exceed');

        } catch (\Exception $e) {

            $groupedTickets = \App\Ticket::where('status', '<', 2);

            $admins = \App\User::ofType(0)->get();
            $supportSupervisors2 = \App\User::ofType(1)->get();
            $supportAgents2 = \App\User::ofType(10)->get();

//            $admins = [];
            $supportAgents = [];
            $supportSupervisors = [];

//            foreach($admins2 as $admin) {
//                $assignedTickets = $groupedTickets->where('assigned_to', $admin->id)->count();
//                if ($assignedTickets < 3) {
//                    array_push($admins, $admin);
//                }
//            }


            foreach($supportSupervisors2 as $supportSupervisor) {
                $assignedTickets = $groupedTickets->where('assigned_to', $supportSupervisor->id)->get()->count();
                if ($assignedTickets < 3) {
                    array_push($supportSupervisors, $supportSupervisor);
                }
            }


            foreach($supportAgents2 as $supportAgent) {
                $assignedTickets = $groupedTickets->where('assigned_to', $supportAgent->id)->get()->count();
                if ($assignedTickets < 3) {
                    array_push($supportAgents, $supportAgent);
                }
            }
            
            $assignedToUser = null;
            try {
                if ($ticket->assigned_to != null) {
                    $assignedToUser = User::findOrFail($ticket->assigned_to);
                }
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

            $assignedTo = Input::get('assigned_to');
            try {
                if (intval($assignedTo) > 0) {
                    $userAssigned = \App\User::findOrFail($assignedTo);
                    if ($userAssigned->type != 0) {

                        $ticketsNotClosedForUser = \App\Ticket::where('assigned_to', $assignedTo)->where('status', '<', 2)->get();
                        if ($ticketsNotClosedForUser->count() >= 3) {
                            $request->session()->flash('error', 'This user has been assigned to 3 tickets or more.');
                            return response()->json('This user can not be assigned to the ticket', 422);
                        }
                    }
                }
            } catch(ModelNotFoundException $e) {
                return response()->json('This user can not be assigned to the ticket', 422);
            } catch(\Exception $e) {
                return response()->json('Error', 422);
            }


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
            if (intval($assignedTo >= 1)) {
                $ticket->assigned_to = Input::get('assigned_to');
            }
            $ticket->customer_id = $customer->id; // will be changed later
            $ticket->status = Input::get('status'); // will be changed later
            $ticket->urgency = Input::get('urgency'); // will be changed later
            $ticket->premium = Input::get('premium');
            $ticket->save();
//            try {
//                $user = \App\User::findOrFail($ticket->assigned_to);
//                NotificationHandler::makeNotification($user, $ticket);
//            } catch(ModelNotFoundException $e) {
//                \Session::flash('error', $e->getMessage());
//            } catch(\Exception $e) {
//                \Session::flash('error', $e->getMessage());
//            }

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
            if (Input::get('status') != null) {
                $ticket->status = Input::get('status');
            }
            if (Input::get('urgency') != null) {
                $ticket->urgency = Input::get('urgency');
            }
            if (Input::get('premium') != null) {
                $ticket->premium = Input::get('premium');
            }
            $ticket->save();

//            $user = User::findOrFail($ticket->assigned_to);
//            NotificationHandler::makeNotification($user, $ticket);

            return Redirect::back();
        } catch (ModelNotFoundException $ex) {
            return view('errors.404');
        }

    }
 
    public function assign_to($id){
        try{
            $ticket = Ticket::find($id);
            $uid = Input::get('assigned_to');
            $oldid = Input::get('old_assigned');
            $user = User::findOrfail($uid);
            if(isset($user) && $uid != -1){
                $myTickets = Ticket_User::where('user_id',$uid)->count();
                if($myTickets < 3){
                    $ticket->assigned_to = $uid;
                    $myTicket = Ticket_User::where('ticket_id',$id)->where('user_id',$oldid)->first();
                    if(isset($myTicket)){
                        $ticket->users()->detach($oldid);
                    }
                        $ticket->users()->attach($uid);
                    
                }
            }
            $ticket->save();
            
            return Redirect::back();
        }catch (ModelNotFoundException $ex){
            return view('errors.404');
        }
    }

    public function claim(){
        try{
            $ticket = Ticket::find($id);
            $uid = Auth::user()->id;
            $user = User::findOrfail($uid);
            if(isset($user) && $uid != -1){
                if($user->type != 00){
                    $myTickets = Ticket::where('assigned_to', $uid)->count();
                    if($myTickets < 3){
                        $ticket->assigned_to = $uid;
                    }
                }else{
                    $ticket->assigned_to = $uid;
                }
            }
            $ticket->save();
            
            return Redirect::back();
        }catch (ModelNotFoundException $ex){
            return view('errors.404');
        }
    }

    
    
}
