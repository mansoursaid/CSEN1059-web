<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\TwitterFunctions;
use App\Ticket;
use App\Customer;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class TweetsController extends Controller
{

    public function getTweets($maxId) {

        date_default_timezone_set('Africa/Cairo');

        $count = 2;

        $maxId = $maxId - 1;

        if (Cache::has('new_tweets'.$count."-".$maxId))
        {
            $newTweets = Cache::get('new_tweets'.$count."-".$maxId);
           // echo 'found';

        } else {
            $newTweets = TwitterFunctions::getTweets($count, $maxId);
            // TODO: remove the first element

            $expiresAt = Carbon::now()->addMinutes(2);
            Cache::add('new_tweets'.$count."-".$maxId, $newTweets, $expiresAt);
            //echo 'not found';
        }

        return $newTweets;

    }


    public function replyToTicket(Request $request) {

        $rules = array(
            'status' => 'required|between:1,100',
            'last_tweet_id' => 'required',
            'ticket_id' => 'required'
        );


        $this->validate($request,$rules);



        $tweetId = Input::get('last_tweet_id');

        $status = Input::get('status');

        $ticketId = Input::get('ticket_id');

        $ticket = Ticket::findOrFail($ticketId);

        $ticketTweetId = $ticket->tweet_id;

        $customer = Customer::findOrFail($ticket->customer_id);

        $status = "@" . $customer->twitter_handle . " " . $status;



        $newStatus = TwitterFunctions::replyToTweet($tweetId, $status, $ticketTweetId);

//        return redirect('tickets/'.$ticketId);

        return redirect()->action('TicketsController@show', [$ticketId]);
    }




}
