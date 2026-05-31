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
		<title>Admin Page</title>
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
		
		<style type="text/css">
			#midcol {
			  width:98%;
			}
			#midcol p {
			  margin-left: 160px;
			}
		</style>
		
	</head>

	<body>    
		<div class="container">
			<?php include('mainbar.php'); ?>  
			<div id="content"><!--Start of page content. -->
			  <?php
				//echo '<h2> <br> </h2>';
				echo '<h2> Welcome To The Admin\'s Page ';
				if( isset($_SESSION['fname'])){
					echo "{$_SESSION['fname']}";
				}
				echo '</h2>';
			  ?>

				<div id= "midcol">
				  <h3> You Have Permission To: </h3>
				  <p>&#9632; Edit And Delete A Record.</p>
				  <p>&#9632; Use The View Members Button To See A Table Of Registered Members.</p>
				  <p>&#9632; Use The Search Button To Locate A Particular Member.</p>
				  <p>&#9632; Use The Addresses Button To Locate a Member's Address And Phone Number.</p>
				  </p>&nbsp;</p>
				</div>		
			</div>		
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>  