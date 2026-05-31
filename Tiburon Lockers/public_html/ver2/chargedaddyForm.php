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
<html>
	<head>
		<title>Search page</title>
		<meta charset="utf-8">

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
		<style type ="text/css">
			h3.red {
				color:red;
				font-size:105%;
				font-weight:bold;
				text-align:center;
			}

			h4{
				text-align: center;
			}

			h{
				position:absolute; bottom:230px; right:50px; color:navy; width:666px; text-align:center;
				margin:5px auto 0;
			}
		</style>
	</head>

	<body>
		<div class="container">
			<?php include($url);?>
			<div id='content'>
				<!--Start of the view_users_page content. -->
				<h2> Search For A Record In The ChargeDaddy Database </h2>
				<h3 class="red"> Please Insert Below Either the Name, Zip-Code Or Name Of The Company Below </h3>

				<form action="view_found_CDrecord.php" method="post">
					<p>
					<label for="search">General Search:</label>
					<input id="search" type="text" name="search" size="30" maxlength="30"
					value="">
					<?php 
						if (isset($_POST['search'])){ 
						echo $_POST['seach']; 
						}
					?>
					</p>
					<b>
					<button class="btn btn-default" id="submit" type="submit" name="submit" value="Search">Search</button>
					</b>
				</form>
				<!-- End of the page content. -->
			</div>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>