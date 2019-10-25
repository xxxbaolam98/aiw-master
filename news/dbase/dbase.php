<?php
session_start();
$db = mysqli_connect('localhost','root','','news');
if(mysqli_connect_error()){
	echo 'Database connection failed with following error: '.mysqli_connect_error();
	die();

}
?>