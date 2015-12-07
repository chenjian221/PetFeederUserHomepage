<?php
session_start();

include 'db_credentials.php';
	
$connection = mysql_connect(
	$db_host,
	$db_username,
	$db_password
);

if(!$connection){
	die("Error connecting to the database.<br/><br/>" . 		
	mysql_error());
}

$db_select = mysql_select_db($db_database);
if(!$db_select){
	die("Error with finding the database.<br/><br/>".mysql_error());
}

$username=$_POST['username'];
$userpassword=$_POST['userpassword'];


$query = "INSERT INTO User_Info (NAME,PASSWORD,POUNDS,AGE,freq,per) VALUES('$username','$userpassword',0,0,0,0)";
$result = mysql_query($query);
if (!$result) {
    die('Query failed: ' . mysql_error());
}
else{
	
}


header("Location:http://192.168.0.144/dogfeeder_php/login.html"); 


?>