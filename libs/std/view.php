<?php

class View
{
	private static $vars;

	public static function render($path, $vars = false)
	{
		$url = explode("/", $_GET["url"]);
		self::$vars = $vars;

		foreach ($vars as $key => $value)
		{
			${$key} = $value;
		}

		$content = File::read("app/views/". $path .".jade");

		$jade = new Jade\Jade();
		$output = $jade->render($content);

		eval(" ?>". $output ."<?php ");
	}

	public static function component($path)
	{
		$vars = self::$vars;

		foreach ($vars as $key => $value)
		{
			${$key} = $value;
		}

		$content = File::read("app/views/components/". $path .".jade");

		$jade = new Jade\Jade();
		$output = $jade->render($content);

		$out = eval(" ?>". $output ."<? ");
		echo $out;
	}
}

?>