<?php

namespace App\Http\Controllers;



use App\TwitterFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

use App\Http\Requests;

class HomeController extends Controller
{

	public function getHome() {

		date_default_timezone_set('Africa/Cairo');

		$count = 200;
		$max_id = 0;

		if (Cache::has('new_tweets'.$count."-".$max_id))
		{
			$newTweets = Cache::get('new_tweets'.$count."-".$max_id);

		} else {
			$newTweets = TwitterFunctions::getTweets($count, $max_id);
			$expiresAt = Carbon::now()->addMinutes(5);
			Cache::add('new_tweets'.$count."-".$max_id, $newTweets, $expiresAt);
		}








		return view('home.index', compact('newTweets'));

	}

	public function store(Request $request) {

		$tweetId = Input::get('tweetId');

		$status = Input::get('status');

		$newTweet = TwitterFunctions::replyToTweet($tweetId, $status);



	}

}
