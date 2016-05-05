<?php

namespace App\Http\Controllers;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

use App\User;
use DB;
use Auth;
use Carbon\Carbon;
// use MailNotification;

class UsersController extends Controller
{


    public function __construct() {

        $this->middleware('auth', ['except' => ['create']]);
        $this->middleware('isAdmin', ['only' => ['destroy', 'edit', 'update']]);
    }

    /**
     * Returns a user if found, otherwise returns an exception
     *
     * @param intval  $id
     *
     * @return $user | ModelNotFoundException
     */
    public function get_user($id) {
        try
        {
            $user = User::findOrFail($id);
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e));
            dd($e);
        }
        return $user;
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->get_user($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // validations
        $this->validate($request, [
            'name' => 'required|min:3|max:12|regex:/[a-zA-Z\ ]+$/',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'type' => 'required|max:2',
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $type = $request->type;

        // create a new user
        $user = User::create($request->all());

        //send email to user with his user name and password
        \App\MailNotification::mailInvitation([$user], $name, $email, $password, $type);

        // check that the email has been sent
        $request->session()->flash('object', $name);
        if( count(Mail::failures()) > 0 ) {

           $request->session()->flash('status', 'failure');

           foreach(Mail::failures as $email_address) {
               error_log(" - $email_address <br />");
            }
        }
        else {
           $request->session()->flash('status', 'success');
        }

        $route = lcfirst(User::IntTypeToStr($type).'s');

        return redirect($route);
    }

    public function edit($id)
    {
        $user = $this->get_user($id);
        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = $this->get_user($id);
        $oldType = $user->type;

        $selectedType = Input::get('types');
        $user->type = $selectedType;
        if($user->save()){
            $request->session()->flash('status', 'user_update_success');
        }
        else
        {
            $request->session()->flash('status', 'user_update_failure');
        }

        return redirect(lcfirst(User::IntTypeToStr($oldType))."s");

    }

    public function destroy($id, Request $request)
    {
        $current_user = Auth::user();
        if($current_user->id == $id){
            $request->session()->flash('status', 'do_not_delete_self');
            return back();
        }

        $user = $this->get_user($id);
        if($user->delete()){
            $request->session()->flash('status', 'user_delete_success');
        }
        else
        {
            $request->session()->flash('status', 'user_delete_failure');
        }

        return back();
    }

    public function usersAddAndIndex(Request $request){

        $usersTypeStr = ucfirst(rtrim($request->path(), "s"));
        $usersTypeInt = User::strTypeToInt($usersTypeStr);

        $users =  User::where('type', '=', $usersTypeInt)->get();

        return view('users.usersAddAndIndex', compact('usersTypeStr', 'usersTypeInt','users'));
    }

    public function statistics(User $user){
        $day = 0;
        $week = 1;
        $ret = [];
        for ($x = 0; $x<4; $x++) {
            $yesterday = Carbon::now()->subDays($day);
            $one_week_ago = Carbon::now()->subWeeks($week);

            $opened_last_week = Ticket::where('created_at', '>=', $one_week_ago)
                ->where('created_at', '<=', $yesterday)
                ->where('opened_by', $user->id)
                ->get()->count();
            $closed_last_week = Ticket::where('created_at', '>=', $one_week_ago)
                ->where('created_at', '<=', $yesterday)
                ->where('assigned_to', $user->id)
                ->where('status', 2)
                ->get()->count();
            $open = Ticket::where('status', 0)
                ->where('created_at', '>=', $one_week_ago)
                ->where('created_at', '<=', $yesterday)
                ->get()->count();
            $pending = Ticket::where('status', 1)
                ->where('created_at', '>=', $one_week_ago)
                ->where('created_at', '<=', $yesterday)
                ->get()->count();
            $closed = Ticket::where('status', 2)
                ->where('created_at', '>=', $one_week_ago)
                ->where('created_at', '<=', $yesterday)
                ->get()->count();
            $week_number = $x + 1;
            $weekArray = array(
                'Opened' => $opened_last_week,
                'closed' => $closed_last_week,
                'total opened' => $open,
                'total pending' => $pending,
                'total closed' => $closed
            );
            $ret[$week_number] = $weekArray;
            $day += 7;
            $week ++;
        }

        return $ret;
    }
}
