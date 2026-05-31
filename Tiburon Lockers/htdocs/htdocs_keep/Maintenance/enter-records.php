<!doctype html>
<html lang="en">
<head>
<title>Register page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="tstyle.css">
</head>
<body>
<div id="container">
<?php include("header.php"); ?>
<?php include("info-col.php"); ?>
	<div id="content"><!-- Start of the page-specific content. -->
<p>
    <?php
// This script is a query that INSERTs a record in the users table.
// Check that form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); // Initialize an error array.
	// Check for a first name:
	if (empty($_POST['SerialNumber'])) {
		$errors[] = 'You forgot to enter the Unit Serial Number.';
	} else {
		$sn = trim($_POST['SerialNumber']);
	}
	// Check for a last name:
	if (empty($_POST['Delivered'])) {
		$errors[] = 'You forgot to enter the date delivered.';
	} else {
		$dd = trim($_POST['Delivered']);
	}
	// Check for an SoftwareBuild address:
	if (empty($_POST['SoftwareBuild'])) {
		$errors[] = 'You forgot to enter the Software Build.';
	} else {
		$sb = trim($_POST['SoftwareBuild']);
	}
	// Check for a TabletMakeModel:
	if (empty($_POST['TabletMakeModel'])) {
		$errors[] = 'You forgot to enter the tablet make and model.';
	} else {
		$tmm = trim($_POST['TabletMakeModel']);
	}
	// Check for a OS:
	if (empty($_POST['OS'])) {
		$errors[] = 'You forgot to enter the OS Type.';
	} else {
		$os = trim($_POST['OS']);
	}
	// Check for MasterSlave:
	if (empty($_POST['MasterSlave'])) {
		$errors[] = 'You forgot to enter if Master or Slave.';
	} else {
		$ms = trim($_POST['MasterSlave']);
	}
	// Check for a Mount:
	if (empty($_POST['Mount'])) {
		$errors[] = 'You forgot to enter the Mount type.';
	} else {
		$mt = trim($_POST['Mount']);
	}
	// Check for a Doors:
	if (empty($_POST['Doors'])) {
		$errors[] = 'You forgot to enter the number of Doors.';
	} else {
		$dr = trim($_POST['Doors']);
	}
	// Check for an Active:
	if (empty($_POST['Active'])) {
		$errors[] = 'You forgot to enter the Active.';
	} else {
		$av = trim($_POST['Active']);
	}
	// Check for a Customer:
	if (empty($_POST['Customer'])) {
		$errors[] = 'You forgot to enter the Customer.';
	} else {
		$cu = trim($_POST['Customer']);
	}
	// Check for a Location:
	if (empty($_POST['Location'])) {
		$errors[] = 'You forgot to enter the Location.';
	} else {
		$lo = trim($_POST['Location']);
	}
	// Check for Notes:
//	if (empty($_POST['MasterSlave'])) {
//		$errors[] = 'You forgot to enter if Master or Slave.';
//	} else {
//		$e = trim($_POST['MasterSlave']);
//	}
		if (empty($errors)) { // If everything's OK.
	// Register the user in the database...
		require ('mysqli_connect.php'); // Connect to the db.
		// Make the query:
		$q = "INSERT INTO chargedaddy (SerialNumber, Delivered, SoftwareBuild, TabletMakeModel, OS, MasterSlave, Mount, Doors, Active, Customer, Location, Notes) VALUES ('$sn', '$dd', '$sb', '$tmm', ('$os'), '$ms', '$mt', '$dr', '$av', ('$cu'), ('$lo'), NOW() )";		
		$result = @mysqli_query ($dbcon, $q); // Run the query.
		if ($result) { // If it ran OK.
		header ("location: register-thanks.php"); 
		exit();
		// Print a message:
		//echo '<h2>Thank you!</h2>
		//<p>You are now registered. In Chapter 12 you will actually be able to log in!</p><p><br></p>';	
		} else { // If it did not run OK.
		// Public message:
			echo '<h2>System Error</h2>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			// Debugging message:
			echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
		} // End of if ($r) IF.
		mysqli_close($dbcon); // Close the database connection.
		// Include the footer and quit the script:
		//include ('includes/footer.html'); 
		include ('footer.php'); 

		//header ("location: register-thanks.php"); 
		exit();
	} else { // Report the errors.
		//header ("location: register-page.php"); 
		echo '<h2>Error!</h2>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><h3>Please try again.</h3><p><br></p>';
		}// End of if (empty($errors)) IF.
} // End of the main Submit conditional.
?>
<h2>Register</h2>
<form action="access.php" method="post">
	<p><label class="label" for="SerialNumber">Serial Number (six digits):</label><input id="SerialNumber" type="number" name="SerialNumber" min="1" max="65000" value="<?php if (isset($_POST['SerialNumber'])) echo $_POST['SerialNumber']; ?>"></p>
	<p><label class="label" for="Delivered">Date Delivered (mm/dd/yyy):</label><input id="Delivered" type="date" name="Delivered" size="10" maxlength="10" value="<?php if (isset($_POST['Delivered'])) echo $_POST['Delivered']; ?>"></p>
	<p><label class="label" for="SoftwareBuild">Software Build:</label><input id="SoftwareBuild" type="text" name="SoftwareBuild" size="30" maxlength="60" value="<?php if (isset($_POST['SoftwareBuild'])) echo $_POST['SoftwareBuild']; ?>" > </p>
	<p><label class="label" for="TabletMakeModel">Tablet Make and Model:</label><input id="TabletMakeModel" type="text" name="TabletMakeModel" size="12" maxlength="12" value="<?php if (isset($_POST['TabletMakeModel'])) echo $_POST['TabletMakeModel']; ?>" ></p>
	<p><label class="label" for="OS">Operating System:</label><input id="OS" type="text" name="OS" size="12" maxlength="12" value="<?php if (isset($_POST['OS'])) echo $_POST['OS']; ?>" ></p>
  <p><label class="label" for="MasterSlave">Master or Subordinate:</label><input id="MasterSlave" type="text" name="MasterSlave" size="30" maxlength="30" value=""<?php if (isset($_POST['MasterSlave'])) echo $_POST['MasterSlave']; ?>"></p>
  <p><label class="label" for="Mount">Pedestal or Wall Mount:</label><input id="Mount" type="text" name="Mount" size="30" maxlength="40" value=""<?php if (isset($_POST['Mount'])) echo $_POST['Mount']; ?>"></p>
  <p><label class="label" for="Doors">Number of Doors (8 or 12):</label><input id="Doors" type="number" name="Doors" min="8" max="12" value=""<?php if (isset($_POST['Doors'])) echo $_POST['Doors']; ?>" ></p>
  <p><label class="label" for="Active">Active:</label><input id="Active" type="text" name="Active" size="12" maxlength="12" value=""<?php if (isset($_POST['Active'])) echo $_POST['Active']; ?>" ></p>
  <p><label class="label" for="Customer">Customer:</label><input id="Customer" type="text" name="Customer" size="25" maxlength="25" value=""<?php if (isset($_POST['Customer'])) echo $_POST['Customer']; ?>" ></p>
  <p><label class="label" for="Location">Location:</label><input id="Location" type="text" name="Location" size="30" maxlength="30" value=""<?php if (isset($_POST['Location'])) echo $_POST['Location']; ?>" ></p>
  <p><input id="submit" type="submit" name="submit" value="Register"></p>
</form>
<?php include ('footer.php'); ?></p>
	<!-- End of the page-specific content. -->
</div>
</div>	
</body>
</html>