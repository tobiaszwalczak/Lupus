<?php

class Language
{
	public static function get($name)
	{
		$content = File::read("app/languages/en.json");
		$object  = json_decode($content);

		echo $object->$name;
	}
}