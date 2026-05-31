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
			<div id="content">
				<!--Start of the view_users_page content. -->
				<h2> Assembly Instructions </h2>
				<h3 class="red"> Please Choose A Section From Below </h3>

				<h4>
					<br>
            
					<select class="form-control" name="Database" onchange="window.location=this.value">
						<option value = '#'> Select A Section </option>
						<option value = 'atstud.php'> Anti-Theft Stud </option>
						<option value = 'magnet.php'> Magnet </option>
						<option value = 'reed.php'> Reed Swtich </option>
						<option value = 'linkage.php'> Linkage </option>
						<option value = 'servo.php'> Servo Mounting </option>
						<option value = 'rework.php'> Metal Rework</option>
						<option value = 'compmnt.php'> Compartments </option>
						<option value = 'circuit.php'> PCB </option>
						<option value = '#j8'> J8 </option>
						<option value = '12vps.php'> 12V Power Supply  </option>
						<option value = '5vps.php'> 5V Power Supply </option>
						<option value = 'mainac.php'> Main AC Wiring </option>
						<option value = 'chassis.php'> Chassis Assembly </option>
						<option value = 'quad.php'> Quad Assembly </option>
					</select>

					</br>
				</h4>
			</div>
		</div>
		<?php include('footer.php'); ?>	
	</body>
</html>