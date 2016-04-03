<?php

namespace App;

use Abraham\TwitterOAuth\TwitterOAuth;

use App\TwitterConfig;

class TwitterApiConnection {

	public static function connectToTwitterAPI()
	{
		$arrConfig = TwitterConfig::getTwitterconfig();

		$connection = new TwitterOAuth($arrConfig[0], $arrConfig[1], $arrConfig[2], $arrConfig[3]);

		return $connection;
	}

}
