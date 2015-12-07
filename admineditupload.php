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
	//INSERT CODE	
		if ($id=="I")
		{
		echo '
		<h1>Add Submission</h1>
                <form method="POST" enctype="multipart/form-data">
                <table>
					<tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" id="username"/></td>
                    </tr>
                    <tr>
                        <td>Paper Title:</td>
                        <td><input type="text" name="title" id="title"/></td>
                    </tr>
                    <tr>
                        <td>Authors:</td>
                        <td><input type="text" name="authors" id="authors"/></td>
                    </tr>
                    <tr>
                        <td>Affiliation:</td>
                        <td><input type="text" name="affiliation" id="affiliation"/></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" id="email"/></td>
                    </tr>
                    <tr>
                        <td>Upload:</td>
                        <td><input type="file" name="file" id="file" </td>
                    </tr>

                    <tr>
                        <td><input style="cursor:pointer" type="reset" /></td>
                        <td><input style="cursor:pointer" type="submit" value="Submit" /></td>
                    </tr>
                </table>
                </form>
			';
			
			if ( $_POST )
			{
				
			$title = $_POST['title'];
			$authors = $_POST['authors'];
			$affiliation = $_POST['affiliation'];
			$email = $_POST['email'];
			$title = mysql_real_escape_string($title);
			$authors = mysql_real_escape_string($authors);
			$affiliation = mysql_real_escape_string($affiliation);
			$email = mysql_real_escape_string($email);
			$title = stripslashes($title);
			$email = stripslashes($email);
			$authors = stripslashes($authors);
			$affiliation = stripslashes($affiliation);
			$username = $_POST['username'];

			$file = $username . "_" . rand(100,1000000) . $_FILES['file']['name'];
            $location= $_FILES['file']['tmp_name'];
			$size = $_FILES['file']['size'];
			$type = $_FILES['file']['type'];
			$folder="uploads/";
			
			if (move_uploaded_file($location, $folder.$file))
				
				{
				$insertion = "INSERT INTO `alicinamemar`.`upload` (`id`, `title`, `authors`, `affiliation`, `email`, `upload`, `type`, `timestamp`, `size`, username) VALUES (NULL, '$title', '$authors', '$affiliation', '$email', '$file', '$type', CURRENT_TIMESTAMP, '$size', '$username' )";
				mysql_query($insertion);
				mysql_close($connect);
				header("Location: admindbmanagement.php");
				}
			else
			{
				echo "
				<script>alert('Upload Error');
				window.location.href='admindbmanagement.php?fail';</script>
				";
			}

			}
			
			
		
		
	//END INSERT
		
		}
	//START EDIT	
		else    
		{
		
		$view = "
		SELECT * FROM `upload` WHERE id='$id'
		";
		
		$view = mysql_query($view);
		
		$rowselect= mysql_fetch_array($view);
		

	
		echo '
		<h1>Edit Submission</h1>
		<form method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" id="username" value="';
		echo $rowselect["username"] . '"/></td>
			</tr>
			<tr>
				<td>Paper Title:</td>
				<td><input type="text" name="title" id="title" value="';
		echo $rowselect["title"] . '"/></td>
			</tr>
			<tr>
				<td>Authors:</td>
				<td><input type="text" name="authors" id="authors" value="';
				
		echo $rowselect["authors"] . '"/></td>
			</tr>
			<tr>
				<td>Affiliation:</td>
				<td><input type="text" name="affiliation" id="affiliation" value="';
				
				
		echo $rowselect["affiliation"] . '"/></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" id="email" value="';
				
		echo $rowselect["email"] . '"/></td>
			</tr>
			<tr>
				<td>Current Upload:</td>';
		echo '<td><a href="uploads/' . $rowselect['upload'] . '" target="_blank">File</a></td></tr>';
		echo '<tr><td>Reupload?</td>
              <td><input type="file" name="file" id="file" </td>
			</tr>
			<tr>
			<td>Old upload or new?</td>
			<td>
                    <input type="radio" value="Old" name="uploadchoice" id="uploadchoice" />Old<br/>
                    <input type="radio" value="New" name="uploadchoice" id="uploadchoice"/>New<br/>
            </td>
			</tr>
			<tr>
				<td><input style="cursor:pointer" type="reset" /></td>
				<td><input style="cursor:pointer" type="submit" value="Submit" /></td>
			</tr>
		</table>
		</form>
				';
				
			
			
			
		if ( $_POST )
		{
		
			$title = $_POST['title'];
			$authors = $_POST['authors'];
			$affiliation = $_POST['affiliation'];
			$email = $_POST['email'];
			$title = mysql_real_escape_string($title);
			$authors = mysql_real_escape_string($authors);
			$affiliation = mysql_real_escape_string($affiliation);
			$email = mysql_real_escape_string($email);
			$title = stripslashes($title);
			$email = stripslashes($email);
			$authors = stripslashes($authors);
			$affiliation = stripslashes($affiliation);
			$username = $_POST['username'];

			
			
			
			//if old, update everything but that stuff
			//if new treat it like a new one BUT delete the old file
			
			
		if($_POST["uploadchoice"]=="Old")
			{
			
			$update =
			"
			UPDATE `alicinamemar`.`upload` SET `title` = '$title', `authors` = '$authors', 
			`affiliation` = '$affiliation', `email` = '$email', `username` = '$username' WHERE `upload`.`id` = 1
			";
			mysql_query($update);
			mysql_close($connect);
			header("Location: admindbmanagement.php");
			}
		else
			{
				
			$oldone= "uploads/" . $rowselect['upload'];
			unlink($oldone);
				
				
			$file = $username . "_" . rand(100,1000000) . $_FILES['file']['name'];
            $location= $_FILES['file']['tmp_name'];
			$size = $_FILES['file']['size'];
			$type = $_FILES['file']['type'];
			$folder="uploads/";
			if (move_uploaded_file($location, $folder.$file))
				
			{

			$update =
			"
			UPDATE `alicinamemar`.`upload` SET `title` = '$title', `authors` = '$authors', `affiliation` = '$affiliation', 
			`email` = '$email', `upload` = '$file', 
			`type` = '$type', `size` = '$size', `username` = '$username' WHERE `upload`.`id` = '$id'	
			";	
			mysql_query($update);
			mysql_close($connect);
			header("Location: admindbmanagement.php");

			
			}
			
			
			}
		}
		
		
		}
	
	} //end if tag
	
	
	else
	{
	echo "<h2>Admin must be logged in</h2>";
	}
	
?>
