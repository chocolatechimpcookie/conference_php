<!DOCTYPE html>


        <div class="nav">
         <ul> 
            <li><a href="index.php">Home  </a></li>
            
            
            <li><a href="dates.php">Dates  </a></li>
            <li><a><i>Information  </i></a>
                <ul>
                <li><a href="about.php">About the conference</a></li>
                <li><a href="fee.php">Conference Fee</a></li>
                <li><a href="hotelinfo.php">Hotel Information</a></li>
                <li><a href="registrationforconference.php">Conference Registration</a></li>
                <li><a href="program.php">Conference Program</a></li>
                <li><a href="guidelines.php">Guidelines</a></li>
                <li><a href="keynote.php">Keynote Speakers</a></li>   
                <li><a href="call.php">Call for Paper</a></li>
                <li><a href="major.php">Major Areas</a></li>
                </ul>
            </li>
            <li><a href="comments.php">Comments  </a></li>

				<?php
	
		session_start();

	
		if(isset($_SESSION['loginstatus']) && $_SESSION['loginstatus']==true)
			{
			echo "<li><a id='orange'><i><b>Reviewer<b></i></a><ul>
			<li><a id='orange'><i>" . $_SESSION['username'] . "</i></a></li>
			<li><a href='logout.php'> Log out</a></li>
			<li><a href='reviewerregister.php'>Registration</a></li>
			<li><a href='submission.php'>Paper</a></li>
			</ul></li>";
			}
			else
			{
				echo "<li><a><i>Reviewers  </i></a>
					<ul>
					<li><a href='login.php'> Log in</a></li>
					<li><a href='reviewerregister.php'>Reviewer Registration</a></li>
					<li><a href='submission.php'>Paper Submission</a></li>
					</ul>";

			}
		
		?>
		
		</li>
		
		<?php
		
		
		if(isset($_SESSION['adminstatus']) && $_SESSION['adminstatus']==true)
			
			{
				echo "<li><a id='orange'><i><b>Admin<b></i></a><ul>
				<li><a id='orange'><i>" . $_SESSION['adminname'] . "</i></a></li>
				<li><a href='logout.php'>Log out</a></li>
				<li><a href='admindbmanagement.php'>Management</a></li>
					  </ul></li>";
				
				
			}
			
			
		else
			{
			echo "
				
					<li><a><i>Admin  </i></a>
					<ul>
					<li><a href='adminlogin.php'> Log in</a></li>
					</ul>
				
				";
			}
			// admins should only be able to make new users
			//the register page won't come up if you aren't logged in, in the page and menu
			//Login page
			//Create new admin page/management
			//db management
					
					
					
		// if this issue continues, make the menu into php and put log in data in the edge of the screen, save the old menu

			?>
		
		</ul>
		</div>
        
		
		
		
		