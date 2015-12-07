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
		<h2>Insert New Record</h2>
		<form method="post">
			  <table>
				<tr>
					<td>Title:</td>
					<td>
						<input type="radio" value="Mr" name="person_title" id="person_title" />Mr<br/>
						<input type="radio" value="Ms" name="person_title" id="person_title"/>Ms<br/>
						<input type="radio" value="Mrs" name="person_title" id="person_title"/>Mrs<br/>
					 </td>    
					
				</tr>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="firstname" id="firstname"/></td>
				</tr>                      
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name="lastname" id="lastname"/></td>
				</tr>
				<tr>
					<td>Organization/Company:</td>
					<td><input type="text" name="org" id="org"/></td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><input type="text" name="address" id="address"/></td>
				</tr>
				<tr>
					<td>Telephone:</td>
					<td><input type="tel" name="telephone" id="telephone"/></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="email" name="email" id="email"/></td>
				</tr>
				<tr>
					<td>Are you an/a: </td>
					<td>
						<input type="radio" value="Author" name="attendeetype" id="attendeetype" />Author<br/>
						<input type="radio" value="Student" name="attendeetype" id="attendeetype"/>Student<br/>
						<input type="radio" value="Regular Attendee" name="attendeetype" id="attendeetype" />Regular Attendee<br/>
					</td>
				</tr>
				<tr>
					<td><input style="cursor:pointer" type="reset" /></td>
					<td><input style="cursor:pointer" type="submit" value="Submit"/></td>
				</tr>    
			</table>
			</form>
			';
			
			if ( $_POST )
			{
				$connect = mysql_connect("localhost", "root", "");
		
				if (!$connect)
				{
				die("Could not connect to DB, error:" . mysql_error());
				}
				
				mysql_select_db("alicinamemar", $connect);
				$title = $_POST["person_title"];
				$firstname = $_POST["firstname"];
				$lastname = $_POST["lastname"];
				$org = $_POST["org"];
				$address = $_POST["address"];
				$telephone = $_POST["telephone"];
				$email = $_POST["email"];
				$attendeetype = $_POST["attendeetype"];
								
				$insertion = 
				"
					INSERT INTO `alicinamemar`.`registrationlist` (`id`, `title`, `firstname`, `lastname`, `org`, `address`, `telephone`, `email`, `attendeetype`, `timestamp`) VALUES (NULL, '$title', '$firstname', '$lastname', '$org', '$address', '$telephone', '$email', '$attendeetype', CURRENT_TIMESTAMP)
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
		SELECT * FROM `registrationlist` WHERE id='$id'
		";
		
		$view = mysql_query($view);
		
		$rowselect= mysql_fetch_array($view);
		
		echo "<h2>Edit Item</h2>";
		
		echo '<form method="post">
          <table>
            <tr>
                <td>Title:</td>
                <td>';
				
				
		switch ($rowselect["title"])
		{
			case "Mr":	
             echo ' <input type="radio" value="Mr" name="person_title" id="person_title" checked/>Mr<br/>
                    <input type="radio" value="Ms" name="person_title" id="person_title"/>Ms<br/>				
                    <input type="radio" value="Mrs" name="person_title" id="person_title"/>Mrs<br/>
                 </td>    
                
            </tr>
            <tr>
                <td>First Name:</td>';
			break;
			
			case "Ms":	
             echo ' <input type="radio" value="Mr" name="person_title" id="person_title" />Mr<br/>
                    <input type="radio" value="Ms" name="person_title" id="person_title" checked/>Ms<br/>				
                    <input type="radio" value="Mrs" name="person_title" id="person_title"/>Mrs<br/>
                 </td>    
                
            </tr>
            <tr>
                <td>First Name:</td>';
			break;
			
			case "Mrs":	
             echo ' <input type="radio" value="Mr" name="person_title" id="person_title" />Mr<br/>
                    <input type="radio" value="Ms" name="person_title" id="person_title"/>Ms<br/>				
                    <input type="radio" value="Mrs" name="person_title" id="person_title" checked/>Mrs<br/>
                 </td>    
                
            </tr>
            <tr>
                <td>First Name:</td>';
			break;
			
			}	
			
				
				
            echo '<td><input type="text" name="firstname" id="firstname" value = "' . $rowselect["firstname"] . '"/></td>
            </tr>                      
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lastname" id="lastname" value= "';
				
			echo $rowselect["lastname"] . '"/></td>
            </tr>
            <tr>
                <td>Organization/Company:</td>
                <td><input type="text" name="org" id="org" value="';
				
			echo $rowselect["org"] . '"/></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="address" id="address" value="';
				
			echo $rowselect["address"] . '"	/></td>
            </tr>
            <tr>
                <td>Telephone:</td>
                <td><input type="tel" name="telephone" id="telephone" value="';
				
			echo $rowselect["telephone"] . '"/></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" id="email" value="';
				
			echo $rowselect["email"] . '"	/></td>
            </tr>
            <tr>
                <td>Are you an/a: </td>
                <td>';
				
				
			switch($rowselect["attendeetype"])
			{
				case "Author":
				echo '  <input type="radio" value="Author" name="attendeetype" id="attendeetype" checked />Author<br/>
						<input type="radio" value="Student" name="attendeetype" id="attendeetype"/>Student<br/>
						<input type="radio" value="Regular Attendee" name="attendeetype" id="attendeetype" />Regular Attendee<br/>
					</td>
				</tr>
				<tr>
					<td></td><td><input style="cursor:pointer" type="submit" value="Submit"/></td>
				</tr>    
				</table>
				</form>';
				break;
				
				case "Student":
				echo '  <input type="radio" value="Author" name="attendeetype" id="attendeetype" />Author<br/>
						<input type="radio" value="Student" name="attendeetype" id="attendeetype" checked />Student<br/>
						<input type="radio" value="Regular Attendee" name="attendeetype" id="attendeetype" />Regular Attendee<br/>
					</td>
				</tr>
				<tr>
					<td></td><td><input style="cursor:pointer" type="submit" value="Submit"/></td>
				</tr>    
				</table>
				</form>';
				break;
				
				case "Regular Attendee":
				echo '  <input type="radio" value="Author" name="attendeetype" id="attendeetype" />Author<br/>
						<input type="radio" value="Student" name="attendeetype" id="attendeetype"/>Student<br/>
						<input type="radio" value="Regular Attendee" name="attendeetype" id="attendeetype" checked />Regular Attendee<br/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input style="cursor:pointer" type="submit" value="Submit"/></td>
				</tr>    
				</table>
				</form>';
				break;
			}
			
			
		if ( $_POST )
		{
		
		$title = $_POST["person_title"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$org = $_POST["org"];
		$address = $_POST["address"];
		$telephone = $_POST["telephone"];
		$email = $_POST["email"];
		$attendeetype = $_POST["attendeetype"];
		
		
		$update ="
		UPDATE `alicinamemar`.`registrationlist` SET `title` = '$title', 
		`firstname` = '$firstname', `lastname` = '$lastname', `org` = '$org', `address` = '$address',
		`telephone` = '$telephone', `email` = '$email', `attendeetype` = '$attendeetype'
		WHERE `registrationlist`.`id` = '$id'
		";
		
		
		
		mysql_query($update);
		mysql_close($connect);
		echo '<script> alert("Row has been updated");</script>';
		header("Location: admindbmanagement.php");
		}
		}
		//have a working model with one of the DB FIRST
		
		
		
		// echo $_GET['id']; this is how to pass
		//differentiate which form to pull up, I can do this using case and break
		// need to grab every item in there using idate
		// then prefill the form
		//submit it
		//Everything except ID needs to be taken from forms
		//then send the user back
		
		//Also need a way to differentiate which DB to checkdate
		//I can either make different php documents
		//or have a way to differentiate the id being split
		//and to on an edit
		
	
	
	} //end if tag
	
	
	else
	{
	echo "<h2>Admin must be logged in</h2>";
	}
	
?>
