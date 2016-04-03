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

}
