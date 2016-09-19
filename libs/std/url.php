<?php

class Url
{
	public static function parameter($name)
	{
		return $_GET[$name];
	}
}

?>