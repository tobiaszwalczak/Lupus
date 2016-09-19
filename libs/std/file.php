<?php

class File
{
	public static function upload($input, $target = "", $name = false)
	{
		if(!$name) $name = $_FILES[$input]["name"];

		$tmp = $_FILES[$input]["tmp_name"];

		move_uploaded_file($tmp, $target . $name);
	}

	public static function open($filename)
	{
		fopen($filename, "r+");
	}

	public static function read($path)
	{
		return file_get_contents(URL ."/". $path);
	}

	public static function write($handle, $content)
	{
		fwrite($handle, $content);
	}

	public static function close($handel)
	{
		fclose($handel);
	}

	public static function exists($filename)
	{
		if(file_exists($filename)) return true;
		else 					             return false;
	}
}