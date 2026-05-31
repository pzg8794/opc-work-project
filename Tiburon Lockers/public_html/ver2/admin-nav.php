<?php
	if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)){
	header("Location: login.php");
	exit();
	}

	echo '<h1>';
	if(isset($_SESSION['fname'])){
	echo "{$_SESSION['fname']}";
	echo " {$_SESSION['lname']}" . "<br>";
	} 

	//Use a ternary operation to set the URL
	if(isset($_SESSION['user_level'])){
	echo "Logged as an Administrator"; 
	}  
	echo '</h1>';
?>

<div id="header">
	<div id="reg-navigation">
	</div>
</div>
<div id="nav">
	<nav class="navbar navbar-default navbar-static-top">
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<a href="index.php" title="Home">Home</a>
				</li>

				<li>
					<a href="logout.php">Logout</a>
				</li>

				<li>
					<a href="search.php">Search</a>
				</li>

				<li>
					<a href="pjsmgnt.php">Projects</a>
				</li>

				<li>
					<a href="ecalendar.php">Schedule</a>
				</li>


				<li>
					<a href="admin_view-users-page.php">View Users</a>
				</li>

				<li>
					<a href="#">Instructions</a>
					<ul class="nav navbar-nav">
						<li>
							<a href="assembly.php">Assembly</a>
						</li>
						<li>
							<a href="#">Software</a>
							<ul class="nav navbar-nav">
								<li>
									<a href="#">HTML</a>
								</li>
								<li>
									<a href="#">CSS</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">Others</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="register-page.php">New Employee</a>
				</li>

				<li>
					<a href="register-password.php">New Password</a>
				</li>			
			</ul>
		</div>
	</nav>
</div>