<!doctype html>
<html lang=en>
<head>
<title>Add Unit</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
<style type="text/css">
#midcol { width:98%; margin:auto; }
input, select { margin-bottom:5px; }
h2 { margin-bottom:0; margin-top:5px; }
h3.content { margin-top:0; }
.cntr { text-align:center; }
</style>
</head>
<body>
<div id="container">
<?php include("includes/register-header.php"); ?>
<div id="content"><!--Start of the registration page content-->
<?php
require ('mysqli_connect.php'); // Connect to the database
// This code inserts a record into the chargedaddy table
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); // Start an array named errors 

// Trim the Serial Number
$name = trim($_POST['serialnumber']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($serialnumber));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
    $errors[] = 'You forgot to enter the Serial Number.';
}else{
$sn = $stripped;
}

// Trim the Organization's name
$lnme = trim($_POST['oname']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($onme));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
    $errors[] = 'You forgot to enter the organization\'s name.';
}else{
$on = $stripped;
}

// Trim the 1st address line
$lnme = trim($_POST['addr1']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($addr1));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
    $errors[] = 'You forgot to enter the address.';
}else{
$a1 = $stripped;
}

// Trim the 2nd address line
$lnme = trim($_POST['addr2']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($addr2));
// Get string lengths
// $strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
// if( $strlen < 1 ) {
//     $errors[] = 'You forgot to enter the address.';
// }else{
$a2 = $stripped;
}
	
// Trim the city
$lnme = trim($_POST['city']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($city));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
    $errors[] = 'You forgot to enter the city.';
}else{
$cy = $stripped;
}

// Trim the state
$lnme = trim($_POST['state']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($state));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
    $errors[] = 'You forgot to enter the state.';
}else{
$st = $stripped;
}

// Trim the zipcode
$lnme = trim($_POST['zcode']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($zcode));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
    $errors[] = 'You forgot to enter the zipcode.';
}else{
$zc = $stripped;
}

// Trim the phone number
$lnme = trim($_POST['phone']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($phone));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
    $errors[] = 'You forgot to enter the phone number.';
}else{
$pn = $stripped;
}

// Trim the email
$lnme = trim($_POST['email']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($email));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
    $errors[] = 'You forgot to enter the email.';
}else{
$em = $stripped;
}

if (empty($errors)) { // If there were no errors
$q = "INSERT INTO chargedaddy (user_id, fname, lname, email, psword, registration_date) VALUES (' ', '$fn', '$ln', '$e', SHA1('$p'), NOW())";		

// $q = "UPDATE users SET fname='$fn', lname='$ln', addr1='$addr1', addr2='$addr2', city='$city', county='$county', pcode='$pcode', phone='$phone' WHERE user_id=$id LIMIT 1";
		$result = @mysqli_query ($dbcon, $q); // Run the query
		if ($result) { // If the query ran OK
		header ("location: register-thanks.php"); 
		exit();
		} else { // If the query did not run OK
		// Message
			echo '<h2>System Error</h2>
			<p class="error">You could not be registered due to a system error. We apologize for the inconvenience.</p>'; 
			// Debugging message:
			echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
		} // End of if ($result)
		mysqli_close($dbcon); // Close the database connection
		// Include the footer and stop the script
		include ('includes/footer.php'); 
		exit();
	} else {//The email address is already registered 
	echo '<p class="error">The email address is not acceptable because it is already registered</p>';
	}
	}else{ // Display the errors
		echo '<h2>Error!</h2>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Display each error
			echo " - $msg<br>\n";
		}
		echo '</p><h3>Please try again.</h3><p><br></p>';
		}// End of if (empty($errors))
} // End of the main Submit conditionals
?>
<div id="midcol">
<h2>User Registration</h2>
<form action="safer-register-page.php" method="post">
	<br><label class="label" for="fname">First Name*</label><input id="fname" type="text" name="fname" size="30" maxlength="30" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
	<br><label class="label" for="lname">Last Name*</label><input id="lname" type="text" name="lname" size="30" maxlength="40" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">
	<br><label class="label" for="email">Email Address*</label><input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
	<br><label class="label" for="psword1">Password*</label><input id="psword1" type="password" name="psword1" size="12" maxlength="12" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" >&nbsp;8 
	to 12 characters
	<br><label class="label" for="psword2">Confirm Password*</label><input id="psword2" type="password" name="psword2" size="12" maxlength="12" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>" >
	<p><input id="submit" type="submit" name="submit" value="Register"></p>
</form>
</div></div></div>
<?php include ('includes/footer.php'); ?>
<!-- End of the registration page content -->
</body>
</html>