<?php
/**
 * 对framework中使用到的类进行配置
 */
if(!defined(FREE_NET)) exit();
global $ARR_CLASS_FILE;
$ARR_CLASS_FILE = array(
	'SmartyClass'  	=> FRAMEWORK_ROOT .'/class/smarty/smarty.class.php',
	'ApiClass'	 	=> FRAMEWORK_ROOT . "/class/api/api.class.php",
	'DbClass' 		=> FRAMEWORK_ROOT . "/class/mysql/db.class.php",
	'MysqlClass' 	=> FRAMEWORK_ROOT . "/class/mysql/mysql.class.php",
	'KLogger'		=> FRAMEWORK_ROOT . "/class/log/KLogger.php",
	'StaticClass'	=> FRAMEWORK_ROOT . "/class/static/static.class.php",
	'MemClass'		=> FRAMEWORK_ROOT . "/class/cache/memcache.class.php",
	'RouteClass'	=> FRAMEWORK_ROOT . "/class/route/route.class.php",
	'Controller'	=> FRAMEWORK_ROOT . "/class/controller/controller.class.php",
	'Module'		=> FRAMEWORK_ROOT . "/class/module/module.class.php",
);


function __autoload($class_name) {	
	global $ARR_CLASS_FILE;
	if(!class_exists($class_name, false)){		
		if (isset($ARR_CLASS_FILE[$class_name])){
			require_once  $ARR_CLASS_FILE[$class_name];
		}	
	}
	
}
