<?php
$urla = $_SERVER['REQUEST_URI'];
$urla = str_replace("/", "---", $urla);
$urla = str_replace("&", "____", $urla);
$urla = str_replace("?", ":::", $urla);

$hostname_localhost = "localhost";
$database_localhost = "yui_database";
$username_localhost = "root";
$password_localhost = '1234';
$localhost = mysql_pconnect($hostname_localhost, $username_localhost, $password_localhost) or trigger_error(mysql_error(),E_USER_ERROR); 

function begintrans() 
{
mysql_query("BEGIN",$localhost);
}
function committrans() 
{
mysql_query("COMMIT",$localhost);
}
function rollbacktrans()
{
mysql_query("ROLLBACK",$localhost);
}

?>