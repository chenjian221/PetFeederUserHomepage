<?php
	include 'db_helper.php';
	
	if($_GET['f']=='add'&&$_GET['name']&&$_GET['gender']&&$_GET['email']&&$_GET['phone']) {
   		addStudent($_GET['name'],$_GET['gender'],$_GET['email'],$_GET['phone']);
	} elseif ($_GET['f']=='get'&&$_GET['email']) {
		getStudent($_GET['email']);
	} elseif ($_GET['f']=='update'&&$_GET['name']&&$_GET['gender']&&$_GET['phone']&&$_GET['sid']) {
		updateStudent($_GET['name'],$_GET['gender'],$_GET['phone'],$_GET['sid']);
	} elseif ($_GET['f']=='get'&&$_GET['sid']) {
		getStudentInfo($_GET['sid']);
	}


	
	
	function getStudent($email) {
		$dbQuery = sprintf("SELECT ID FROM Student WHERE email = '%s'",
			mysql_real_escape_string($email));//
		$result=getDBResultRecord($dbQuery);
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	
	function addStudent($name,$gender,$email,$phone) {
		$dbQuery = sprintf("INSERT INTO Student (name,gender,email,phone) VALUES ('%s','%d','%s','%d')",
			mysql_real_escape_string($name),$gender,mysql_real_escape_string($email),$phone);
		$result = getDBResultInserted($dbQuery,'ID');
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	
	function updateStudent($name,$gender,$phone,$sid) {
		$dbQuery = sprintf("UPDATE Student SET name = '%s',gender='%d',phone='%d' WHERE ID = '%d'",
			mysql_real_escape_string($name),
			$gender,$phone,$sid);
		
		$result = getDBResultAffected($dbQuery);
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	function getStudentInfo($sid){
		$dbQuery = sprintf("SELECT * FROM Student WHERE ID = '%d' ", $sid);
		$result = getDBResultsArray($dbQuery);
		echo json_encode($result);
	}
	/*function deleteStudent($name) {
		$dbQuery = sprintf("DELETE FROM Student WHERE name = '%s'",
			mysql_real_escape_string($name));												
		$result = getDBResultAffected($dbQuery);
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	function lisStudent() {
		$dbQuery = sprintf("SELECT id,name FROM Student");
		$result = getDBResultsArray($dbQuery);
		//header("Content-type: application/json");
		echo json_encode($result);
	}*/
?>
