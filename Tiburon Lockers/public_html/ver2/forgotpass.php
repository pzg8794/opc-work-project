<?php
	if(session_status() == PHP_SESSION_NONE){
	session_start();
	}
	$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Forget Password</title>
		
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
			<?php include('header.php'); ?>
			<?php 
				if(!$user_id) {
					if ($_POST['resetbtn']) {
						$email = $_POST['email'];
						if ($email) {
							if ((strlen($email) > 7) && (strstr($email, "@")) && (strstr($email, "."))) {
								//connect	
								require("mysqli_connect.php");
								
								$query = "SELECT * FROM users WHERE email='$email'";
								$rs = mysqli_query($dbcon, $query);
								$numrows = mysqli_num_rows($rs);

								if ($numrows == 1) {
									$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);								
									$dbemail = $row['email'];
									// make sure the email is correct
									if ($email == $dbemail) {
										// generate password
										$pass = rand();
										$pass = substr($pass, 0, 15);
										$password = SHA1($pass);	
										// update db with new password
										$query_psword = "UPDATE users SET psword='$password' WHERE email='$email'";
										mysqli_query($dbcon, $query_psword);
										
										// make sure the password was changed
										$query = "SELECT * FROM users WHERE email='$email' AND psword='$password'";
										$rs = mysqli_query($dbcon, $query);
										$numrows = mysqli_num_rows($rs);
										if ($numrows == 1) {
											// create email vars
											$webmaster = "schen@tiburonlockers.com";
											$headers = "From: Thomas<$webmaster>";
											$subject = "Tiburonlockers.net: Your new password";
											$message = "Hello, your password has been reset!";
											$message = "Passowrd: $pass\n";
											
											if (mail($email, $subject, $message, $headers)) {
												echo "Your password has been reset. The new password is sent to your email";
											} else {
												echo "An error has occured and your email was not sent with your password";
											}
										}																				
									} else {
										echo "Email does not exist in the account";
									}
								}					
							} else {
								echo "Please enter a valid email address";
							}
						} else {
							echo "Please enter your email";
						}
					} 
					
					echo "<form action='forgotpass.php' method='POST'>
					<table>
						<tr>
							<td>Email:</td>
							<td><input class='form-control' type='text' name='email' /></td>
						</tr>
						<tr>
							<td></td>
							<td><input class='btn btn-default' type='submit' name='resetbtn' value='Reset Password'/></td>	
						</tr>
					</table>
					</form>";							
				} else {
					echo "Please logout to view this page";
				}
			?>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>