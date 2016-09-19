<?php

class Bootstrap
{
	function __construct(){

		//$uri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		//if (substr($uri, -1) != "/" && !strpos($uri, "?")) header("location: $uri/");

		$url = $_GET["url"];
		$url = rtrim($url, "/");
		$url = explode("/", $url);

		$urlnum 	= count($url);
		$controller = $url[0];
		$action		= $url[1];

		if(isset($url[2])) $args = array();

		for($i = 2; $i <= $urlnum; $i++)
		{
			$args[] = $url[$i];
		}

		if (strpos(join($url,"/"), ".coffee") !== false)
		{
			require "libs/third-party/coffee/init.php";
			CoffeeScript\Init::load();

			$coffee = file_get_contents(join($url,"/"));
		  $js 		= CoffeeScript\Compiler::compile($coffee);

		  echo $js;
		}
		else
		{
			define("CONTROLLER", $controller);
			define("ACTION"    , $action);
			define("ARGUMENTS" , $args);

			$file = "app/controllers/". $controller ."_controller.php";

			if (file_exists($file))
			{
				require_once $file;
				
				$controllername = ucfirst($controller) ."Controller";
				$controller 	= new $controllername;

				if (isset($args))
					call_user_func_array(array($controller, "$action"), $args);
				else
				{
					if (isset($action))
						$controller->{$action}();
					else
					{
						if (method_exists($controller, "index"))
							$controller->index();
						else
							echo "Create a index() method in your $controller_name.";
					}
				}
			}
			else
			{
				if ($controller == NULL)
				{
					if (file_exists("public/index.jade"))
						View::render("../../public/index");
					else
						echo "Create a static index.jade page in the public/ directory.";
				}
				else
				{
					if (file_exists("public/404.jade"))
						View::render("../../public/404");
					else
						echo "Create a static 404.jade page in the public/ directory.";
				}
			}
		}
	}
}

?>