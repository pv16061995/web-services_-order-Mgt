<?php
ob_start();
session_start();
$iLocal = 0;
if ($iLocal == 0)
{
	define('MYSQLDB_HOST' , 'localhost');
	define('MYSQLDB_USER' , 'root');
	define('MYSQLDB_PASS' , '');
	define('MYSQLDB_DATABASE', 'order_mgmt');
	define('MYSQLDB_PORT' , 3306);
	define('SUBFOLDER','order_mgm/');
	define('BASEPATH','http://localhost'.SUBFOLDER);
	        
}

date_default_timezone_set("Asia/Calcutta");
 
$con=mysql_connect(MYSQLDB_HOST,MYSQLDB_USER,MYSQLDB_PASS);
mysql_select_db(MYSQLDB_DATABASE,$con);

$conn = new PDO('mysql:host='.MYSQLDB_HOST.';dbname='.MYSQLDB_DATABASE.'', MYSQLDB_USER, MYSQLDB_PASS); 
?>
	