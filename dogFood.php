<?php 
	include 'db_helper.php';
	if($_GET['f']=='add'&&$_GET['user']&&$_GET['pw']) {
   		addUser($_GET['user'],$_GET['pw']);
	}
	function addUser($user,$pw){
		$dbQuery = sprintf("Insert into User_Info where NAME = '%s'and PASSWORD = '%s'",
			mysql_real_escape_string($user),
			mysql_real_escape_string($pw));
		$result = getDBResultInserted($dbQuery);
		echo json_encode($result);
	}
 ?>