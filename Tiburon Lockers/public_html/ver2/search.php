<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

	//if one database row (record) matches the input: start the session,
	// fetch the record and insert the three values in a array

	if(empty($_SESSION['user_id'])){
		// exit(); 
	}
	else {

		if( $_SESSION['user_level']!= 1){
			header("Location: chargedaddyForm.php");
			exit();
		}
	}
	
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
<!doctype html>
<html lang="en">
	<head>
		<title>Search Page</title>
		<meta charset=utf-8>

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
			
			<div class="container">
				<!--Start of the view_users_page content. -->
				<h3> Search For A Record </h3>
				<h4> Please Choose A Database To Search </h4>
		  
				<h4>
				<br>
					<select class="form-control" name="Database" onchange="window.location=this.value">
						<option value = 'search.php'> Select Database From This List </option>
						<option value = 'chargedaddyForm.php'> ChargeDaddy </option>
						<option value = 'usersForm.php'> Users </option>
					</select>
				</br>
				</h4>		
			</div>				
		</div>
		<?php include('footer.php'); ?>	
	</body>
</html>