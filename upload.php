<?php

        if( $_POST  )
//&& isset($_FILES['file'])
			{
			session_start();

			$connect = mysql_connect("localhost", "root", "");


			if (!$connect)
			{
				die("Could not connect to DB at this time, error:" . mysql_error());
				echo 'DB Issues';
			}
			mysql_select_db("alicinamemar", $connect);
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
			$username = $_SESSION['username'];

			$file = $username . "_" . rand(100,1000000) . $_FILES['file']['name'];
            $location= $_FILES['file']['tmp_name'];
			$size = $_FILES['file']['size'];
			$type = $_FILES['file']['type'];
			$folder="uploads/";
			
			if (move_uploaded_file($location, $folder.$file))
				
				{
				$insertion = "INSERT INTO `alicinamemar`.`upload` (`id`, `title`, `authors`, `affiliation`, `email`, `upload`, `type`, `timestamp`, `size`, `username`) VALUES (NULL, '$title', '$authors', '$affiliation', '$email', '$file', '$type', CURRENT_TIMESTAMP, '$size', '$username' )";
				mysql_query($insertion);
				mysql_close($connect);
				header("Location: submission.php");
				}
			else
			{
				echo "
				<script>alert('Upload Error');
				window.location.href='submission.php?fail';</script>
				";
			}
	

			}
?>
