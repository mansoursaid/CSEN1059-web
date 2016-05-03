<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Notification;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        Notification::where('user_id', $user->id)->where('read', 0)->update(array('read' => 1));

        return view('notifications.index', compact('notifications'));
    }

//    public function show($id)
//    {
//
//        try {
//            $notification = Notification::findOrfail($id);
//        } catch(ModelNotFoundException $e) {
//            return view('errors.404');
//        }
//
//        return view('notifications.show', compact('notification'));
//    }


}
