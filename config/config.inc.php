<?php
/**
 * 业务数据库缓存配置
 */
if(!defined(FREE_NET)) exit();
return array(
	'db' => array(
		'account' => array(
			'write' => array('name'=>'localhost' ,'db'=>'freenet' ,'user'=>'root' ,'pwd'=>'' ,'char'=>'utf8'),
			'read' => array('name'=>'localhost' ,'db'=>'freenet' ,'user'=>'root' ,'pwd'=>'' ,'char'=>'utf8'),
		),
		'data' => array(
			'write' => array('name'=>'localhost' ,'db'=>'freenet' ,'user'=>'root' ,'pwd'=>'' ,'char'=>'utf8'),
			'read' => array('name'=>'localhost' ,'db'=>'freenet' ,'user'=>'root' ,'pwd'=>'' ,'char'=>'utf8'),
		),
	),
	'cache' => array(
		'mc' => array(
			array('host' =>'localhost', 'port' => '11311', 'weight' => 100),
		),
	),
);



/*------------------------PATH DEFINE---------------------------*/
//$rootPath = dirname(__FILE__);
//$rootPath = str_replace("config", "", $rootPath);
//define("ROOT_PATH" , $rootPath);
//define("WEB_PATH" , "http://beta.huowu.com");
//define("CONFIG_PATH" , ROOT_PATH . "config/");
//define("FRAMWORK"	 , ROOT_PATH . "framework/");
//define("COM_CLASS_PATH" , ROOT_PATH . "framework/comclass/");
//define("STATIC_DATA_PATH" , ROOT_PATH . "staticdata/");
//define("CLASS_PATH" , ROOT_PATH . "class/");
//$logPath = ROOT_PATH . "log/global/".date("Y-m-d",time()) . "/";
//define("LOG_PATH" , $logPath);