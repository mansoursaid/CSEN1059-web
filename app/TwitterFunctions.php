<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 4/24/16
 * Time: 2:11 PM
 */
namespace App;

use Abraham\TwitterOAuth\TwitterOAuth;

use App\TwitterApiConnection;

use Illuminate\Support\Facades\Cache;


class TwitterFunctions
{


    public static function getTweets($count, $maxId)
    {
        $connection = TwitterApiConnection::connectToTwitterAPI();
        $mentions = [];
        if ($maxId == 0) {
            $mentions = $connection->get("statuses/mentions_timeline", ['count' => $count]);
        } else {
            $mentions = $connection->get("statuses/mentions_timeline", ['count' => $count, 'max_id' => $maxId]);
        }


//        dd($mentions);

//        $startConersationTweets = [];
//
//        foreach($mentions as $mention) {
//            if ($mention->in_reply_to_status_id == null) {
//                array_push($startConersationTweets, $mention);
//            }
//
//        }

        return $mentions;

    }


    public static function getConversation($tweetId)
    {

        $connection = TwitterApiConnection::connectToTwitterAPI();

        $timeine_tweets = $connection->get("statuses/user_timeline", ['since_id' => $tweetId, 'count' => 200]);
        $mentions = $connection->get("statuses/mentions_timeline", ['since_id' => $tweetId, 'count' => 200]);


        $tweetsOfConversation = [];

        $currentId = $tweetId;

        $push = true;

        $getNewMentions = true;
        $getNewTimelineTweets = true;

//		$new_timeline_tweets = $timeine_tweets;
//		$new_mentions = $mentions;

        while (true) {
            $current = $connection->get("statuses/show", ['id' => $currentId, 'include_entities' => false]);

            // to handle No status with that ID error
            $cont = true;

            try {
                $temp = $current->id_str;
            } catch (\Exception $e) {
//                dd($current);
                $cont = false;
            }

            if (!$cont) {
                break;
            }
            // end

            if ($push) {
                array_push($tweetsOfConversation, $current);
            }
//			dd($current);

            $reply = null;

            foreach ($timeine_tweets as $timeine_tweet) {
                if ($timeine_tweet != null && $current != null && $timeine_tweet->in_reply_to_status_id_str == $current->id_str) {
                    $reply = $timeine_tweet;
                    break;
                }
            }

            if ($reply == null) {
                foreach ($mentions as $mention) {
                    if ($mention != null && $current != null && $mention->in_reply_to_status_id_str == $current->id_str) {
                        $reply = $mention;
                        break;
                    }
                }
            }

            if ($reply == null) {
                $currentId = $current->id_str;

                $last_timeline_tweet = end($timeine_tweets);
                $last_mention = end($mentions);

                $push = false;

                if ($getNewMentions == true && $last_mention != null) {
                    $new_mentions = $connection->get("statuses/mentions_timeline", ['since_id' => $last_mention->id_str, 'count' => 200]);
                    if (sizeof($new_mentions) == 1) {
                        $getNewMentions = false;
                    } else {
                        array_shift($new_mentions);
                        array_merge($mentions, $new_mentions);
                    }
                }

                if ($getNewTimelineTweets == true && $last_timeline_tweet != null) {
                    $new_timeline_tweets = $connection->get("statuses/user_timeline", ['since_id' => $last_timeline_tweet->id_str, 'count' => 200]);
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
                $currentId = $reply->id_str;
                $push = true;
            }

        }

        return $tweetsOfConversation;

    }


    public static function replyToTweet($tweetId, $status, $ticketTweetId)
    {
        $connection = TwitterApiConnection::connectToTwitterAPI();

        $connection->post("statuses/update", ["status" => $status, 'in_reply_to_status_id' => $tweetId]);

        Cache::forget('conv' . "-" . $ticketTweetId);

//        dd($post_status);

//        return $post_status;

    }


}