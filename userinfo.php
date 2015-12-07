<?php 
	include 'db_helper.php';
	if($_GET['f']=='getfood'&&$_GET['id']) {
   		getFood($_GET['id']);
	}
	function getFood($user){
		$dbQuery = sprintf("SELECT freq , per from User_Info where ID = '%s'",
			mysql_real_escape_string($user));
		$result = getDBResultRecord($dbQuery);
		echo json_encode($result);
	}
 ?>