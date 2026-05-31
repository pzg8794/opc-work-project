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
					<a id="12vpower"> Circuit Modification </a>
				</h2>
				
				<h4>
					<br>
					
					<tr>
						<p>
							<td>Mount control board</td>
						</p>
						<td>
							<img src="images/ctrl.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Add servo circuit to control board using double stick tape</td>
						</p>
						<td>
							<img src="images/modpos.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Add servo circuit wiring</td>
						</p>
						<td>
							<img src="images/mod.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Connect servo to servo circuit but do not mount servo on compartment</td>
						</p>
						<td>
							<img src="images/cnnctr.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Perform servo/compartment burn-in test</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>
					
					</br>
				</h4>				
			</div>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>