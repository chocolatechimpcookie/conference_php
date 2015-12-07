<!DOCTYPE html>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="cssindex.css" />
</head>

<body>
    <!-- Header -->
    <?php include 'menu.php';?>
    <h1 id="title">Reviewer Login</h1>
    
	<table cellpadding="5">
            <form name = "login" method ="post" action="logincheck.php">
                     
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
                         <td><input style="cursor:pointer" type="submit" name="submit" value="Login"></td>
                     </tr>
					
            </form>
	</table>

</body>
</html>
