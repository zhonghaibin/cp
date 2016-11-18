<?php
//
header('content-Type: text/html;charset=utf-8');
//header("Cache-Control:no-cache");
error_reporting(E_ERROR & ~E_NOTICE);
date_default_timezone_set('PRC'); //标准化时间
error_reporting(0);
ini_set('display_errors', 'Off');

//数据库配置
$dbconf = array("conn"=>"localhost", "user"=>"root", "pwd"=>"root", "db"=>"xy_yule");
$conf['db']['prename']='xy_'; //表前缀
$conf['cache']['expire']=0;
$conf['cache']['dir']='/_cache/';
$conf['member']['sessionTime']=15*60;	// 用户有效时长
?>