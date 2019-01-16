<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','dbalerrt');
 
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die ("Could not connect to MySQL. Please try again!");
$appUrl = "http://192.168.1.6/ALERRT/mobile_app/";
?>