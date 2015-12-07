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

#echo $username.'<br>';
#echo $userpassword.'<br>';

$query = "SELECT ID FROM User_Info WHERE NAME = '$username' && PASSWORD = '$userpassword'";
$result = mysql_query($query);
if (!$result) {
    die('Query failed: ' . mysql_error());
}
else{
	#echo 'find user ID: <br>'; 
	$row= mysql_fetch_row($result);
	#echo $row[0];
}


$_SESSION["usrID"]= $row[0];

header("Location:http://www.cs.codes/dogfeeder_php/input.php"); 


?>