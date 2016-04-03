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

	}

}
