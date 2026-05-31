<?php
//if one database row (record) matches the input: start the session,
// fetch the record and insert the three values in a array

if(session_status() == PHP_SESSION_NONE){
	session_start();
}

if(empty($_SESSION['user_id'])){
	// exit(); 
}

?>

<!doctype html>
<html>
	<head>
		<title>Register New Password Page</title>
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
</head>

	<body>
		<div class='container'>
			<?php include('mainbar.php'); ?>

			<div id='content'><!--Start of page content. -->
				<p>
				<?php
					//This page lets users change their password.
					//Was the submit botton clicked?
					if($_SERVER['REQUEST_METHOD'] == 'POST') {
						require ('mysqli_connect.php'); //Connect to the db.
						$errors = array(); //Initialize the error array.
						
						// Check for an email address:
						if (empty($_POST['email'])){
							$errors[] = 'You Have Forgotten To Enter Your Email Address.';
						}
						else{
							$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
						}
						
						//Check for the current password:
						if(empty($_POST['psword'])){
							$errors[] = 'You Have Forgotten To Enter Your Current Password.';
						}
						else{
							$p = mysqli_real_escape_string($dbcon, trim($_POST['psword']));
						}
						
						// Check for the new password and match against the confirmed password:
						if (!empty($_POST['psword1'])){
							if( $_POST['psword1'] != $_POST['psword2']){
								$errors[] = 'Your New Password Did Not Matched The Confirmed Password.';
							}
							else{
								$np = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
							}
						}
						else{
							$errors[] = 'You Forgot To Enter Your New Password.';
						}
						
						if(empty($errors)){ //If no problems occured
							//Check that the user has entered the right email address/password combination:
							$q = "SELECT user_id FROM users WHERE (email='$e' AND psword = SHA1('$p'))";
							$result = @mysqli_query($dbcon, $q);
							$num = @mysqli_num_rows($result);
							
							if ($num == 1){ //Match was made.
								//Get the user_id:
								$row = mysqli_fetch_array($result, MYSQLI_NUM);
								//Make the UPDATE query:
								$q = "UPDATE users SET psword=SHA1('$np') WHERE user_id=$row[0]";
								$result = @mysqli_query($dbcon, $q);
								
								if(mysqli_affected_rows($dbcon) == 1){ //If the query ran without a problem
								//echo message
									echo '<h2> Thank you!</h2>
									<h3> Your Password Has Been Updated.</h3>';
								}
								else { //If it encountered a problem
									//error message
									echo'<h2> System Error </h2>
									<p class="error"> Your Password Could Not Be Changed Due To A System Error.
									We Apologize for the Inconvinience.</p>';
									//Debugging Message
									echo '<p>' .mysqli_error($dbcon) . '<br /><br />Query: ' . $q . '</p>';
								}
								mysqli_close($dbcon); //Close the database connection.
								//Include the footer and quit the script (to not show the form).
								include('footer.php');
								exit();
							}
							else{ // Invalid email address/password combination.
								echo '<h2> Error! </h2>
								<p class="error"> The Email Address and Password Do Not Match Those on File.</p>';
							}
						}
						else{ // Report the Errors.
							echo '<h2> Error! </h2>
							<p class="error"> The Following Error(s) Occurred: <br />';
							foreach ($errors as $msg) { // Print Each Error.
								echo " - $msg<br />\n";
							}
							echo '</p><p class="error"> Please Try Again.</p><p><br /></p>';
						}//End of if(empty($errors))
						mysqli_close($dbcon); //close the database connection.
					} //End of the main submit conditional.
				?>

				<!--Display the form -->
				<h2> Change Your Password </h2>
				<form action = "register-password.php" method="post">
				<div class="form-group">
				<p><label for="email">Email Address:</label>
				<input class="form-control" id="email" type="text" name="email" size="40" maxlength"60"
				value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" ></p>
				</div>

				<div class="form-group">
				<p><label for="psword">Current Password:</label>
				<input class="form-control" id="psword" type="password" name="psword" size="12" maxlength"12"
				value="<?php if(isset($_POST['psword'])) echo $_POST['psword'];?>" ></p>
				</div>

				<div class="form-group">
				<p><label for="email">New Password:</label>
				<input class="form-control" id="psword1" type="password1" name="psword1" size="12" maxlength"12"
				value="<?php if(isset($_POST['psword1'])) echo $_POST['psword1'];?>" ></p>
				</div>

				<div class="form-group">
				<p><label for="email">Confirm Password:</label>
				<input class="form-control" id="psword2" type="password2" name="psword2" size="12" maxlength"12"
				value="<?php if(isset($_POST['psword1'])) echo $_POST['psword1'];?>" ></p>
				</div>

				<p><button class="btn btn-default" id="submit" type="submit" name="submit" value="Change Password">Submit</button></p>
				</form><!-- End of the page content. -->

			</div>
		</div>
		<?php include('footer.php'); ?>	
	</body>
</html>