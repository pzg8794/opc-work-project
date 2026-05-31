<!doctype html>
<html lang=en>
<head>
<title>The Login page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="tstyle.css">
</head>
<body>
<div id="container">
<?php include("header.php"); ?>
<div id="content"><!-- Start of the login page content. -->

  
  
  <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php');
	if (!empty($_POST['user_id'])) {
			$e = mysqli_real_escape_string($dbcon, $_POST['user_id']);
	} else {
	$e = FALSE;
		echo '<p class="error">You forgot to enter your User IDENTIFICATION.</p>';
	}
	// Validate the password:
	if (!empty($_POST['pswrd'])) {
			$p = mysqli_real_escape_string($dbcon, $_POST['pswrd']);
	} else {
	$p = FALSE;
		echo '<p class="error">You forgot to enter your password.</p>';
	}
  
  //if no problems
	if ($e && $p){  
  
// Check to see if this is the first time logging in:
		$q = "SELECT user_id, pswrd, fname, user_level FROM users WHERE (user_id='$e' AND pswrd='$p')";		
//run the query and assign it to the variable $result
		$result = mysqli_query ($dbcon, $q); 
// Count the number of rows that match the user ID/password combination
// echo $e, $p, '<p class="error">before if. </p>';
//The user input matched the database record
if (@mysqli_num_rows($result) == 1) {
// echo '<p class="error">after if.</p>';
// Start the session, fetch the record and insert the two values in an array
  session_start();
  $_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
  $_SESSION['user_level'] = (int) $_SESSION['user_level']; // Ensure that the user level is an integer
		if ($p == "password") {
    echo '<p class="error">Please create a new password.</p>';
        header('location: create-ini-pw.php');

	} else {
		$errors[] = 'You forgot to enter your password.';
	}
}

   
    
    
    
// Retrieve the user_id, first_name and user_level for that email/password combination:
		$q = "SELECT user_id, pswrd, fname, user_level FROM users WHERE (user_id='$e' AND ipswrd='$p' AND pswrd=SHA1('$p'))";		
//run the query and assign it to the variable $result
		$result = mysqli_query ($dbcon, $q); 
// Count the number of rows that match the user ID/password combination
echo $e, $p, '<p class="error">before if. </p>';
//The user input matched the database record

if (@mysqli_num_rows($result) == 1) {
echo '<p class="error">after if.</p>';
// Start the session, fetch the record and insert the three values in an array
		session_start();
		$_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
$_SESSION['user_level'] = (int) $_SESSION['user_level']; // Ensure that the user level is an integer
    echo '<p class="error">Entering Switch.</p>';

switch ($_SESSION['user_level']) {
  case 0:
    header('location: admin-page.php');
    echo '<p class="error">Zero Page.</p>';
    break;
  case 1:
    header('location: admin-page.php');
    echo '<p class="error">Admin Page.</p>';
    break;
  case 2:
    header('location: tech-page.php');
    echo '<p class="error">Tech Page.</p>';
    break;
  case 3:
    header('location: mng-page.php');
    echo '<p class="error">Management Page.</p>';
    break;
  case 4:
    header('location: sales-page.php');
    echo '<p class="error">Sales Page.</p>';
    break;
  default: 
  	echo '<p class="error">The User ID and password entered do not match our records.<br>Please contact the Administrator.</p>';
	  echo '<p class="error">Please try again.</p>';
	  mysqli_close($dbcon);
  }
  
  
  exit(); // Cancels the rest of the script.
	mysqli_free_result($result);
	mysqli_close($dbcon);
  }  
  }
  }
 
?>

  
  
  <!-- Display the form fields-->
<div id="loginfields">
<?php include ('login_page.inc.php'); ?>
</div><!--loginfields-->
  <br>
<?php include ('footer.php'); ?>
</div><!--content-->
</div><!--container-->
</body>
</html>
