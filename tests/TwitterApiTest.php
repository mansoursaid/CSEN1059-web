<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TwitterFunctions;
use Carbon\Carbon;

class TwitterApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
//        $this->assertTrue(true);


        $mentions = TwitterFunctions::getTweets(200, 0);


//        $count1 = 0;

        $tweetId = null;

        foreach($mentions as $mention) {
            if ($tweetId== null) {
                $tweetId = $mention->id;
            }
//            $count1 += 1;
        }

        $conversation = TwitterFunctions::getConversation($tweetId);

        $lastTweetInConv = null;

        $count1 = 0;

        foreach($conversation as $conv) {
            if ($lastTweetInConv == null) {
                $lastTweetInConv = $conv;
            }
            else {
                if ($conv->id > $lastTweetInConv->id) {
                    $lastTweetInConv = $conv;
                }
            }
            $count1 += 1;
        }

        $timeNow = Carbon::now();

        $user = $lastTweetInConv->in_reply_to_screen_name;

        TwitterFunctions::replyToTweet($lastTweetInConv->id, '@'.  $user .' hello testing '.$timeNow, 1);

        $conversation2 = TwitterFunctions::getConversation($tweetId);

        $count2 = 0;

        foreach($conversation2 as $conv) {
            $count2 += 1;
        }


        $this->assertEquals($count2, $count1 + 1);

    }
}
