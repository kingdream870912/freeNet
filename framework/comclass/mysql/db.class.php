<?php
if(!defined(TITAN_CENTER)) exit();
class DbClass{
	private static $_self;

	public static function getInstance($mode){
		if(!(self::$_self[$mode] instanceof MysqlClass)){
			self::$_self[$mode] = new MysqlClass($mode);
		}
		return self::$_self[$mode];
	}
	
	public static function getAll($sql){
		$GLOBALS['Klog'] -> logInfo("getAll-> sql" . $sql);
        $mysql = self::getInstance("read");
        return $mysql -> getAll($sql);
    }

   	public static function getOne($sql, $type=MYSQL_ASSOC){
   		$GLOBALS['Klog'] -> logInfo("getOne -> sql" . $sql);
		$mysql = self::getInstance("read");
        return $mysql -> getOne($sql,$type);
	}

	public static function getValue($sql,$type = MYSQL_NUM,$var=0){
		$GLOBALS['Klog'] -> logInfo("getValue -> sql" . $sql);
		$mysql = self::getInstance("read");
		return $mysql -> getValue($sql, $type,$var);
	}


	public static function updateTable($table, $bind=array(),$where = ''){
		$mysql = self::getInstance("write");
        return $mysql -> updateTable($table,$bind,$where);
	}

	public static function insertTable($table, $bind=array()){
		$mysql = self::getInstance("write");
        return $mysql -> insertTable($table,$bind);
	}

	public function query($sql, $type = ''){
		$GLOBALS['Klog'] -> logInfo("db-> sql" . $sql);
		$mysql = self::getInstance("write");
		return $mysql -> query($sql,$type);
	}

	public function counter($table_name,$where_str='', $field_name='*'){
	    $where_str = trim($where_str);
	    if($where_str && strtolower(substr($where_str,0,5))!='where') $where_str = "WHERE $where_str";
	    $query = " SELECT COUNT($field_name) AS cnt FROM $table_name $where_str ";
	    $rtl = self::getOne($query);
	    return $rtl['cnt'];
	}

	

	
	
	
}