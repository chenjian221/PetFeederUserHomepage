<?php 
	include 'db_helper.php';

	if($_GET['f']=='add'&&$_GET['sid']&&$_GET['tid']&&$_GET['class']&&$_GET['duration']) {
   		addTransaction($_GET['sid'],$_GET['tid'],$_GET['class'],$_GET['duration']);
	} elseif ($_GET['f']=='get'&&$_GET['p1']) {
		getTransaction($_GET['p1']);
	} elseif ($_GET['f']=='upd'&&$_GET['p1']&&$_GET['p2']&&$_GET['p3']&&$_GET['p4']) {
		updateTransaction($_GET['p1'],$_GET['p2'],$_GET['p3'],$_GET['p4']);
	} elseif ($_GET['f']=='list'&&$_GET['sid']&&$_GET['con']) {
		listTransaction($_GET['sid'],$_GET['con']);
	} elseif ($_GET['f']=='list'&&$_GET['tid']&&$_GET['con']) {
		listTransactionWithTutorID($_GET['tid'],$_GET['con']);
	} elseif ($_GET['f']=='con'&&$_GET['tid']&&$_GET['sid']&&$_GET['rate']&&$_GET['class']) {
		confirmTrasaction($_GET['tid'],$_GET['sid'],$_GET['rate'],$_GET['class']);
	}
	function confirmTrasaction($tid,$sid,$rate,$class) {
		$dbQuery = sprintf("UPDATE Transaction SET rate='%d', Confirmed = '%d' WHERE S_ID = '%d'AND T_ID = '%d' AND Class = '%d'",
			$rate,1,$sid,$tid,$class);
		$result = getDBResultAffected($dbQuery);
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	function getTransaction($email) {
		$dbQuery = sprintf("SELECT name FROM Transaction WHERE email = '%s'",
			mysql_real_escape_string($email));//
		$result=getDBResultRecord($dbQuery);
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	function listTransaction($sid,$con) {
		$dbQuery = sprintf("SELECT T_ID,Class,Rate FROM Transaction WHERE S_ID = '%d'AND Confirmed = '%d' ",
			$sid,$con);
		$result = getDBResultsArray($dbQuery);	
		echo json_encode($result);
	}
	function listTransactionWithTutorID($sid,$con) {
		$dbQuery = sprintf("SELECT S_ID,Duration,Class,Rate FROM Transaction WHERE T_ID = '%d'AND Confirmed = '%d' ",
			$sid,$con);
		$result = getDBResultsArray($dbQuery);	
		echo json_encode($result);
	}
	function addTransaction($sid,$tid,$class,$duration) {
		$dbQuery = sprintf("INSERT INTO Transaction (S_ID,T_ID,Class,Duration) VALUES ('%d','%d','%d','%d')",
			$sid,$tid,$class,$duration);
		$result = getDBResultInserted($dbQuery,'ID');
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	
	function updateTransaction($name,$gender,$email,$phone) {
		$dbQuery = sprintf("UPDATE Transaction SET name = '%s',gender='%d',phone='%d' WHERE email = '%s'",
			mysql_real_escape_string($name),
			$gender,$phone,
			mysql_real_escape_string($email));
		
		$result = getDBResultAffected($dbQuery);
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
 ?>