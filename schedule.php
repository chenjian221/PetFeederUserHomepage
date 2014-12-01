<?php 
	include 'db_helper.php';
	if($_GET['f']=='add'&&$_GET['p1']&&$_GET['p2']&&$_GET['p3']&&$_GET['p4']) {
   		addSchedule($_GET['p1'],$_GET['p2'],$_GET['p3'],$_GET['p4']);
	} elseif ($_GET['f']=='get'&&$_GET['p1']) {
		getSchedule($_GET['p1']);
	} elseif ($_GET['f']=='del'&&$_GET['p1']&&$_GET['p2']&&$_GET['p3']&&$_GET['p4']) {
		deleteSchedule($_GET['p1'],$_GET['p2'],$_GET['p3'],$_GET['p4']);
	}
	function addSchedule($TID,$Day,$Start,$End)
	{
		$dbQuery = sprintf("INSERT INTO Schedule (TID,Day,Start,End) VALUES ('%d','%s','%d','%d')",
			$TID,mysql_real_escape_string($Day),$Start,$End);
	
		$result = getDBResultInserted($dbQuery,'TID');
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	function deleteSchedule($TID,$Day,$Start,$End)
	{
		$dbQuery = sprintf("DELETE  from Schedule WHERE TID ='%d', Day='s%', Start='%d', End='%d'",
			$TID,mysql_real_escape_string($Day),$Start,$End);
	
		$result = getDBResultInserted($dbQuery,'TID');
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
	function getSchedule($TID,$Day,$Start,$End)
	{
		$dbQuery = sprintf("SELECT * from Schedule WHERE TID ='%d'",
			$TID,mysql_real_escape_string($Day),$Start,$End);
	
		$result = getDBResultInserted($dbQuery,'TID');
		
		//header("Content-type: application/json");
		echo json_encode($result);
	}
 ?>