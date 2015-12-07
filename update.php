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

$usrID=$_SESSION["usrID"];

?>

<?php

$AP=$_POST['AP'];
$AG=$_POST['AG'];
$FT=$_POST['FT'];
$CU=$_POST['CU'];
$IFGET=$_POST['IFGET'];

if($IFGET=='Yep'){
	switch ($AG){
		case "1":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='1.5_3'";
		break;
		case "2":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='1.5_3'";
		break;
		case "3":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='1.5_3'";
		break;
		case "4":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='4_5'";
		break;
		case "5":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='4_5'";
		break;
		case "6":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='6_8'";
		break;
		case "7":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='6_8'";
		break;
		case "8":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='6_8'";
		break;
		case "9":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='9_11'";
		break;
		case "10":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='9_11'";
		break;
		case "11":
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='9_11'";
		break;
		default:
		$query = "SELECT * FROM Purina_ChickenRice_age_food WHERE Age='12_over'";
		break;
	}
	$result = mysql_query($query);
	if (!$result) {
    	die('Query failed: ' . mysql_error());
	}

	$row= mysql_fetch_row($result);
/*	echo $row;
	echo $row[0].'<br>';
	echo $row[1].'<br>';
	echo $row[3].'<br>';
	echo $row[4].'<br>';
	$tmp=(intval($row[1]*100)/100.00);
	echo $tmp;

	$tmp=intval($AP);
	if ($tmp<=12){
		#$CU=(floatval(row[2])-floatval(row[1]));
		$tmp=$tmp+1;
		echo "haha";

	}*/
	$tmp=intval($AP);
	if ($tmp<=12){
		$t1=intval($row[1]*100)/100.0;
		$t2=intval($row[2]*100)/100.0;
		$CU=$t1+($t2-$t1)*$tmp/12.0;
	}
	elseif($tmp>12 && $tmp<=20){
		$t1=intval($row[3]*100)/100.0;
		$t2=intval($row[4]*100)/100.0;
		$CU=$t1+($t2-$t1)*($tmp-12.0)/(20-12.0);
	}
	elseif($tmp>20 && $tmp<=50){
		$t1=intval($row[5]*100)/100.0;
		$t2=intval($row[6]*100)/100.0;
		$CU=$t1+($t2-$t1)*($tmp-20.0)/(50-20.0);
	}
	elseif($tmp>50 && $tmp<=75){
		$t1=intval($row[7]*100)/100.0;
		$t2=intval($row[8]*100)/100.0;
		$CU=$t1+($t2-$t1)*($tmp-50.0)/(75-50.0);
	}
	elseif($tmp>75 && $tmp<=100){
		$t1=intval($row[9]*100)/100.0;
		$t2=intval($row[10]*100)/100.0;
		$CU=$t1+($t2-$t1)*($tmp-75.0)/(100-75.0);
	}
	else{
		$t1=intval($row[11]*100)/100.0;
		$t2=intval($row[12]*100)/100.0;
		$CU=$t1+ (($tmp-100)/10.0)*$t2;
	}
	$CU=$CU/$FT;
}




#$query = "SELECT POUNDS,AGE,freq,per FROM User_Info WHERE ID =".$usrID;
#$query = "UPDATE User_Info SET POUNDS＝".$AP.",AGE=".$AG.",freq=".$FT.",per=".$CU." WHERE ID=".$usrID;
$query = "UPDATE User_Info SET POUNDS=$AP, AGE=$AG ,freq=$FT, per=$CU WHERE ID=$usrID";

$result = mysql_query($query);

if (!$result) {
    die('Query failed: ' . mysql_error());
}

?>

<html>
  <head>

   </head>
   <body>

   <div align="left"><font size="3" color="#000040"><strong>UPDATE SUCCESSFUL</strong></font></div><br>

   <a href="input.php">RETURN TO CHECK DATA</a>


   </body>
</html>