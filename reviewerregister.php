<!DOCTYPE html>

<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="cssindex.css" />
</head>

<body>
    <!-- Header -->
    <?php include 'menu.php';?>
    <h1 id="title">Register</h1>
    
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
                         <td><input style="cursor:pointer" type="submit" name="submit" value="Register"></td>
                     </tr>
                    
					
            </form>
	</table>

        <?php
            if ( $_POST )
            {
                $connect = mysql_connect("localhost", "root", '');
                if (!$connect)
                {
                    die("Could not connect to DB at this time, error:" . mysql_error());
                }

                mysql_select_db("alicinamemar", $connect);
                $username = $_POST['username'];
                $password = $_POST['password'];
                $username = mysql_real_escape_string($username);
                $password = mysql_real_escape_string($password);
				$username = stripslashes($username);
				$password = stripslashes($password);

                /*
                need to check if user exists then echo 
                Also encrypt pass? Not required but could be nice.
                */
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
					echo '<h2> Thank you for registering. Your username is "' . $username . '".</h2>';
					mysql_close($connect);
					
				}
            }


        ?>
</body>
</html>
