<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\User;
use DB;
// use MailNotification;

class UsersController extends Controller
{


    public function __construct() {
        $this->middleware('isAdmin', ['only' => ['usersAddAndIndex']]);
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

        return redirect('/supervisors');
    }

    public function edit($id)
    {
        $user = $this->get_user($id);
        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = $this->get_user($id);

        // validations
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'type' => 'required|max:2',
        ]);

        $user->update($request->all());
        return redirect('users');
    }

    public function destroy($id)
    {
        $user = $this->get_user($id);
        $user->delete();
        return redirect('users');
    }

    public function usersAddAndIndex(Request $request){

        $usersTypeStr = $request->path();
        $usersTypeInt = User::strTypeToInt($usersTypeStr);

        $users =  User::where('type', '=', $usersTypeInt)->get();

        return view('users.usersAddAndIndex', compact('usersTypeStr', 'usersTypeInt','users'));
    }
}
