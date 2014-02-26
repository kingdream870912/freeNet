<?php
if(!defined(TITAN_CENTER)) exit();

class UserClass{

	private static $_instance;

	public static function getInstance(){
		if(!(self::$_instance instanceof self)){
			self::$_instance = new self;
		}
		return self::$_instance;

	}

	private function __construct(){

	}

	public function getUserByNickName($nickName,$serverId){
		try{
			$tableName = TS_USER.'s'.$serverId;
			$sql = "select * from `".$tableName."` where `nickName` = '".$nickName."'";
			$res = DbClass::getOne($sql);
		}catch(Exception $e){
			throw new exception($e -> getMessage());
		}
		return $res;
	}

	public function getUserByAccountName($accountName , $serverId){
		try{
			$tableName = TS_USER.'s'.$serverId;
			$sql = "select * from `".$tableName."` where `accountName` = '".$accountName."'";
			$res = DbClass::getOne($sql);
		}catch(Exception $e){
			throw new exception($e -> getMessage());
		}
		return $res;
	}

	public function createUser($serverId,$nickName = ''){
		try{
			$tableName = TS_USER."s".$serverId;
			$nowTime = time();
			$field['accountName'] = SysFunClass::createUid($serverId,0,32);
			$field['regTime'] = $nowTime;
			$field['loginIp'] = SysFunClass::getIp();
			$field['nickName'] = isset($nickName)?$nickName:$field['accountName'];
			$field['lastLoginTime'] = $nowTime;
			$field['loginStatus'] = 1;
			dbClass::insertTable($tableName,$field);
		}catch(Exception $e){
			throw new exception($e -> getMessage());
		}
		return $field;
	}

	/**
	 *	TODO tokenKey need to get from database
	 */
	public function getTocken($accountName,$time,$serverId){
		$tokenKey = $GLOBALS['sysServerConfig'][$serverId]['tokenKey'];
		$token = md5($tokenKey.$accountName.$time.$serverId);
		return $token;
	}

	public function checkTocken($accountName,$time,$serverId,$token){
		$tokenKey = $GLOBALS['sysServerConfig'][$serverId]['tokenKey'];
		$selfToken = md5($tokenKey.$accountName.$time.$serverId);
		if($selfToken != $token){
			return false;
		}else{
			return true;
		}
	}
}