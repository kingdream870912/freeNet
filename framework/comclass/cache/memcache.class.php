<?php
if(!defined(TITAN_CENTER)) exit();

class MemClass{
	
	private $mmc = NULL;
    
    private static $instance;
    
    public static function getInstance(){
    	if(!(self::$instance instanceof self)){
			self::$instance = new self();
		}
		return self::$instance;
    }

    private function __construct() {
    	if(!($this -> mmc instanceof  Memcache)){
    		$this -> mmc = new Memcache;
    	}
	  	//实现addServer功能
	  	foreach($GLOBALS['CACHE_CONFIG'] as $key => $value) {
	  		$this -> mmc -> addServer($value['host'] , $value['port'],true,$value['weight']);
	  	}
    }
	 
	//读取缓存
	public function get($key) {
		return $this->mmc->get($key);
	}
	 
	//设置缓存
	public function set($key,$value,$expire = 1800) {
		return $this -> mmc -> set($key , $value ,MEMCACHE_COMPRESSED,$expire);
	}
	 
	 
	//添加缓存
	public function add($key, $value, $expire = 1800) {
		if(!get($key)){
	   		return $this->mmc->add($key, $value,MEMCACHE_COMPRESSED,$expire);
	  	}else{
	   		echo "设置失败，该键值被已被注册";
	   		return false;
	  	}
	}
	 
	//替换缓存
	public function replace($key, $value, $expire = 1800){
		return $this->mmc->replace($key, $value,MEMCACHE_COMPRESSED,$expire);
	}
	 
	//自增1
	public function inc($key, $value = 1) {
		return $this->mmc->increment($key, $value);
	}
	 
	//自减1
	public function des($key, $value = 1) {
		return $this->mmc->decrement($key, $value);
	}
	 
	//删除
	public function del($key) {
		return $this->mmc->delete($key);
	}
	 
	//全部清空
	public function clear() {
		return  $this->mmc->flush(); 
	}
	 
	//关闭缓存
	public function close() {
		return $this->mmc->close();
	}
}

