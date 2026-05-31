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
					<a id="antitheftstud">+5 Volt Power Supply
					</a>
				</h2>
				
				<h4>
					<br>
					
					
					<tr>
						<p>
							<td>Attach 5V power supply to mounting plate using 4-40 x 3/8" flat head, lockwasher , and nut. [1 place]</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Attach 5V power supply and plate to top plate using 4-40 x3/8" pan head with lockwasher. [2 places]</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Attach AC power wire harness (GREEN/WHITE/BLACK) to J6 on the power distribution board.</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Attach the GREEN wire to the GROUND terminal on the 5V power supply.</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Attach the WHITE wire to the NEUTRAL terminal on the 5V power supply.</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
						
					</tr>
					<tr>
						<p>
							<td>Attach the BLACK wire to the LINE terminal on the 5V power supply.</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>
					
					<tr>
						<p>
							<td>Attach DC power wire harness (BLACK/RED) to J10 on the power distribution board.</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>
					
					<tr>
						<p>
						<td>Attach the BLACK wire to the V- terminal on the 5V power supply.</td>
						<p>
							<td>
								<img src="images/pph.png">
							</td>
					</tr>
							
					<tr>
						<p>
							<td>Attach the RED wire to the V+ terminal on the 5V power supply.</td>
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