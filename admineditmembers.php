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
		<h2>Insert New Reviewer</h2>
		<table cellpadding="5">
            <form name = "login" method ="post">
                     
                     <tr>
                         <td><b>Username</b></td>
                         <td><input name="username" id="username" type="text"></td>
                     </tr>
                     <tr>
                         <td><b>Password</b></td>
                         <td> <input name="password" id="password" type="password"></td>
                     </tr>
                     <tr>
                         <td></td>
                         <td><input style="cursor:pointer" type="submit" name="submit" value="Submit"></td>
                     </tr>
                    
					
            </form>
		</table>
			';
			
			if ( $_POST )
			{
				
				$username = $_POST['username'];
                $password = $_POST['password'];
				$checkuserexistence = 
                "
				SELECT username FROM `members` WHERE username='$username'
                ";
				
				$checkuserexistence = mysql_query($checkuserexistence);
				$checkuserexistence = mysql_num_rows($checkuserexistence);
				
				if($checkuserexistence>=1)
				{
					echo "<h2>Username exists. Please try a new Username</h2>";
					
				}
				else
				{	
					$insertion = 
					"
					INSERT INTO `alicinamemar`.`members` (`id`, `username`, `password`) VALUES (NULL, '$username', '$password')
					";
					mysql_query($insertion);
					mysql_close($connect);
					header("Location: admindbmanagement.php");
					
				}
				

			}
			
			
		
		
	//END INSERT
		
		}
	//START EDIT	
		else    
		{
		
		$view = "
		SELECT * FROM `members` WHERE id='$id'
		";
		
		$view = mysql_query($view);
		
		$rowselect= mysql_fetch_array($view);
		
		echo "<h2>Edit Reviewer</h2>";
		
		echo '<table cellpadding="5">
            <form name = "login" method ="post">
                     
                     <tr>
                         <td><b>Username</b></td>
                         <td><input name="username" id="username" type="text" value="';
						 
						 
		echo $rowselect["username"] . '"></td>
                     </tr>
                     <tr>
                         <td><b>Password</b></td>
                         <td> <input name="password" id="password" type="password" value="';
						 
		echo $rowselect["password"] . '"></td>
                     </tr>
                     <tr>
                         <td></td>
                         <td><input style="cursor:pointer" type="submit" name="submit" value="Submit"></td>
                     </tr>
                    
					
            </form>
			</table>
			';
				
				
			
		}
			
			
		if ( $_POST )
		{
		
		$username= $_POST["username"];
		$password = $_POST["password"];
		
		
		
		$update ="
		UPDATE `alicinamemar`.`members` SET `username` = '$username', 
		`password` = '$password'
		WHERE `members`.`id` = '$id'
		";
		
		
		
		mysql_query($update);
		mysql_close($connect);
		echo '<script> alert("Row has been updated");</script>';
		header("Location: admindbmanagement.php");
		}
		
	
		
	
	
	} //end if tag
	
	
	else
	{
	echo "<h2>Admin must be logged in</h2>";
	}
	
?>
