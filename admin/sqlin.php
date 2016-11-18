<?php

/* 过滤所有GET过来变量------------------------------------------------------------- */
foreach ($_GET as $get_key=>$get_var) 
{ 
if (is_numeric($get_var)) { 
$get[strtolower($get_key)] = get_int($get_var); 
} else { 
$get[strtolower($get_key)] = get_str($get_var); 
} 
} 
    
/* 过滤所有POST过来的变量 */
foreach ($_POST as $post_key=>$post_var) 
{ 
if (is_numeric($post_var)) { 
$post[strtolower($post_key)] = get_int($post_var); 
} else { 
$post[strtolower($post_key)] = get_str($post_var); 
} 
} 
    
/* 过滤函数 */
//整型过滤函数 
function get_int($number){ 
    return intval($number); 
} 
//字符串型过滤函数 
function get_str($string){
    return $string; 
}


function wjStrFilter($str,$pi_Def="",$pi_iType=1){

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
	//$str=str_replace("chr(9)","&nbsp;",$str);
	//$str=str_replace("chr(10)chr(13)","<br />",$str);
	//$str=str_replace("chr(10)","<br />",$str);
	//$str=str_replace("chr(13)","<br />",$str);
	//$str=str_replace("chr(32)","&nbsp;",$str);
	//$str=str_replace("chr(34)","&quot;",$str);
	//$str=str_replace("chr(39)","&#39;",$str);
	//$str=str_replace("script", "&#115cript",$str);
	//$str=str_replace("&","&amp;",$str);
	//$str=str_replace(";","&#59;",$str);
	//$str=str_replace("'","&#39;",$str);
	//$str=str_replace("<","&lt;",$str);
	//$str=str_replace(">","&gt;",$str);
	//$str=str_replace("#","&#40;",$str);
	//$str=str_replace("*","&#42;",$str);
	//$str=str_replace("--","&#45;&#45;",$str);
	
	$str=preg_replace("/insert/i", "",$str);
	$str=preg_replace("/update/i", "",$str);
	$str=preg_replace("/delete/i", "",$str);
	$str=preg_replace("/select/i", "",$str);
	$str=preg_replace("/drop/i", "",$str);
	$str=preg_replace("/load_file/i", "",$str);
	$str=preg_replace("/outfile/i", "",$str);
	$str=preg_replace("/into/i", "",$str);
	$str=preg_replace("/exec/i", "",$str);
	$str=preg_replace("/xy_/i", "",$str);
	$str=preg_replace("/union/i", "",$str);
	//$str=preg_replace("/%/i", "",$str);
	
	if (get_magic_quotes_gpc()){
		//$str = str_replace("\\\"", "&quot;",$str);
		//$str = str_replace("\\''", "&#039;",$str);
	}else{
		$str = addslashes($str);
		//$str = str_replace("\"", "&quot;",$str);
		//$str = str_replace("'", "&#039;",$str);
		
	}
	$str=mysql_escape_string($str);
}
return $str;
}
?>