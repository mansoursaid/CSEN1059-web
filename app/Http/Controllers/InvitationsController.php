<?php

namespace App\Http\Controllers;

use App\Invitation;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Redirect;


class InvitationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $request) {

        $rules = [
            'invited' => 'required',
            'ticket' => 'required'
        ];

        $this->validate($request, $rules);

        $invitation = new Invitation();
        $invitation->user_invited = Input::get('invited');
        $invitation->ticket_id = Input::get('ticket');
        $invitation->created_by = Auth::id();
        $invitation->status = false;
        $invitation->save();


        return Redirect::back();
    }


}
