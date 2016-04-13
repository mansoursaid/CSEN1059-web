<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;

class NotificationsController extends Controller
{
    //

    public function index()
    {
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        try {
            $notification = Notification::findOrfail($id);
        } catch(ModelNotFoundException $e) {
            return view('errors.404');
        }

        return view('notifications.show', compact('notification'));
    }


}
