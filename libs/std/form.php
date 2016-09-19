<?php

class Form
{
	public static function post($name)
	{
		return utf8_decode($_POST[$name]);
	}

	public static function get($name)
	{
		return $_GET[$name];
	}
}

?>