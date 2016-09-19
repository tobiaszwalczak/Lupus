<?php

$app = array(
	
	"environment" => "development", // [production/development]

	"language" => "en"

);

define("ENVIRONMENT", $app["environment"]);
define("LANGUAGE"   , $app["language"]);