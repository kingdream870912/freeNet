<?php
if(!defined(TITAN_CENTER)) exit();
global $ARR_CLASS_FILE;
$ARR_CLASS_FILE = array(
	/*----------------------------------------Smarty-----------------------------------------*/
	'SmartyClass'  	=> COM_CLASS_PATH .'smarty/smarty.class.php',
	/*----------------------------------------Framwork---------------------------------------------*/
	'ApiClass'	 	=> COM_CLASS_PATH . "api/api.class.php",
	'DbClass' 		=> COM_CLASS_PATH . "mysql/db.class.php",
	'MysqlClass' 	=> COM_CLASS_PATH . "mysql/mysql.class.php",
	'KLogger'		=> COM_CLASS_PATH . "log/KLogger.php",
	'StaticClass'	=> COM_CLASS_PATH . "static/static.class.php",
	'SysFunClass' 	=> COM_CLASS_PATH . "sysfun/sysFun.class.php",
	'MemClass'		=> COM_CLASS_PATH . "cache/memcache.class.php",

	'UserClass' 	=> CLASS_PATH . "user.class.php",
);


function __autoload($class_name) {	
	global $ARR_CLASS_FILE;
	if(!class_exists($class_name, false)){		
		if (isset($ARR_CLASS_FILE[$class_name])){
			require_once  $ARR_CLASS_FILE[$class_name];
		}	
	}
	
}
