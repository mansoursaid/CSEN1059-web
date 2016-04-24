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
        // Will return a ModelNotFoundException if no user with that id
        try
        {
            $user = User::findOrFail($id);
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e))
            dd($e)
        }

        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Requests\CreateUserRequest $request)
    {
        // validations
        User::create($request->all());
        return redirect('users');
    }

    public function edit($id)
    {
        // Will return a ModelNotFoundException if no user with that id
        try
        {
            $user = User::findOrFail($id);
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e))
            dd($e)
        }

        return view('users.edit', compact('user'));
    }

    public function update($id, Requests\UpdateUserRequest $request)
    {

        // Will return a ModelNotFoundException if no user with that id
        try
        {
            $user = User::findOrFail($id);
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e))
            dd($e)
        }

        $user->update($request->all());
        return redirect('users');
    }

    public function destroy($id){

        // Will return a ModelNotFoundException if no user with that id
        try
        {
            $user = User::findOrFail($id);
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e))
            dd($e)
        }

        $user->delete();
        return redirect('users');
    }

}
