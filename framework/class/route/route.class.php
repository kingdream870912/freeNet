<?php
/**
 * 路由管理
 */
if(!defined(FREE_NET)) exit();

class RouteClass{
	private static $_instance;
	private $_route;
	public $action;
	public $controller;
	public $controllObj;
	
	public static function getInstance($route){
		if(!(self::$_instance instanceof RouteClass)){
			self::$_instance = new self($route);
		}
		return self::$_instance;
	}
	
	private function __construct($route){
		$this -> _route = $route;
		$this -> controller = array('site' , 'index');
		$this -> action = "default";
	}
	
	/**
	 * 根据url中参数决定对应的module control
	 */
	public function analysisRoute(){
		foreach($this -> _route as $key => $value){
			$$key = $value;
		}
		if($route){
			$this -> controller = explode("/", $r);
		}
		if($action){
			$this -> action = $action;
		}
	}
	
	public function runController(){
		if($this -> controller){
			$filePath = $this -> _getControllerPath();
			if(file_exists($filePath)){
				require_once $filePath;
			}
		}
	}
	
	public function runAction(){
		$control = new $this -> controllObj;
		$action = $this -> action ."Action";
		$control -> $action();
	}
	
	/**
	 * 获取controller类文件地址
	 */
	private function _getControllerPath(){
		if($this -> controller){
			$result = ROOT_PATH . "/controller/";
			foreach($this -> controller as $key => $value){
				if($this -> controller[$key + 1]){
					$result .= $value ."/";
				}else{
					$result .= $value."Controller.php";
					$this -> controllObj = $value."Controller";
				}
				
			}
		}
		return $result;
	}

}