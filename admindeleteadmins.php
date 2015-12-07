<!DOCTYPE html>
<html>
<head>
	<title>Database Management</title>
	<link rel="stylesheet" type="text/css" href="cssindex.css" />
</head>

<body>

	<?php require 'menu.php';?>
	<?php
	
	
	if(isset($_SESSION['adminstatus']) && $_SESSION['adminstatus']==true)
		{
		
		
		$connect = mysql_connect("localhost", "root", '');
		if (!$connect)
		{
			die("Could not connect to DB at this time, error:" . mysql_error());
		}
		mysql_select_db("alicinamemar", $connect);
		
		$id=$_GET['id'];
		
			
		$delete ="
		DELETE FROM `alicinamemar`.`admins` WHERE `admins`.`id` = '$id';
		";
		
		
		
		mysql_query($delete);
		mysql_close($connect);
		header("Location: admindbmanagement.php");
	
	
	} //end if tag
	
	
	else
	{
	echo "<h2>Admin must be logged in</h2>";
	}
	
?>
