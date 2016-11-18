<?php

define('DEDEINC', str_replace("\\", '/', dirname(__FILE__) ) );
define('DEDEROOT', str_replace("\\", '/', substr(DEDEINC,0,-11) ) );
define('DEDEDATA', DEDEROOT.'/data');
define('DEDETEMPLATE', DEDEROOT.'/templets');

require_once DEDEINC.'../sqlin.php';
require_once DEDEINC.'../config.php';
require_once DEDEINC.'/../class/mysql.class.php';
if(!$mydb) $mydb = new MYSQL($dbconf);
?>