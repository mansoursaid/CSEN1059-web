<?php

namespace App;


class TwitterConfig {

	const CONSUMER_KEY = 'twitterconf.consumerKey';
	const CONSUMER_KEY_SECRET = 'twitterconf.consumerSecret';
	const ACCESS_TOKEN = 'twitterconf.accessToken';
	const ACCESS_TOKEN_SECRET = 'twitterconf.accessTokenSecret';


	public static function getTwitterconfig()
	{

		$configArray = [];

		$consumerKey = config(self::CONSUMER_KEY);
		$consumerSecret = config(self::CONSUMER_KEY_SECRET);
		$accessToken = config(self::ACCESS_TOKEN);
		$accessTokenSecret = config(self::ACCESS_TOKEN_SECRET);

		array_push($configArray, $consumerKey);
		array_push($configArray, $consumerSecret);
		array_push($configArray, $accessToken);
		array_push($configArray, $accessTokenSecret);

		return $configArray;
	}


	public static function setConfigKey($key, $value) {
		config([$key => $value]);
	}


}

