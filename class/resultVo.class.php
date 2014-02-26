<?php
if(!defined(TITAN_CENTER)) exit();

class ResultVoClass{

	public static function getResultVo($res,$exception = '',$msg = ''){
		if(!$exception){
			$result['res'] = 1;
		}else{
			$result['res'] = 0;
		}
		$result['result'] = $res;
		$result['msg'] = $msg;
		$result['exception'] = $exception;
		return $result;
	}
}