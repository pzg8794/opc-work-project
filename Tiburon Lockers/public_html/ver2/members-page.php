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

<!doctype html>
<html lang="en">
	<head>
		<title>Members Page</title>
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
		<style type"text/css">
			#mid-right-col {
				text-align:right; margin: auto; margin-right: 8em;
			}
			#midcol h3 {
				font-size:130%; margin-top:-7em;
				margin-bottom:-2em; 
				text-align:right;
			}

			#mid-left-col {
				text-align:left; margin: auto;
			}

			#midcol h2 {
				font-size:130%;
				margin-top:2em; 
				margin-bottom:0;
				text-align:left;
				margin-left: 6em;
			}
			
			ht{
				position: absolute; font-size:150%; color:navy; text-align:left; margin:auto;
				margin-left:-5.5em;margin-top:-6em;
			}
		</style>
	</head>

	<body>
		<div class='container'>
			<?php include($url); ?>
			<div id='content'><!--Start of page content. -->
				<div class= "row">
					<div class= "col-md-8">
						<h2> Member's Events </h2>
						<p> The members page. The members page. The members page.
							<br> The members page. The members page. The members page.
							<br> The members page. The members page. The members page.
							<br> The members page. The members page. The members page.
						</p>
					</div>

					<div class="col-md-4">
						<h3>Special Offers To Members Only. </h3>
						<br><b>Rent a Locker for &dollar;10.00</b></br>
						<br>
						<img alt="Lockers" title="Locker Rental" height="207" src="e-lockers.jpg"
						width ="280">
						</br>
					</div>
				</div>
			</div><!-- End Of The Elements Page Content. -->
		</div>
		<?php include ('footer.php'); ?>
	</body>
</html>  