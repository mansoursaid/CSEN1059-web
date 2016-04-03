<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Requests;

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

}
