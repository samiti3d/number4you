<?php 
include("admin/module/connect.php");

$sqlCommand = "CREATE TABLE man(
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(25) NOT NULL,
	password varchar(25) NOT NULL,
	last_log_date date NOT NULL,
	UNIQUE KEY username(username))";

if (mysql_query($sqlCommand)) {
	echo "Admin Created";
}else{
	echo "ERRORrrrr!";
}

?>

