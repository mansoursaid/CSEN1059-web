<?php

namespace App;



use Illuminate\Filesystem\Filesystem;

class TwitterConfig {

	const CONSUMER_KEY = 'twitterconf.consumerKey';
	const CONSUMER_KEY_SECRET = 'twitterconf.consumerSecret';
	const ACCESS_TOKEN = 'twitterconf.accessToken';
	const ACCESS_TOKEN_SECRET = 'twitterconf.accessTokenSecret';

	const FILE_NAME = "twitterconf";
	const REL_PATH = "/../config/twitterconf.php";


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

	//getters
	public static function getConsumerKey() {
		return config(self::CONSUMER_KEY);
	}

	public static function getConsumerKeySecret() {
		return config(self::CONSUMER_KEY_SECRET);
	}

	public static function getAccessToken() {
		return config(self::ACCESS_TOKEN);
	}

	public static function getAccessTokenSecret() {
		return config(self::ACCESS_TOKEN_SECRET);
	}

	// setters
	public static function setConsumerKey($consumerKey) {

		return self::chengeKeyValueConfig('consumerKey', $consumerKey);
	}

	public static function setConsumerKeySecret($consumerKeySecret) {

		return self::chengeKeyValueConfig('consumerSecret', $consumerKeySecret);

	}

	public static function setAccessToken($accessToken) {
		return self::chengeKeyValueConfig('accessToken', $accessToken);
	}

	public static function setAccessTokenSecret($accessTokenSecret) {
		return self::chengeKeyValueConfig('accessTokenSecret', $accessTokenSecret);
	}

	private static function chengeKeyValueConfig($key, $value) {
		$array = config(self::FILE_NAME);

		$array[$key] = $value;

		$data = var_export($array, 1);

		$fileSystem = new Filesystem();

		if($fileSystem->put(app_path() . self::REL_PATH, "<?php\n return $data ;")) {
			return true;
		} else {
			return false;
		}
	}

}

