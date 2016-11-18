<?php

//创建mysql操作类

  class MYSQL{
    protected $link;             //数据库连接
    protected $resource;         //查询获取的结果集
    public    $pconnect = false; //是否使用长连接
    public    $errdesc	= "";
    public    $errno	= 0;
	
    /*建立连接 
	 *参数$dbconf 数组(连接地址，user，pwd,database)
    */
    public function __construct($dbconf){
        if($this->pconnect){
            @$this->link = mysql_pconnect($dbconf['conn'],$dbconf['user'],$dbconf['pwd']);
        }else{
            @$this->link = mysql_connect($dbconf['conn'],$dbconf['user'],$dbconf['pwd']);
        }
		
        if ( !$this->link ){
        	$this->db_error("数据库连接失败！", "不能连接数据库服务器，请稍后再试！");
        }
        if ( !mysql_select_db($dbconf['db'],$this->link) ){
        	$this->db_error("打开数据库失败！", "不能打开指定的数据库，请稍后再访问");
        }
		//mysql_query("SET NAMES 'GBK'");
		mysql_query("SET NAMES 'UTF8'");
		mysql_query("SET CHARACTER SET UTF8");
		mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
        return true;
    }
    
    //取得上一步 INSERT 操作产生的 ID
    
    function insert_id(){
    	return mysql_insert_id($this->link);
    }
    
    //取得查询结果集中行的数目，仅对 SELECT 语句有效
    
    function num_rows() {
    	return mysql_num_rows($this->resource);
    }
	
	//取得操作后受影响的行数
	
	function affected_rows() {
		return mysql_affected_rows($this->link);
	}
    
    /*统计表中记录数
    * 参数 $table 字符串类型
	* 参数 $where 字符串类型
	*/
    function row_count($table, $where=""){
    	$sql = "SELECT count(*) as row_sum FROM `".$table."` ".($where?" WHERE ".$where:"");
    	$row = $this->assoc_query($sql);
    	return $row[0]["row_sum"];
    }
	
    /* 添加操作(直接传入sql) 返回受影响的行数；
	* 参数 $sql  字符串类型
    */
	
    public function insert_query($sql){
        mysql_query($sql);
        return $this->affected_rows();
    }
    
    /*修改操作(直接传入sql) 返回受影响行数
    * 参数 $sql  字符串类型
    */
	
    public function update_query($sql){
        mysql_query($sql);
        return $this->affected_rows();
    }
    
    /* 删除操作(直接传入sql)  返回受影响行数
     * 参数 $sql  字符串类型
    */
	
    public function delete_query($sql){
        mysql_query($sql);
        $affected_rows = mysql_affected_rows($this->link);
        return $affected_rows;
    }
    
    /* 查询操作(直接传入sql)，返回关联数组；
     * 参数 $sql  字符串类型
    */
    public function assoc_query($sql){
        $this->resource = mysql_query($sql);
		$row = array();
		while($result = mysql_fetch_assoc($this->resource)){
			$row[] = $result;
		}
		return $row;
    }
    
    /* 查询操作(直接传入sql)，返回索引数组；
     * 参数 $sql  字符串类型
    */
    public function row_query($sql) {
        $this->resource = mysql_query($sql);
		$row = array();
		while($result = mysql_fetch_row($this->resource)){
			$row[] = $result;
		}
		return $row;
    }
    
    /* 插入操作 返回添加的自增长Id  
     * 参数 $table  字符串类型(要插入的数据表名)
	 * 参数 $row    数组类型(将表字段（数组的键）与插入的值（数组的值）写入数组)
    */
    public function insert($table,$row){
        $k = array_keys ( $row );
		$v = array_values ( $row );
		$keys = join ( ",", $k );
		$values = join ( "','", $v );
        $sql = "INSERT INTO `".$table."`(".$keys.") VALUES ('".$values."')";
        return $this -> insert_query($sql);
    }
    
    /* 修改操作 返回受影响行数 
     * 参数 $table  字符串类型(修改的表名)
	 * 参数 $row    数组类型  (将表字段（数组的键）与插入的值（数组的值）写入数组)
	 * 参数 $where  字符串类型 （修改的条件）[可选参数]
	*/
    public function update($table,$update,$where = ''){
        $sqlud="";
        foreach ($update as $key=>$value) {
           $sqlud .= $key."= '".$value."',";
        }
		if($where){
            $sql = "UPDATE `".$table."` SET ".substr($sqlud, 0, -1)." WHERE ".$where;
        }else{
            $sql = "UPDATE `".$table."` SET ".substr($sqlud, 0, -1);
        }
       
        return $this->update_query($sql);
        
    }
    
    /* 查询操作（传入部分变量）返回二维索引数组  
     * 参数 $table    字符串类型(查询的表名) 
	 * 参数 $fields   字符串类型（查询的字段）
	 * 参数 $where    字符串类型（查询的条件）[可选参数]
	*/
    public function row($table,$fields,$where = ''){
        if($where){
           $sql = 'select '.$fields.' from '.$table.' where '.$where;
        }else{
           $sql = 'select '.$fields.' from '.$table;
        }
        return $this->row_query($sql);
    }
    
    /* 查询操作（传入部分变量）返回二维关联数组 
     * 参数 $table    字符串类型(查询的表名) 
	 * 参数 $fields   字符串类型（查询的字段）
	 * 参数 $where    字符串类型（查询的条件）[可选参数]
	*/
    public function assoc($table,$fields,$where = ''){
        if($where){
           $sql = 'select '.$fields.' from '.$table.' where '.$where;
        }else{
           $sql = 'select '.$fields.' from '.$table;
        }
        return $this->assoc_query($sql); 
    }
    
    /* 删除操作 返回受影响行数 
     * 参数 $table    字符串类型(删除的表名)
     * 参数 $where    字符串类型（删除的条件）
	*/
    public function delete($table,$where){
            $sql = 'delete from '.$table.' where '.$where;
            return $this->delete_query($sql);
    }
	
	public function get_one($table,$where)
	{
		$sql='select * from '.$table.' where '.$where . ' limit 1';
		//echo $sql;
		$rs=$this->assoc_query($sql);
		if($rs) $rs=$rs[0];
		return $rs;
	}

    //析构函数 释放结果集 关闭数据库普通连接
    
    public function __destruct(){
        if($this->resource != ''){
            mysql_free_result($this->resource);
        }
		if($this->link != ''){
			mysql_close($this->link);
		}
    }
	
	/* 错误提示
	 * 参数 $err_title  字符串类型
	 * 参数 $err_body   字符串类型
	*/
	
	private function db_error($err_title, $err_body) {

		$this->errdesc = mysql_error();

		$this->errno   = mysql_errno();

		$message  = "";

		$message.=" 出现数据库错误: $err_title \n<br/>";

		$message.=" 数据库错误内容: $err_body \n<br/>";

		$message.="MySQL错误: $this->errdesc \n<br/>";

		$message.="MySQL错误号码: $this->errno \n<br/>";

		$message.="日期: ".date("l dS of F Y h:i:s A")."\n<br/>";

		$message.="脚本: ".getenv("REQUEST_URI")."\n<br/>";

		$message.="来自: ".getenv("HTTP_REFERER")."\n<br/>";
		
		  echo "\n 错误报告\n\n $message\n\n";

		  echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family: '宋体'; font-size: 9pt; line-height: 150%\">\n";

		  echo "  <tr bgcolor=\"#6699FF\"> \n";

		  echo "    <td colspan=\"3\" height=\"22\" align=\"center\"> $err_title &nbsp;</td>\n";

		  echo "  </tr>\n";

		  echo "  <tr> \n";

		  echo "    <td colspan=\"3\" height=\"1\" bgcolor=\"#000000\"></td>\n";

		  echo "  </tr>\n";

		  echo "  <tr> \n";

		  echo "    <td width=\"1\" bgcolor=\"#000000\"></td>\n";

		  echo "    <td width=\"178\" height=\"60\">\n";

		  echo "     1、$err_body <br> \n";

		  echo "     &nbsp;\n";

		  echo "    </td>\n";

		  echo "    <td width=\"1\" bgcolor=\"#000000\"></td>\n";

		  echo "  </tr>\n";

		  echo "  <tr> \n";

		  echo "    <td colspan=\"3\" height=\"1\" bgcolor=\"#000000\"></td>\n";

		  echo "  </tr>\n";

		  echo "</table>\n";

		  exit();

	  }
	  
	
 }

?>