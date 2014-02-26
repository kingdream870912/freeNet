<?php
if(!defined(TITAN_CENTER)) exit();

/*------------------------数据库配置数组--------------------------*/
$dbconfig = array(
	//write DB
	'write' => array(
		'hostname' => 'localhost',
		'database' => 'titanBeta',
		'username' => 'root',
		'password' => '123456',
		'charset' => 'utf8',
		'type' => 'mysql',
		'debug' => true,
		'pconnect' => 0,
		'autoconnect' => 0
	),
	//read DB
	'read' => array(
		'hostname' => 'localhost',
		'database' => 'titanBeta',
		'username' => 'root',
		'password' => '123456',
		'charset' => 'utf8',
		'type' => 'mysql',
		'debug' => true,
		'pconnect' => 0,
		'autoconnect' => 0
	),
);
/*------------------------memcache配置数组-----------------------*/
$CACHE_CONFIG = array(
	array('host' =>'localhost', 'port' => '11311', 'weight' => 100),      
); 


/*------------------------PATH DEFINE---------------------------*/
$rootPath = dirname(__FILE__);
$rootPath = str_replace("config", "", $rootPath);
define("ROOT_PATH" , $rootPath);
define("WEB_PATH" , "http://beta.huowu.com");
define("CONFIG_PATH" , ROOT_PATH . "config/");
define("FRAMWORK"	 , ROOT_PATH . "framework/");
define("COM_CLASS_PATH" , ROOT_PATH . "framework/comclass/");
define("STATIC_DATA_PATH" , ROOT_PATH . "staticdata/");
define("CLASS_PATH" , ROOT_PATH . "class/");
$logPath = ROOT_PATH . "log/global/".date("Y-m-d",time()) . "/";
define("LOG_PATH" , $logPath);