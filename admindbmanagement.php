<!DOCTYPE html>
<html>
<head>
	<title>Database Management</title>
	<link rel="stylesheet" type="text/css" href="cssindex.css" />
</head>

<body>

	<?php require 'menu.php';?>
	<?php
	
	//Neccesities
	//
	 // Allows administrators to login into your database that allows conference 
	// administrator to manage the database such as insert reviewer’s login information
	// , modify an attendee’s information, modify a presenter’s information. It is similar
	// to phpmyadmin but only for manipulation of conference database.
	
	// 1)Admin login
	// 2)insert and modify data on all tables, or at least: reviewer, attendee, presenter
	//lets try replicating the logic from submission
	if(isset($_SESSION['adminstatus']) && $_SESSION['adminstatus']==true)
		{
		
		
		$connect = mysql_connect("localhost", "root", '');
		if (!$connect)
		{
			die("Could not connect to DB at this time, error:" . mysql_error());
		}
		mysql_select_db("alicinamemar", $connect);
		
		echo "<h1>Conference Database Management</h1>";
		echo "<h2><br><br>Attendee Table</h2>";
		
		echo '
		<table width="80%" border="1">
		<tr>
		<th>Title</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Organization</th>
		<th>Address</th>
		<th>Telephone</th>
		<th>Email</th>
		<th>Attendee</th>
		<th>Edit</th>
		<th>Delete</th>
		</tr>				
		';
		$view = "
		SELECT * FROM `registrationlist` ";
		$view = mysql_query($view);
		
		echo "<p><a id = 'orange' href='admineditattendee.php?id=I'>Insert new item</a></p>";
		//some data with the table id must be passed. I could always
		//just use the logic for creating a new user then have a different redirect
		
		
		while($rowselect= mysql_fetch_array($view))
		{
			echo '<tr><td>' . $rowselect["title"] . '</td>';
			echo '<td>' . $rowselect["firstname"] . '</td>';
			echo '<td>' . $rowselect["lastname"] . '</td>';
			echo '<td>' . $rowselect["org"] . '</td>';
			echo '<td>' . $rowselect["address"] . '</td>';
			echo '<td>' . $rowselect["telephone"] . '</td>';
			echo '<td>' . $rowselect["email"] . '</td>';
			echo '<td>' . $rowselect["attendeetype"] . '</td>';
			echo '<td><a href="admineditattendee.php?id=' . $rowselect["id"] . '">Edit</a></td>';
			echo '<td><a href="admindeleteattendee.php?id=' . $rowselect["id"] . '">Delete</a></td></tr>';

		}
		echo '</table>';
		

		
		
		
		
//End registration list table
		
		
		
		
		
		
		
		
//start admin list table

		

		echo "<h2><br><br>Admin Table</h2>";
		
		echo '
		<table width="80%" border="1">
		<tr>
		<th>Admin name</th>
		<th>Password</th>
		<th>Edit</th>
		<th>Delete</th>
		</tr>				
		';
		$viewadmins = "
		SELECT * FROM `admins` ";
		$viewadmins = mysql_query($viewadmins);
		
		echo "<p><a id = 'orange' href='admineditadmins.php?id=I'>Insert new item</a></p>";
		
		
		while($rowadmins= mysql_fetch_array($viewadmins))
		{
			echo '<tr><td>' . $rowadmins["username"] . '</td>';
			echo '<td>' . $rowadmins["password"] . '</td>';
			echo '<td><a href="admineditadmins.php?id=' . $rowadmins["id"] . '">Edit</a></td>';
			echo '<td><a href="admindeleteadmins.php?id=' . $rowadmins["id"] . '">Delete</a></td></tr>';

		}
		echo '</table>';		

		
	
	
	
//end admin
	

	
	
	
	
//start comments table
	
	
		echo "<h2><br><br>Comments Table</h2>";
		
		echo '
		<table width="80%" border="1">
		<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Comments</th>
		<th>Time Stamp</th>
		<th>Edit</th>
		<th>Delete</th>
		</tr>				
		';
		$viewcomments = "
		SELECT * FROM `comments` ";
		$viewcomments = mysql_query($viewcomments);
		
		echo "<p><a id = 'orange' href='admineditcomments.php?id=I'>Insert new item</a></p>";
		//some data with the table id must be passed. I could always
		
		
		while($rowcomments= mysql_fetch_array($viewcomments))
		{
			echo '<tr><td>' . $rowcomments["name"] . '</td>';
			echo '<td>' . $rowcomments["email"] . '</td>';
			echo '<td>' . $rowcomments["comments"] . '</td>';
			echo '<td>' . $rowcomments["time"] . '</td>';
			echo '<td><a href="admineditcomments.php?id=' . $rowcomments["id"] . '">Edit</a></td>';
			echo '<td><a href="admindeletecomments.php?id=' . $rowcomments["id"] . '">Delete</a></td></tr>';

		}
		echo '</table>';
	
	













///Start  review members table	
	
		echo "<h2><br><br>Reviewer Table</h2>";
			
			echo '
			<table width="80%" border="1">
			<tr>
			<th>Username</th>
			<th>Password</th>
			<th>Edit</th>
			<th>Delete</th>
			</tr>				
			';
			$viewreviewer= "
			SELECT * FROM `members` ";
			$viewreviewer = mysql_query($viewreviewer);
			
			echo "<p><a id = 'orange' href='admineditmembers.php?id=I'>Insert new item</a></p>";
			
			
			while($rowreviewer= mysql_fetch_array($viewreviewer))
			{
				echo '<tr><td>' . $rowreviewer["username"] . '</td>';
				echo '<td>' . $rowreviewer["password"] . '</td>';
				echo '<td><a href="admineditmembers.php?id=' . $rowreviewer["id"] . '">Edit</a></td>';
				echo '<td><a href="admindeletemembers.php?id=' . $rowreviewer["id"] . '">Delete</a></td></tr>';

			}
			echo '</table>';
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//upload db
			echo "<h2><br><br>Uploads Table</h2>";
			
			echo '
			<table width="80%" border="1">
			<tr>
			<th>Username</th>
			<th>Title</th>
			<th>Authors</th>
			<th>Affiliation</th>
			<th>Email</th>
			<th>Upload</th>
			<th>Type</th>
			<th>Size</th>
			<th>Timestamp</th>
			<th>Edit</th>
			<th>Delete</th>
			</tr>				
			';
			$viewuploads= "
			SELECT * FROM `upload` ";
			$viewuploads = mysql_query($viewuploads);
			
			echo "<p><a id = 'orange' href='admineditupload.php?id=I'>Insert new item</a></p>";
			
			
			while($rowuploads= mysql_fetch_array($viewuploads))
			{
				echo '<tr><td>' . $rowuploads["username"] . '</td>';
				echo '<td>' . $rowuploads["title"] . '</td>';
				echo '<td>' . $rowuploads["authors"] . '</td>';
				echo '<td>' . $rowuploads["affiliation"] . '</td>';
				echo '<td>' . $rowuploads["email"] . '</td>';
				echo '<td>' . $rowuploads["upload"] . '</td>';
				echo '<td>' . $rowuploads["type"] . '</td>';
				echo '<td>' . $rowuploads["size"] . '</td>';
				echo '<td>' . $rowuploads["timestamp"] . '</td>';
				echo '<td><a href="admineditupload.php?id=' . $rowuploads["id"] . '">Edit</a></td>';
				echo '<td><a href="admindeleteupload.php?id=' . $rowuploads["id"] . '">Delete</a></td></tr>';

			}
			echo '</table>';
	
	
	
	
	
	} //end if tag
	
	
	else
	{
	echo "<h2>Admin must be logged in</h2>";
	}
	
?>
