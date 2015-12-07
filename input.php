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
$query = "SELECT POUNDS,AGE,freq,per FROM User_Info WHERE ID =$usrID";
$result = mysql_query($query);

if (!$result) {
    die('Query failed: ' . mysql_error());
}
else{
	$row= mysql_fetch_row($result);
	
}

?>


<html>
  <head>

   </head>
   <body>

<div align="center"><font size="7"><strong><font color="#800040">DogFeeder</font><br></strong></font><br></div>
<div align="center"><font size="4" color="#800040"><strong> Welcome  and  Happy  Holiday </strong></font></div>
<hr width="100%" size="4">
<hr width="100%" size="4">
<div align="left"><font size="3" color="#000040"><strong>Check your data here</strong></font></div> 
<br><br>

<?php 
echo "your userID is :             ".$usrID.'<br>';
echo "Adult Pounds :               ".$row[0].'<br>';
echo "Dog Age :                    ".$row[1].'    months <br>';
echo "Feeding Times :              ".$row[2].'    per day<br>';
echo "Cups Per Meal :              ".$row[3].'<br>';
?>
<br><br>

<div align="left"><font size="3" color="#000040"><strong>Update</strong></font></div><br>

<form action="update.php"  method=post  name=form>
    
    <div align="left"><font size="3" color="#000040"><strong>Adult Pounds</strong></font>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="AP" value="<?php echo $row[0];?>" ><br>
    </div>
    
    <div align="left"><font size="3" color="#000040"><strong>Dog Age</strong></font>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="AG" value="<?php echo $row[1];?>" ><br>
    </div>

    <div align="left"><font size="3" color="#000040"><strong>Feeding Times</strong></font>
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="FT" value="<?php echo $row[2];?>" ><br>
    </div>

    <div align="left"><font size="3" color="#000040"><strong>Cups Per Meal</strong></font>
    &nbsp;&nbsp;&nbsp;<input type="text" name="CU" value="<?php echo $row[3];?>" >

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="IFGET" value="Yep" checked="checked">Get from DB
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="IFGET" value="Nop">My Input

    <br>
    </div>
    
    <br>
    
    <div align="left">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <Input type="submit" value="update" name="update">
    &nbsp;&nbsp;&nbsp;
    </div>
    
 </form>
     <a href="login.html">GO TO LOGIN</a>

  </body>
</html>