<?php
define("TITAN_CENTER" , "TITAN_CENTER");
require_once("config/config.inc.php");
define("SMARTY_FLAG" , "SMARTY_FLAG");
require_once(FRAMWORK."init.php");

$smarty -> assign("debugMode" , $GLOBALS['sysConfig']['debugMode']);
$smarty -> display("index.html");

