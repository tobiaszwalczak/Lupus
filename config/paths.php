<?php

$paths = array(
	
	"url" => "http://localhost",

	"css" => "public/css",

	"js"  => "public/js",

	"img" => "public/img"

);

define("URL", $paths["url"]);
define("CSS", $paths["url"] ."/". $paths["css"]);
define("JS", $paths["url"] ."/". $paths["js"]);
define("IMG", $paths["url"] ."/". $paths["img"]);