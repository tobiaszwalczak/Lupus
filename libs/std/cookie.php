<?php

class Cookie
{
	public static function set($name, $value, $time)
	{
		$time = intval($time);

		setcookie($name, $value, time()+$time, "/");
	}

	public static function get($name)
	{
		return $_COOKIE[$name];
	}

	public static function delete($name)
	{
		setcookie($name, "", time()-1, "/");	
	}
}

?>