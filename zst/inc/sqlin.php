<?php

//php sql防注入代码

class sqlin
{

	function dowith_sql($str)
	{
	   $str = str_replace("and","",$str);
	   $str = str_replace("execute","",$str);
	   $str = str_replace("update","",$str);
	   $str = str_replace("count","",$str);
	   $str = str_replace("chr","",$str);
	   $str = str_replace("mid","",$str);
	   $str = str_replace("master","",$str);
	   $str = str_replace("truncate","",$str);
	   $str = str_replace("char","",$str);
	   $str = str_replace("declare","",$str);
	   $str = str_replace("select","",$str);
	   $str = str_replace("create","",$str);
	   $str = str_replace("delete","",$str);
	   $str = str_replace("insert","",$str);
	   $str = str_replace("'","",$str);
	   $str = str_replace(" ","",$str);
	   $str = str_replace("or","",$str);
	   $str = str_replace("=","",$str);
	   $str = str_replace("%20","",$str);
	   return $str;
	}
	
	function sqlin()
	{
	   foreach ($_GET as $key=>$value)
	   {
		   $_GET[$key]=$this->dowith_sql($value);
	   }
	   foreach ($_POST as $key=>$value)
	   {
		   $_POST[$key]=$this->dowith_sql($value);
	   }
	}
}
//stripslashes（）函数转换一下，可以把(\'0\',\'1\',\'3\',\'5\')转换为('0','1','3','5')
$dbsql=new sqlin();


function keyiStrFilter($str,$pi_Def="",$pi_iType=1){

 if ( isset($_GET[$str]) )
    $str = trim($_GET[$str]);
  else if ( isset($_POST[$str]))
    $str = trim($_POST[$str]);
  else if ($str)
    $str = trim($str);
  else
    return $pi_Def;
	// INT
  if ($pi_iType==0)
  {
    if (is_numeric($str))
      return $str;
    else
      return $pi_Def;
  }
  
 // String
if($str){
	$str=str_replace("chr(9)","&nbsp;",$str);
	$str=str_replace("chr(10)chr(13)","<br />",$str);
	$str=str_replace("chr(10)","<br />",$str);
	$str=str_replace("chr(13)","<br />",$str);
	$str=str_replace("chr(32)","&nbsp;",$str);
	$str=str_replace("chr(34)","&quot;",$str);
	$str=str_replace("chr(39)","&#39;",$str);
	$str=str_replace("script", "&#115cript",$str);
	$str=str_replace("&","&amp;",$str);
	$str=str_replace(";","&#59;",$str);
	$str=str_replace("'","&#39;",$str);
	$str=str_replace("<","&lt;",$str);
	$str=str_replace(">","&gt;",$str);
	$str=str_replace("#","&#40;",$str);
	$str=str_replace("*","&#42;",$str);
	$str=str_replace("--","&#45;&#45;",$str);
	
	$str=preg_replace("/insert/i", "",$str);
	$str=preg_replace("/update/i", "",$str);
	$str=preg_replace("/delete/i", "",$str);
	$str=preg_replace("/exec/i", "",$str);
	
	if (get_magic_quotes_gpc()){
		$str = str_replace("\\\"", "&quot;",$str);
		$str = str_replace("\\''", "&#039;",$str);
	}
	else{
		$str = str_replace("\"", "&quot;",$str);
		$str = str_replace("'", "&#039;",$str);
	}
	$str=mysql_escape_string($str);
	
	
}
return $str;
}
?>