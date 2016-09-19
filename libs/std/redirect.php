<?php

class Redirect
{
	public static function back()
	{
		$target = $_SERVER['HTTP_REFERER'];
		header("location: ". $target);
	}

	public static function to($target)
	{
		header("location: ". URL ."$target");
	}
}

?>