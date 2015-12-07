<!DOCTYPE html>

<html>
<head>
    <title>Paper Submission</title>
    <link rel="stylesheet" type="text/css" href="cssindex.css" />

</head>

<body>
        <!-- Header -->
        <?php require 'menu.php';?>
		
        <?php
		
	//if logged in >
	//else you ar enot logged in
	
	//Upload
	//Does the user need to access the file 
	//or just "shall be able to see papers assigned to them"
	//multiple papers?
	//
	//Logic: 1)check if paper exists 
	//			A) If does, display information
	//		 	B)If doesn't , form
	// form needs: Paper title, names of authors, affiliation, email,
	//DB Needs id usernameaffiliation Paper title, names of authors, affiliation, email, file, dateuploadedauto
	
	if(isset($_SESSION['loginstatus']) && $_SESSION['loginstatus']==true)
		{	//Super global array checked for login status
                    
//                    echo $_SESSION['username'];
                    $connect = mysql_connect("localhost", "root", '');
                            if (!$connect)
                            {
                                die("Could not connect to DB at this time, error:" . mysql_error());
                            }
                    mysql_select_db("alicinamemar", $connect);
                    $username = $_SESSION['username'];
                    $checkupload= 
                    "
                    SELECT username FROM `upload` WHERE username='$username'";
                    $checkupload = mysql_query($checkupload);
                    $rowsnum = mysql_num_rows($checkupload);
					
					//This checks if a submission exists already in db
					//If it does, it displays the file.

                if($rowsnum>=1)
                    {
						echo '
						<h1>Uploaded</h2>
						<table width="80%" border="1">
						<tr>
						<td>File Name</td>
						<td>File Type</td>
						<td>File Size in KB</td>
						<td>File View</td>
						</tr>				
						';
						$upview = "
						SELECT * FROM `upload` WHERE username='$username'";
						$upview = mysql_query($upview);
						
						
						while($rowselect= mysql_fetch_array($upview))
						{
							echo '<tr><td>' . $rowselect["title"] . '</td>';
							echo '<td>' . $rowselect["type"] . '</td>';
							echo '<td>' . $rowselect["size"] . '</td>';
							echo '<td><a href="uploads/' . $rowselect['upload'] . '" target="_blank">File</a></td></tr>';
						}
						echo '</table>';
					
						

                    }
		        else		//The else, if there is no submission, the form pops up.
                {
                    echo '
				<h1>Submission</h1>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                <table>
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
                }
		}
	else
		{
		echo "<h5>You are not logged in. Please login to upload and access files.</h5>";	
			
		}
		?>
    
</body>
</html>
