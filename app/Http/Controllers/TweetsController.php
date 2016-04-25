<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\TwitterFunctions;

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

}
