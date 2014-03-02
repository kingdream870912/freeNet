<?php
/**
 * 绿荫传奇  通用工具类 - 获取配置参数
 * @category   configs
 * @package    tool
 * @author lelong <lelong512@163.com>
 * @copyright 绿茵传奇2011 版权所有
 * @since      File available since Release 2.1.0
 */
final class StaticClass {
	
	/**
	 * @desc 获取业务配置
	 * @param $token       - 递进关系的token信息
	 * @param $configName  - 配置文件名
	 * @return 配置值
	 */
	public static function biz($token, $configName) {
		return self::_get ( $token, $configName, self::$_bizDir );
	}
	
	/**
	 * @desc 获取环境配置
	 * @param $token       - 递进关系的token信息
	 * @param $configName  - 配置文件名
	 * @return 配置值
	 */
	public static function env($token, $configName) {
		return self::_get ( $token, $configName, self::$_envDir );
	}
	
	/**
	 * @desc 重新加载配置
	 */
	public static function refresh() {
		foreach ( self::$_configs as $category => $configs ) {
			if (is_array ( $configs )) {
				foreach ( $configs as $configName => $config ) {
					self::_load ( $category, $configName );
				}
			}
		}
		return true;
	}
	
	/**
	 * @desc 初始化
	 * @param $category    - 配置类别(环境/业务配置)
	 * @param $configName  - 配置文件名
	 * @return bool        - 是否操作成功
	 */
	private static function _init($category, $configName) {
		if (empty ( $configName )) {
			throw new Exception ( "init config error, unkonw config Name" );
		}
		if (! isset ( self::$_isInit [$category] [$configName] )) {
			self::_load ( $category, $configName );
			self::$_isInit [$category] [$configName] = true;
		}
		return true;
	}
	
	/**
	 * @desc  载入配置文件
	 * @param string $category   -配置种类
	 * @param string $configName -配置模块
	 */
	private static function _load($category, $configName) {
		if (! self::$_configs [$category] [$configName] = null){
			$configFile = STATIC_DATA_PATH .$category."/".$configName. '.inc.php';
			if (! is_file ( $configFile )) {
				throw new Exception ( "init config error, config file not found: " . $configFile );
			}
			if(extension_loaded("eaccelerator") && EACCELERATOR_BUS_SWITCH){
				$data = eaccelerator_get("EA_".$configName);
				if(empty($data) || $data == null){
					$data = require $configFile;
					eaccelerator_put("EA_".$configName, $data, 600);
				}
				self::$_configs [$category] [$configName] = $data;
			}else{
				self::$_configs [$category] [$configName] = require $configFile;
			}
		}
		return self::$_configs [$category] [$configName];
	}
	
	/**
	 * @desc  筛选需要的配置项
	 * @param string $token       -配置模块项
	 * @param string $configName  -配置模块
	 * @param string $category    -配置种类
	 * @return 配置模块项 
	 */
	private static function _get($token, $configName, $category) {
		if (empty ( $configName )) {
			throw new Exception ( "unknow config name: " . $configName );
		}
		if (! isset ( self::$_isInit [$category] [$configName] )) {
			self::_init ( $category, $configName );
		}
		if (! isset ( self::$_configs [$category] [$configName] )) {
			throw new Exception ( "unknow config name: " . $configName );
		}
		if (empty ( $token )) {
			return self::$_configs [$category] [$configName];
		}
		$tokens = explode ( '.', $token );
		$config = self::$_configs [$category] [$configName];
		foreach ( $tokens as $the_token ) {
			if (! isset ( $config [$the_token] )) {
				throw new Exception ( 'config index ' . $the_token . ' not found, current config ' . $configName );
			}
			$config = $config [$the_token];
		}
		return $config;
	}
	
	private static $_bizDir = "business";
	private static $_envDir = "environment";
	private static $_isInit = array ();
	private static $_configs = array ();

}

