<?php

namespace App\Http\Controllers;


use App\TwitterFunctions;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

use App\Http\Requests;

class HomeController extends Controller
{

    public function getHome()
    {


        date_default_timezone_set('Africa/Cairo');


        $count = 2;
        $max_id = 0;

        $newTweets = [];

        if (Cache::has('new_tweets' . $count . "-" . $max_id)) {
            $newTweets = Cache::get('new_tweets' . $count . "-" . $max_id);

        } else {
            $newTweets = TwitterFunctions::getTweets($count, $max_id);
            $expiresAt = Carbon::now()->addMinutes(2);
            Cache::add('new_tweets' . $count . "-" . $max_id, $newTweets, $expiresAt);
        }


        try {
            $temp = $newTweets->errors;
            Cache::forget('new_tweets' . $count . "-" . $max_id);
            return view('errors.api_error_rate_limit_exceed');
        } catch (\Exception $e) {
            $groupedTickets = \App\Ticket::where('status', '<', 2);

            $admins = \App\User::ofType(0)->get();
            $supportSupervisors2 = \App\User::ofType(1)->get();
            $supportAgents2 = \App\User::ofType(10)->get();

//            $admins = [];
            $supportAgents = [];
            $supportSupervisors = [];

//            foreach($admins2 as $admin) {
//                $assignedTickets = $groupedTickets->where('assigned_to', $admin->id)->count();
//                if ($assignedTickets < 3) {
//                    array_push($admins, $admin);
//                }
//            }


            foreach($supportSupervisors2 as $supportSupervisor) {
                $assignedTickets = $groupedTickets->where('assigned_to', $supportSupervisor->id)->get()->count();
                if ($assignedTickets < 3) {
                    array_push($supportSupervisors, $supportSupervisor);
                }
            }


            foreach($supportAgents2 as $supportAgent) {
                $assignedTickets = $groupedTickets->where('assigned_to', $supportAgent->id)->get()->count();
                if ($assignedTickets < 3) {
                    array_push($supportAgents, $supportAgent);
                }
            }



            return view('home.index', compact('newTweets', 'admins', 'supportSupervisors', 'supportAgents'));
        }


    }


    public function store(Request $request)
    {

        $tweetId = Input::get('tweetId');

        $status = Input::get('status');

        $newTweet = TwitterFunctions::replyToTweet($tweetId, $status);


    }

}
