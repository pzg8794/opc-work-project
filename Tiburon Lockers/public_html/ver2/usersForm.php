<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

	if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)){
		header("Location: login.php");
		exit();
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
			<?php include('mainbar.php'); ?>

			<div id='content'>
				<!--Start of the view_users_page content. -->
				<h2> Search For A Record In The Users Database </h2>
				<h3 class="red"> Both Names Are Required Items</h3>

				<form action="view_found_record.php" method="post">
					<p>
					<label for="fname">First Name:</label>
					<input id="fname" type="text" name="fname" size="30" maxlength="30"
						   value="
						 <?php 
							if (isset($_POST['fname'])){ 
								 echo $_POST['fname']; 
							}
						 ?>">
					</p>

					<p>
					<label for="lname">Last Name:</label>
					<input id="lname" type="text" name="lname" size="30" maxlength="40"
					value="
						 <?php 
							if (isset($_POST['lname'])) 
								echo $_POST['lname']; 
						 ?>">
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