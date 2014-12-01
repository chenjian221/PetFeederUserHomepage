<?php
	include 'db_helper.php';

/*class TutorData
{
	
	function create ($ID,$name, $gender,$phone,$email,$class,$year,$major,$password,$verified)
	{
		$data = array(
			'ID' => $categoryID,
            'name' => $name,
            'gender'=> $gender,
            'phone' => $phone,
            'email' => $email, 
            'class' => $class,
            'year' => $year,
            'major' => $major,
            'password' => $password,
            'verified' => $verified
       	);
		$this->load->database();
		$this->db->insert('Tutor', $data);
		$affectRows = $this->db->affected_rows();
		$this->db->close();
		return $affectRows;
	}
}

class Tutor
{
	
	function create($ID,$name, $gender,$phone,$email,$class,$year,$major,$password,$verified)
	{
		$insertedRows = TutorData::create($ID,$name, $gender,$phone,$email,$class,$year,$major,$password,$verified);
		$success = ($insertedRows == 1) ? true : false;
		return $success;
	}
}*/








	if($_GET['f']=='add'&&$_GET['name']&&$_GET['gender']&&$_GET['phone']&&$_GET['email']&&$_GET['class']&&$_GET['year']&&$_GET['major']&&$_GET['password'])
	{
		addTutor($_GET['name'], $_GET['gender'], $_GET['phone'],$_GET['email'],$_GET['class'], $_GET['year'],$_GET['major'],$_GET['password']);
	}else if($_GET['f']=='get'&&$_GET['email']){
		getTutor($_GET['email']);
	}elseif ($_GET['f']=='get'&&$_GET['tid']) {
		getTutorInfo($_GET['tid']);
	}
	else if($_GET['f']=='update'&&$_GET['name']&&$_GET['gender']&&$_GET['phone']&&$_GET['email']&&$_GET['class']&&$_GET['year']&&$_GET['major']&&$_GET['password']&&$_GET['tid']){
		updateTutor($_GET['name'], $_GET['gender'], $_GET['phone'],$_GET['email'],$_GET['class'], $_GET['year'],$_GET['major'],$_GET['password'],$_GET['tid']);
	}else if($_GET['f']=='list'&&$_GET['email']){
		listTutorsByEmail($_GET['email']);
	}else if($_GET['f']=='list'&&$_GET['name']){
		listTutorByName($_GET['name']);
	}else if($_GET['f']=='list'&&$_GET['major']){
		listTutorByMajor($_GET['major']);
	}else if($_GET['f']=='list'){
		listTutor();
	}else{
		echo $_GET['gender'];
	}
	function getTutorInfo($tid)
	{
		$dbQuery = sprintf("SELECT * FROM Tutor WHERE ID = '%d' ", $tid);
		$result = getDBResultsArray($dbQuery);
		echo json_encode($result);
	}
	function listTutor(){
		$dbQuery = sprintf("SELECT * FROM Tutor");
		$result = getDBResultsArray($dbQuery);
		echo json_encode($result);
	}

	function listTutorByMajor($major){
		$dbQuery = sprintf("SELECT Id,Name,gender,phone,email,class,year,major FROM Tutor WHERE Major = '%d'", $major);
		//$dbQuery = sprintf("SELECT Id,Name, gender FROM Tutor WHERE major = '%d'", $major);
		$result = getDBResultsArray($dbQuery);
		echo json_encode($result);
	}
	function listTutorByName($name){
		$dbQuery = sprintf("SELECT Id,name,gender,phone,email,class,year,major FROM Tutor WHERE name = '%s'", 
mysql_real_escape_string($name));
		$result = getDBResultsArray($dbQuery);
		echo json_encode($result);
	}


	function listTutorsByEmail($email){
		$dbQuery = sprintf("SELECT id,name,gender,phone,email,class,year,major FROM Tutor WHERE email = '%s'", 
mysql_real_escape_string($email));
		$result = getDBResultsArray($dbQuery);
		echo json_encode($result);
	}

	function addTutor($name,$gender,$phone,$email,$class,$year,$major,$password)
	{
		$dbQuery = sprintf("INSERT INTO Tutor (name,gender, phone, email, class, year, major,password) VALUES ('%s','%d', '%d', 
'%s', '%d', '%d', '%d',%s)", mysql_real_escape_string($name), $gender, $phone, mysql_real_escape_string($email), $class, $year, $major,mysql_real_escape_string($password));
		$result = getDBResultInserted($dbQuery, 'ID');
		echo json_encode($result);
	}

	function getTutor($email){
		$dbQuery = sprintf("SELECT * FROM Tutor WHERE email = '%s'", mysql_real_escape_string($email));
		$result = getDBResultsArray($dbQuery);	
		echo json_encode($result);
	}

	function updateTutor($name,$gender,$phone,$email,$class,$year,$major,$password,$id){
		echo $id;
		$dbQuery = sprintf("UPDATE Tutor SET name = '%s', gender = '%d', phone = '%d', class = '%d', year = '%d', major = '%d', email = '%s', password = '%s' WHERE id = '%d'", mysql_real_escape_string($name),$gender,$phone,$class,$year,$major,mysql_real_escape_string($email),mysql_real_escape_string($password),$id);
		$result = getDBResultAffected($dbQuery);
		echo json_encode($result);
	
	}
?>
