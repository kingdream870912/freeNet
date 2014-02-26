<?php
define("TITAN_CENTER" , "TITAN_CENTER");
require_once("../config/config.inc.php");
require_once(FRAMWORK."init.php");

try{
	$nickName = isset($_REQUEST['nickName'])?$_REQUEST['nickName']:'';
	$serverId = isset($_REQUEST['serverId'])?intval($_REQUEST['serverId']):0;
	$accountName = isset($_REQUEST['accountName'])?$_REQUEST['accountName']:'';
	$time = isset($_REQUEST['time'])?intval($_REQUEST['time']):time();
	if(!$serverId){
		$errorMsg = StaticClass::env("serverId" , "error");
		$errorMsg = serialize($errorMsg);
		throw new exception($errorMsg);
	}
	$userObj = UserClass::getInstance();
	switch($GLOBALS['sysConfig']['debugMode']){
		case 1:
			$userInfo = $userObj -> getUserByNickName($nickName,$serverId);
			if(!$userInfo || empty($userInfo)){
				$userInfo = $userObj -> createUser($serverId,$nickName);
				$res['token'] = $userObj -> getTocken($accountName,$time,$serverId);
			}else{
				$res['token'] = $userObj -> getTocken($accountName,$time,$serverId);
			}
		break;
		default:
			$userInfo = $userObj -> getUserByAccountName($accountName , $serverId);
			if($userInfo){
				$res['token'] = $userObj -> getTocken($accountName,$time,$serverId);
			}else{
				$errorMsg = StaticClass::env("notUser", "error");
				$errorMsg = serialize($errorMsg);
				throw new exception($errorMsg);
			}
		break;
	}
	$res['time'] = $time;
	$res['accountName'] = $userInfo['accountName'];
	$result = ApiClass::getResultVo($res);
	$result = json_encode($result);
	exit($result);
}catch(Exception $e){
	$exceptionStr = unserialize($e -> getMessage());
	$result = ApiClass::getResultVo("",$exceptionStr['id'],$exceptionStr['msg']);
	$result = json_encode($result);
	exit($result);
}
