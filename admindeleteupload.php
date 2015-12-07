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
		
		$view = "
		SELECT * FROM `upload` WHERE id='$id'
		";
		
		$view = mysql_query($view);
		
		$rowselect= mysql_fetch_array($view);
		
		$oldone= "uploads/" . $rowselect['upload'];
		unlink($oldone);
		$delete ="
		DELETE FROM `alicinamemar`.`upload` WHERE `upload`.`id` = '$id';
		";
		//Do I need to delete it locally as well?
		
		
		mysql_query($delete);
		mysql_close($connect);
		header("Location: admindbmanagement.php");
	
	
	} //end if tag
	
	
	else
	{
	echo "<h2>Admin must be logged in</h2>";
	}
	
?>
