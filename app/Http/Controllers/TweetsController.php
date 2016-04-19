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
		$mentions = $connection->get("statuses/mentions_timeline", ['since_id' => $tweetId, 'count' => 200]);

//		dd($timeine_tweets);

		$tweetsOfConversation = [];

		$currentId = $tweetId;

		$push = true;

		$getNewMentions = true;
		$getNewTimelineTweets = true;

//		$new_timeline_tweets = $timeine_tweets;
//		$new_mentions = $mentions;

		while(true) {
			$current = $connection->get("statuses/show", ['id' => $currentId, 'include_entities' => false]);

			if ($push) {
				array_push($tweetsOfConversation, $current);
			}
//			dd($current);

			$reply = null;

			foreach($timeine_tweets as $timeine_tweet) {
				if ($timeine_tweet->in_reply_to_status_id == $current->id) {
					$reply = $timeine_tweet;
					break;
				}
			}

			if ($reply == null) {
				foreach($mentions as $mention) {
					if ($mention->in_reply_to_status_id == $current->id) {
						$reply = $mention;
						break;
					}
				}
			}

			if ($reply == null) {
				$currentId = $current->id;

				$last_timeline_tweet = end($timeine_tweets);
				$last_mention = end($mentions);

				$push = false;

				if ($getNewMentions == true) {
					$new_mentions = $connection->get("statuses/mentions_timeline", ['since_id' => $last_mention->id, 'count' => 200]);
					if (sizeof($new_mentions) == 1) {
						$getNewMentions = false;
					} else {
						array_shift($new_mentions);
						array_merge($mentions, $new_mentions);
					}
				}

				if ($getNewTimelineTweets == true) {
					$new_timeline_tweets = $connection->get("statuses/user_timeline", ['since_id' => $last_timeline_tweet->id, 'count' => 200]);
					if (sizeof($new_timeline_tweets) == 1) {
						$getNewTimelineTweets = false;
					} else {
						array_shift($new_timeline_tweets);
						array_merge($mentions, $new_timeline_tweets);
					}
				}
				//echo 'here';

				if (!$getNewMentions && !$getNewTimelineTweets) {
					break;
				}


				break;
			} else {
				$currentId = $reply->id;
				$push = true;
			}

		}

		dd($tweetsOfConversation);

	}



	public function replyToTweet($tweetId, $status) {
		$connection = TwitterApiConnection::connectToTwitterAPI();

		$post_status = $connection->post("statuses/update", ["status" => $status, 'in_reply_to_status_id' => $tweetId]);

		dd($post_status);

	}




}
