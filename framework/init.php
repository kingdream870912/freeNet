<?php
if(!defined(TITAN_CENTER)) exit();
error_reporting(E_ALL & ~E_NOTICE);
require_once CONFIG_PATH.'classname.inc.php';
require_once CONFIG_PATH."db.inc.php";

if(defined(SMARTY_FLAG)){
	$smarty = new SmartyClass();
	$smarty -> template_dir = ROOT_PATH . "view/home/html";
	$smarty -> compile_dir  = ROOT_PATH . "view/home/templates_c";
	$smarty -> config_dir   = ROOT_PATH . "view/home/html_config";
	$smarty -> cache_dir    = ROOT_PATH . "view/home/html_cache";
	if(defined(ADMIN_FLAG)){
		define("CSS_PATH" , WEB_PATH . "/view/admin/css/");
		define("IMAGE_PATH" , WEB_PATH . "/view/admin/images/");
		define("JS_PATH" , WEB_PATH . "/view/admin/js/");
	}else{
		define("CSS_PATH" , WEB_PATH . "/view/home/css/");
		define("IMAGE_PATH" , WEB_PATH . "/view/home/images/");
		define("JS_PATH" , WEB_PATH . "/view/home/js/");
	}
	$smarty -> assign("cssPath" , CSS_PATH);
	$smarty -> assign("imagesPath" , IMAGE_PATH);
	$smarty -> assign("jsPath" , JS_PATH);

	$smarty -> left_delimiter = "{";
	$smarty -> right_delimiter = "}";
}
//创建全局的Klog 如果是需要隔离服务器则在其他地方去创建对应的Klog
$Klog   = KLogger::instance(LOG_PATH, KLogger::DEBUG);

$cache = MemClass::getInstance();
$sysServerConfig = SysFunClass::createSysServerConfig($cache);
$sysConfig = SysFunClass::createSysConfig($cache);

