<?php
/**
 * Created by IntelliJ IDEA.
 * User: nelis
 * Date: 2016-02-11
 * Time: 20:25
 */

namespace NielsBot\Telegram;


class Telegram
{
	private static $token;

	/**
	 * @param string $token
	 */
	public static function setToken($token){
		self::$token = $token;
	}

	/**
	 * @param string $method
	 * @param array $data
	 * @return mixed
	 */
	public static function api($method, $data = []){
		return json_decode(file_get_contents('https://api.telegram.org/bot' . self::$token . '/' . $method . '?' . http_build_query($data)), true);
	}
}