<?php

namespace App;


class PaypalConfig {

	const CLIENT_ID = 'paypalconfig.clientID';
	const SECRET_KEY = 'paypalconfig.secretKey';


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
		config([self::CLIENT_ID => $clientID]);
	}


	public static function setSecretKey($secretKey)
	{
		config([self::SECRET_KEY => $secretKey]);
	}





}

