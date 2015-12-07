<!DOCTYPE html>

<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="cssindex.css" />
</head>

<body>
        <!-- Header -->
        
        <?php require 'menu.php';?>
        
        <!--"first and last name, title, company or organization, address, phone
number, email address, if user is an author of a presenter, a student, or a
regular attendee""-->
    <h1 id="title">Registration</h1>

    <a href="#"><img class="enlarge" src="images/register.jpg" height="250" width="200" alt="registration" title=""></a>

          
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
		
		<?php
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
                                echo "<h2>Thank you for registering, " . $firstname . "!</h2>";
                                mysql_close($connect);
			}
		?>
</body>
</html>
