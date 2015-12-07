<?php

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
		
		$connect = mysql_connect("localhost", "root", "");
		
		
		if (!$connect)
		{
			die("Could not connect to DB at this time, error:" . mysql_error());
			echo 'DB Issues';
		}
		
		mysql_select_db("alicinamemar", $connect);
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
		echo '<h2> Thank you for your comments ' . $name . '!</h2>';
		mysql_close($connect);

	}
	
	//text remains on screen after reloading.
?>
