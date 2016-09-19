<?php

class Flash
{
	public static function create($name, $type, $value)
	{
		session_start();

		$_SESSION[$name] = array("type" => $type, "value" => $value);
	}

	public static function get($name)
	{
		session_start();

		$array  = $_SESSION[$name];

		if(isset($array))
		{
			$object = new stdClass();

			foreach ($array as $key => $value)
			{
			    $object->$key = $value;
			}

			session_unset($_SESSION[$name]);

			return $object;
		}
		else return false;
	}
}

?>