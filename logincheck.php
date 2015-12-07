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

               
                $checkpassword = 
                "
				SELECT username FROM `members` WHERE username='$username' and password = '$password'
                ";
				
				$checkpassword = mysql_query($checkpassword);
				$checkpassword = mysql_num_rows($checkpassword);
				
				if($checkpassword==1)
				{
					session_start();
					$_SESSION['username']=$username;
					$_SESSION['loginstatus']=true;
					echo '<h2>' . $username . ' is now logged in.</h2>';
					header("Location: index.php");
					
					
					
				}
				else
				{	
					echo '<script>alert("Wrong password or username. Please try again.");
					</script>';
					header("Location: login.php");

					
				}
				mysql_close($connect);
            }







?>