<?php
$mysql_hostname = "localhost";
$mysql_user = "dste2385_dnyanu";
$mysql_password = "d11s8t8dnyanu";
$mysql_database = "dste2385_TEST";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Error on database connection");
?>