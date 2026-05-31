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
					<a id="preliminary">Rework</a>
				</h2>

				<h4>
				<br>

				<tr>
					<p>
					<td>Cut excess studs from door frames</td>
					</p>
					<td>
						<img src="images/cut.png">
					</td>
				</tr>

				<tr>
					<p>
					<td>Grind stubs flat</td>
					</p>
					<td>
						<img src="images/grind.png">
					</td>
				</tr>

				<tr>
					<p>
					<td>Sand sliding surfaces</td>
					</p>
					<td>
						<img src="images/sand.png">
					</td>
				</tr>
				<tr>
					<p>
					<td>Touch up paint on door frames</td>
					</p>
					<td>
						<img src="images/touch.png">
					</td>
				</tr>
				<tr>
					<p>
					<td>Rework slide hooks</td>
					</p>
					<td>
						<img src="images/cut1.png">
					</td>
				</tr>
				<tr>
					<p>
					<td>File door plate notches</td>
					</p>
					<td>
						<img src="images/slot.png">
					</td>
				</tr>

				</br>
				</h4>
			</div>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>