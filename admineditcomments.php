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
			echo '<h2>Insert new comment</h2>';
			echo '<form method="post">
				<table>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="fullname" id="fullname"/></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="email" name="email" id="email"/></td>
					</tr>
					<tr>
						<td>Comments:<br></td>
						<td><textarea name="comments" id="comments"></textarea></td>
					</tr>
					<tr>
						<td><input style="cursor:pointer" type="reset" /></td>
						<td><input style="cursor:pointer" type="submit" value="Submit" /></td>
					</tr>
				</table>
			</form>';
			
			if( $_POST )

			{
			
			$name = $_POST['fullname'];
			$email = $_POST['email'];
			$comments = $_POST['comments'];
			$name = mysql_real_escape_string($name);
			$email = mysql_real_escape_string($email);
			$comments = mysql_real_escape_string($comments);
			$name = stripslashes($name);
			$email = stripslashes($email);
			$comments = stripslashes($comments);
			
			$insertion = "
			INSERT INTO `alicinamemar`.`comments` (`id`, `name`, `email`, `comments`, `time`) VALUES (NULL, '$name', '$email', '$comments', CURRENT_TIMESTAMP)
			";
			
			mysql_query($insertion);
			mysql_close($connect);
			header("Location: admindbmanagement.php");

			}
			
			
		
		
	//END INSERT
		
		}
	//START EDIT	
		else    
		{
		
		$view = "
		SELECT * FROM `comments` WHERE id='$id'
		";
		
		$view = mysql_query($view);
		
		$rowselect= mysql_fetch_array($view);
		
		echo "<h2>Edit Item</h2>";
		
		echo '<form method="post">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="fullname" id="fullname" value="';
		echo $rowselect["name"] . '"/></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" id="email" value="';
		
		echo $rowselect["email"] . '"/></td>
                </tr>
                <tr>
                    <td>Comments:<br></td>
                    <td><textarea name="comments" id="comments">';
		echo $rowselect["comments"] . '</textarea></td>
                </tr>
                <tr>
                    <td><input style="cursor:pointer" type="reset" /></td>
                    <td><input style="cursor:pointer" type="submit" value="Submit" /></td>
                </tr>
            </table>
        </form>';
				
				
		
			
			
		if ( $_POST )
		{
		
		$name = $_POST["fullname"];
		$email = $_POST["email"];
		$comments = $_POST["comments"];
		
		
		
		$update ="
		UPDATE `alicinamemar`.`comments` SET `name` = '$name', 
		`email` = '$email', `comments` = '$comments'
		WHERE `comments`.`id` = '$id'
		";
		
		
		
		mysql_query($update);
		mysql_close($connect);
		header("Location: admindbmanagement.php");
		}
		}
		
		
	
	
	} //end if tag
	
	
	else
	{
	echo "<h2>Admin must be logged in</h2>";
	}
	
?>
