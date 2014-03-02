<?php
define("FREE_NET" , "FREE_NET");
define("ROOT_PATH" , dirname(__FILE__));
$mainConfig = require_once("config/config.inc.php");
require_once("framework/freeApp.php");

$freeApp = FreeApp::getInstance($mainConfig);
$freeApp -> run();


