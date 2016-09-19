<?php

if (ENVIRONMENT == "production") error_reporting(0);
else error_reporting(1);

require_once "loader.php";

$app = new Bootstrap;

?>