<?php
if(!defined(TITAN_CENTER)) exit();
class MysqlClass{
	
	var $link;
	var $queryRes;
	
	var $db_host;
	var $db_id;
	var $db_pass;
	var $db_name;
	var $db_charset;
	var $db_pconnect;
	
	public function __construct($dbselect = 'write', $pconnect = 0){
		$this -> db_host = $GLOBALS['dbconfig'][$dbselect]['hostname'];
		$this -> db_id = $GLOBALS['dbconfig'][$dbselect]['username'];
		$this -> db_pass = $GLOBALS['dbconfig'][$dbselect]['password'];
		$this -> db_name = $GLOBALS['dbconfig'][$dbselect]['database'];
		$this -> db_charset = "utf8";
		$this -> db_pconnect = $pconnect;		
		$this -> dbConnect();
	}
	
	public function dbConnect(){
		
		if($this -> db_pconnect){
			!($this->link = @mysql_pconnect($this -> db_host,$this -> db_id,$this -> db_pass)) && $this->halt('Can not connect to MySQL server');
		}else{
			!($this->link = @mysql_connect($this -> db_host,$this -> db_id,$this -> db_pass, 1)) && $this->halt('Can not connect to MySQL server');
		}
		
		$version=$this->version();
		if($version > '4.1')
		{
			@mysql_query("SET character_set_connection= ".$this -> db_charset.", character_set_results=".$this -> db_charset.", character_set_client=binary", $this->link);
			@mysql_query("SET NAMES ".$this -> db_charset."",$this->link);
		}
		if($version > '5.0.1') @mysql_query("SET sql_mode=''", $this->link);

		if($this -> db_name) $this-> _selectDb($this -> db_name); 
		
	}
	
	private function _selectDb($dbname){
		return mysql_query("USE $dbname", $this->link);
	}

	private function _fetchArray($query, $result_type = MYSQL_ASSOC){
		return mysql_fetch_array($query,$result_type);
	}
	
	public function getAll($sql){
        $this -> queryRes = $this->query($sql);
        $arr=array();
        while($rtl=$this-> _fetchArray( $this -> queryRes )) $arr[]=$rtl;
        return $arr;
    }
	
	public function updateTable($table, $bind=array(),$where = ''){
		$set = array();
	    foreach ($bind as $col => $val) $set[] = "`$col` = '$val'";
	    
	    $sql = 'UPDATE '. $table . ' SET ' . implode(',', $set) . (($where) ? " WHERE $where" : '');
		$GLOBALS['Klog'] -> logInfo("update -> sql" . $sql);
	    $this -> queryRes = $this->query($sql);
	}
	
	public function insertTable($table, $bind=array()){
		$set = array();
	    $vals = array();
	    foreach ($bind as $col => $val)
	    {
	        $str1 .= "`{$col}`,";
			$str2 .= "'{$val}',";
	    }
	    $sql = "INSERT INTO `{$table}` (" . trim($str1, ', ') . ") VALUES (" . trim($str2, ', ') . ")";
		$GLOBALS['Klog'] -> logInfo("insert -> sql" . $sql);
	    $this -> queryRes = $this->query($sql);
        return $this->insertId();
	}
	
	
	public function getValue($sql,$type = MYSQL_NUM,$var=0){
		$this -> queryRes = $this->query($sql);
		$rt = $this -> _fetchArray($this -> queryRes,$type);
		
		return isset($rt[$var])?$rt[$var]:false;
	}
	
	public function getOne($sql, $type=MYSQL_ASSOC){
		!strstr(strtoupper($sql),'LIMIT') && $sql.=' LIMIT 1';
		$this -> queryRes = $this->query($sql, $type);
		$rtl = $this-> _fetchArray($this -> queryRes, $type);
		return $rtl ;
	}
	
	public function query($sql, $type = ''){
	   $func = $type == 'UNBUFFERED' && function_exists('mysql_unbuffered_query') ?
			  'mysql_unbuffered_query' : 
			  'mysql_query';
		if(!($query = $func($sql, $this->link))) $this->halt('MySQL Query Error', $sql);
		
		$this->querynum++;
		return $query;
	}
	

	// public function affectedRows(){
	// 	return mysql_affected_rows($this->link);
	// }
	
	// public function listFields($con_db_name,$table){
	// 	$fields=mysql_list_fields($con_db_name,$table,$this->link);
	//     $columns=$this->num_fields($fields);
	//     for ($i = 0; $i < $columns; $i++) $tables[]=mysql_field_name($fields, $i);
	    
	//     return $tables;
	// }
	
 	/* 设置不允许进行缓存的表 */
    // public function setDisableCacheTables($tables){
    //     if (!is_array($tables))
    //     {
    //         $tables = explode(',', $tables);
    //     }

    //     foreach ($tables AS $table)
    //     {
    //         $this->mysql_disable_cache_tables[] = $table;
    //     }

    //     array_unique($this->mysql_disable_cache_tables);
    // }
    
	// public function error(){
	// 	return mysql_error($this->link ? $this->link : null);
	// }

	// public function errno(){
	// 	return mysql_errno($this->link ? $this->link : null);
	// }

	// public function result($query, $row){
	// 	return mysql_result($query, $row);
	// }

	// public function numRows($query){
	// 	return mysql_num_rows($query);
	// }

	// public function numFields($query){
	// 	return mysql_num_fields($query);
	// }

	// public function freeResult(){
	// 	return mysql_free_result($this -> queryRes);
	// }

	 public function insertId(){
		return ($id = mysql_insert_id($this->link)) >= 0 ? 
		       $id : 
		       $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	// public function fetchRow($query){
	// 	return mysql_fetch_row($query);
	// }

	// public function fetchFields($query){
	// 	return mysql_fetch_field($query);
	// }

	public function version(){
		return mysql_get_server_info($this->link);
	}

	// public function close(){
	// 	return mysql_close($this->link);
	// }

	public function halt($message = '',$sql = ''){
		$sqlerror = mysql_error();
		$sqlerrno = mysql_errno();
		$sqlerror = str_replace($this -> db_host,'dbhost',$sqlerror);
		throw new exception($sqlerror.$sql);
		exit;
	}
}