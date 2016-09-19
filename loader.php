<?php

require_once "config/app.php";
require_once "config/paths.php";
require_once "config/database.php";

$connection = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
$database 	= mysql_select_db(DB_NAME);

require_once "libs/functions/get_called_class.php";
require_once "libs/functions/timestemp_into_date.php";

require_once "libs/std/bootstrap.php";
require_once "libs/std/model.php";
require_once "libs/std/view.php";
require_once "libs/std/database.php";
require_once "libs/std/form.php";
require_once "libs/std/redirect.php";
require_once "libs/std/cookie.php";
require_once "libs/std/url.php";
require_once "libs/std/language.php";
require_once "libs/std/flash.php";
require_once "libs/std/file.php";

require_once "libs/third-party/image.php";

$jades = array_slice(scandir("libs/third-party/jade/"), 2);
foreach ($jades as $jade)
	require_once "libs/third-party/jade/". $jade;

$models = array_slice(scandir("app/models/"), 2);
foreach ($models as $model)
	require_once "app/models/". $model;

?>
