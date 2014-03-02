<?php
if(!defined(TITAN_CENTER)) exit();
class SysFunClass{
	
	public static function createUid($prefix = '',$start = 0,$leng = 6){
		$chars = md5(uniqid(mt_rand(), true));
	    $uuid  = substr($chars,$start,$leng);	   
	    return $prefix . $uuid;
	}

	public static function getIp(){
		if(!empty($_SERVER["HTTP_CLIENT_IP"])) $cip = $_SERVER["HTTP_CLIENT_IP"];
		else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		else if(!empty($_SERVER["REMOTE_ADDR"])) $cip = $_SERVER["REMOTE_ADDR"];
		else $cip = "";
		//去除冗余字符
		$cip = str_replace("::ffff:", "", $cip);
		return $cip;
	}


	/**
	 * 获取远程网址的内容,采用curl,一般用于外站的API
	 * @param string url 远程网址
	 * @param string username 用户名
	 * @param string password 密码
	 * @param int timeout 请求时间控制
	 */
	public static function gethttpcnt($url,$data = array(),$username = '',$password = '',$timeout = 5,$mode = "GET"){
		try{
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);		    
		    
		    curl_setopt($ch, CURLOPT_POST, 1);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		    	    
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		
		    //在需要用户检测的网页里需要增加下面两行
		    if($username && $password){
		        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		        curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
		    }
		    $cnt = curl_exec($ch);
		    curl_close($ch);
		}catch(Exception $e){
  			throw new Exception($e -> getMessage());
  		}	    
	    return $cnt;
	}
	
	/**
	 * 获取子服务器配置
	 * @param object $cache
	 * @throws exception
	 */
	public static function createSysServerConfig(&$cache){
		try{
			$mckey = "GServerConfig";
			$result = $cache -> get($mckey);
			if(!$result){
				$sql = "select * from `".TS_SERVER_CONFIG."`";
				$res = DbClass::getAll($sql);
				if(!$res){
					$result = array();
				}else{
					foreach($res as $key => $value){
						$result[$value['sid']] = $value;
					}
				}
				$cache -> set($mckey , $result);
			}
		}catch(Exception $e){
			throw new exception($e -> getMessage());
		}
		return $result;
	}
	
	/**
	 * 获取央服系统设置
	 * @param object $cache
	 * @throws exception
	 */
	public static function createSysConfig(&$cache){
		try{
			$mckey = "GSysConfig";
			$result = $cache -> get($mckey);
			if(!$result){
				$sql = "select * from `".TS_CONFIG."`";
				$res = DbClass::getAll($sql);
				if(!$res){
					$result = array();
				}else{
					foreach($res as $key => $value){
						$result[$value['code']] = $value['value'];
					}
				}
				$cache -> set($mckey , $result);
			}
		}catch(Exception $e){	
			throw new exception($e -> getMessage());
		}
		return $result;
	}
}
