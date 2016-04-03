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
        $user = User::findOrfail($id);
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

}
