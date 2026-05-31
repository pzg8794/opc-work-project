<?php
	if(session_status() == PHP_SESSION_NONE){
	session_start();
	}

	echo '<h5>';
	if(isset($_SESSION['fname']))
	echo "{$_SESSION['fname']}";

	if(isset($_SESSION['lname']))
	echo " {$_SESSION['lname']}" . "<br>";

	//Use a ternary operation to set the URL
	if(isset($_SESSION['user_level'])){

	$ul = $_SESSION['user_level'];
	if($ul == 0)
	echo "Logged as a Sales Member";
	else if($ul == 2)
	echo "Logged as a Technician";
	else if($ul == 1)
	echo "Logged as an Administrator";
	}  
	echo '</h5>';
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
					<?php 
						if(isset($_SERVER['HTTP_REFERER'])) {
						$url = htmlspecialchars($_SERVER['HTTP_REFERER']);

						}else
						$url = basename($_SERVER['PHP_SELF']); 

						echo "<a href='$url'>Back</a>";
					?>
				</li>
				<li>
					<a href="index.php" title="Home">Home</a>
				</li>
			</ul>
		</div>
	</nav>
</div>

