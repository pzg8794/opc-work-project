<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
	
	if(!isset($_SESSION['user_level']) or $_SESSION['user_level'] == 0){
		header("Location: login.php");
		exit();
	}
	
	$user_id = $_SESSION['user_id'];
	$url = 'header.php';
	
	if(empty($_SESSION['user_id'])){
		//exit(); 
	}
	else {	
		if(( $_SESSION['user_level']) == 1)
			$url = 'mainbar.php';
		else
			$url = 'member-nav.php';
	}	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Reset Password</title>
		
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
		<div class = "container">
			<?php include($url); ?>
			<?php
					if ($_POST['resetpass']) {
						// get the form data
						$pass = $_POST['pass'];
						$newpass = $_POST['newpass'];
						$confirmpass = $_POST['confirmpass'];	
						$email = $_POST['email'];
						// make sure all data was entered
						if ($pass) {
							if ($newpass) {
								if ($confirmpass) {
									if ($newpass === $confirmpass) {
										require("mysqli_connect.php");
										$password = SHA1($pass);		
										
										$query = "SELECT * FROM users WHERE email='$email' AND psword='$password'";
										$rs = mysqli_query($dbcon, $query);
										$numrows = mysqli_num_rows($rs);
										if ($numrows == 1) {
											// encypt new password
											$newpassword = SHA1($newpass);
											
											// update the db with the new pass
											$query = "UPDATE users SET psword='$newpassword' WHERE email='$email'";
											mysqli_query($dbcon, $query);
											// make sure the password was changed	
											$query = "SELECT * FROM users WHERE email='$email' AND psword='$newpassword'";
											$rs = mysqli_query($dbcon, $query);										
											$numrows = mysqli_num_rows($rs);
											
											if ($numrows) {
												echo "Your password has been reset";
											} else {
												echo "An error has occured and your password was not reset. Please try again";
											}		
										} else {
											echo "Your current password is incorrect";
										}								
									} else {
										echo "Your new password did not match";
									}				
								} else {
									echo "Your must confirm your new password";
								} 
							} else {
								echo "You must enter your new password";							
							} 																							
						} else {
							echo "You must enter your current password";
						}
						mysqli_close($dbcon);
					}
					echo "<form action='resetpass.php' method='POST'>
						<table>
						<tr>
							<td>Email:</td>
							<td><input class='form-control' type='text' name='email'></td>
						</tr>
						<tr>
							<td>Current Password:</td>
							<td><input class='form-control' type='password' name='pass'></td>
						</tr>
						<tr>
							<td>New Password:</td>
							<td><input class='form-control' type='password' name='newpass'></td>
						</tr>
						<tr>
							<td>Confirm Password:</td>
							<td><input class='form-control' type='password' name='confirmpass'></td>
						</tr>
						<tr>
							<td></td>
							<td><input class='btn btn-default' type='submit' name='resetpass' value='Reset Password' /></td>
						</tr>
						</table>
					</form>";						
			?>

		</div>
		<?php include("footer.php"); ?>
	</body>
</html>
	