<?php
if(!defined(TITAN_CENTER)) exit();
error_reporting(E_ALL & ~E_NOTICE);
class FreeApp{
	private $_config;
	
	private static $instance;
		
	public static function getInstance($mainConfig){
		if(!(self::$instance instanceof FreeApp)){
			self::$instance = new self($mainConfig);
		}
		return self::$instance;
	}
	
	private function __construct($mainConfig){
		$this -> _config = $mainConfig;
		
	}
	
	public function run(){
		print_r($this -> _config);
	}
	
	private function _getUrl(){
		
	}
}

