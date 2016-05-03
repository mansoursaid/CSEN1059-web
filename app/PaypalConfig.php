<?php

namespace App;

use Illuminate\Filesystem\Filesystem;


class PaypalConfig {

	const CLIENT_ID = 'paypalconfig.clientID';
	const SECRET_KEY = 'paypalconfig.secretKey';

	const FILE_NAME = "paypalconfig";
	const REL_PATH = "/../config/paypalconfig.php";


	public static function getClientID()
	{

		$clientID = config(self::CLIENT_ID);

		return $clientID;
	}


	public static function getSecretKey()
	{

		$secretKey = config(self::SECRET_KEY);

		return $secretKey;
	}

	public static function setClientID($clientID)
	{
		return self::changePaypalConfig("clientID", $clientID);
	}


	public static function setSecretKey($secretKey)
	{
		return self::changePaypalConfig("secretKey", $secretKey);
	}

	private static function changePaypalConfig($key, $value) {

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

