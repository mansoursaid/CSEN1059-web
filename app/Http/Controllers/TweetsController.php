<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;

use App\TwitterApiConnection;

use Illuminate\Http\Request;

use App\Http\Requests;

class TweetsController extends Controller
{

	public function index() {
		$connection = TwitterApiConnection::connectToTwitterAPI();

		$mentions = $connection->get("statuses/mentions_timeline", []);

		dd($mentions);

		$startConersationTweets = [];

		foreach($mentions as $mention) {
			if ($mention->in_reply_to_status_id == null) {
				array_push($startConersationTweets, $mention);
			}
		}

		dd($startConersationTweets);

	}


	public function getConversation($tweetId) {

		$connection = TwitterApiConnection::connectToTwitterAPI();

		$timeine_tweets = $connection->get("statuses/user_timeline", ['since_id' => $tweetId, 'count' => 200]);

		$tweetsOfConversation = [];

		$currentId = $tweetId;

		while(true) {
			$current = $connection->get("statuses/show", ['id' => $currentId, 'include_entities' => false]);
			
			dd($current);

		}


	}

}
