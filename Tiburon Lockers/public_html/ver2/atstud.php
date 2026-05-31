<?php
	//if one database row (record) matches the input: start the session,
	// fetch the record and insert the three values in a array
	
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
	
	$url = 'header.php';
	
	if(empty($_SESSION['user_id'])){
		//exit(); 
	}
	else {
		
		if(( $_SESSION['user_level'])== 1)
		$url = 'mainbar.php';
		else
		$url = 'member-nav.php';
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="stylesheet" type="text/css" href="asmstyle.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		
		<!-- Custom styles for this template -->
		<link href="sticky-footer-navbar.css" rel="stylesheet">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>		
	</head>
	
	<body>
		<div class="container">
			<?php include($url); ?>
			<?php include('nav2.php'); ?>
			<div id='content'>
				<!--Start of the view_users_page content. -->
				<h2>
					<a id="antitheftstud">Anti-Theft Stud Installation</a>
				</h2>
				
				<h4>
					<br>
					<p>
					<tr>
						<td>
							Using the stud template, mark the stud location on the door plate.
							<br>
							Drill a #43 hole.
						<br>Thread the hole using a 4-40 tap.
						</td>
						<td>
							<img src="images/stud1.png">
						</td>
						<td>
							<img src="images/stud2.png">
						</td>
					</tr>
					<p>
					<tr>
						<td>
							Apply a small drop of thread-lock to the shoulder screw threads.
							<br>
							Install the shoulder screw in the hole.
						<br>DO NOT OVER-TIGHTEN!</td>
						<td>							
							<img src="images/stud3.png">
						</td>
						<td>
							<img src="images/stud4.png">
						</td>
					</tr>				
				</h4>			
			</div>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>