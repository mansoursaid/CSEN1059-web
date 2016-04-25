<?php

namespace App\Http\Controllers;
use App\Http\Requests;

use App\User;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = get_user($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Requests\CreateUserRequest $request)
    {
        // validations
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'type' => 'required|max:2',
        ]);

        User::create($request->all());
        return redirect('users');
    }

    public function edit($id)
    {
        $user = get_user($id);
        return view('users.edit', compact('user'));
    }

    public function update($id, Requests\UpdateUserRequest $request)
    {
        $user = get_user($id);

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
        $user = get_user($id);
        $user->delete();
        return redirect('users');
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
    }

}
