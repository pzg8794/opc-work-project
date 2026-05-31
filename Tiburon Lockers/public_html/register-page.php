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
<html lang="en">

  <head>
    <title>Register Page</title>
    <meta charset=utf-8>
      <link rel="stylesheet" type="text/css" href="includes.css">
</head>

  <body>
    <div id='container'>
      <?php include('nav1.php'); ?>
      <div id='content'><!--Start of page content. -->
<p>
<?php
//The link to the database is moved here to the top of the PHP code.
require('mysqli_connect.php'); //connect to the database.
//The script performs an INSERT query that adds a record to the users table.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); // Initialize an error array.

	//was the first name entered?
	if (empty($_POST['fname'])){
		$errors[] = 'You Did Not Enter Your First Name.';
	}
	else{
		$fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
	}
	
  // was the last name entered?
	if (empty($_POST['lname'])){
		$errors[] = 'You Did Not Enter Your Last Name.';
	}
	else{
		$ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
	}
	
  // was the email entered?
	if (empty($_POST['email'])){
		$errors[] = 'You Did Not Enter Your Email.';
	}
	else{
		$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
	}
  
	//did the two password matche?
	if (!empty($_POST['psword1'])){
		if( $_POST['psword1'] != $_POST['psword2']){
			$errors[] = 'Your Passwords Do Not Match.';
	  }
	  else{
		  $p = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
	  }
  }else{
	  $errors[] = 'You Have Not Entered Your Password.';
  }

  //user level?
	if (!empty($_POST['user_level'])){
		$ul = mysqli_real_escape_string($dbcon, trim($_POST['user_level']));
      
  }else{
	  $errors[] = 'You Have Not Entered The User\'s Level.';
  }
  
  //Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
  if( empty($errors)) { //If no problems encountered, register user in the database
	  //make the query
    
    //Retrieve the user_id, first_name, last_name, user_level for that email/password 
		//combination 
		$q = "SELECT * FROM users WHERE (email ='$e')
    UNION
    SELECT * FROM users WHERE (fname ='$fn' AND lname='ln')";
		
		//Run the query and assign it to the variable result
		$rs = mysqli_query($dbcon, $q);
    $data = mysqli_fetch_array($rs, MYSQLI_NUM);
    
    if($data[0] > 1){
	    
        echo '<h2> Error! </h2>
	      <p class="error"> User Is Already Registered <br>';
    	  echo '</p><h3>Please Log In Instead</h3>';
    }
    else{
      
      $q = "INSERT INTO users (user_id, fname, lname, email, psword, registration_date,user_level)
	    VALUES(' ', '$fn', '$ln', '$e', SHA1('$p'), NOW(), $ul)";
      $result = @mysqli_query($dbcon, $q); //Run the query.
	
	    if($result) {//If it ran ok.
		    header ("location: register-thanks.php");
		    exit();
		    //end of SUCCESSFUL SECTION
	    }
	    else{ // if the form handler or database table contained errors
		    //display an error message
		    echo '<h2> System Error </h2>
		    <p class="error"> Sorry, Your Registration Was not Possible Due To A System Error. Please Try Again Later.</p>';
		    //Debug the message:
		    echo '<p>' . mysqli_error($dbcon). '<br><br>Query: ' . $q . '</p>';
	    }//End of if clause($result).
    
	    mysqli_close($dbcon); //Close the database connection.
	    // Include the footer and wait the script:
	    include ('footer.php');
	    exit();
    }
    
  }else{ //Display the errors
	  echo '<h2> Error! </h2>
	  <p class="error"> The following error(s) occurred:<br>';
	  foreach ($errors as $msg) { //Print each error.
			echo " - $msg<br>\n";
	  }
	  echo '</p><h3>Please Try Again.</h3>';
  } //End of if (empty($errors))IF.
}//End of the main Submit Conditional

?>
<h2> Register </h2>
<!--display the form on the screen -->
<form action="register-page.php" method="post">
<p><label class="label" for="fname">First Name:</label>
<input id="fname" type="text" name="fname" size="30" maxlength="30" 
       value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></p>

<p><label class="label" for="lname">Last Name:</label>
<input id="lname" type="text" name="lname" size="30" maxlength="40"
value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></p>

<p><label class="label" for="email">Email Address:</label>
<input id="email" type="text" name="email" size="30" maxlength="60"
value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>

<p><label class="label" for="psword1">Password:</label>
<input id="psword1" type="text" name="psword1" size="12" maxlength="12"
value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" >&nbsp;
Between 8 and 12 characters.</p>

<p><label class="label" for="psword2">Confirm Password:</label>
<input id="psword2" type="text" name="psword2" size="12" maxlength="12"
value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>"></p>

  <p>
    <label class="label" for="user_level">Select User Level:</label>
      <select id="user_level" type="text" name="user_level">
        <option value = ""> From This List </option>
        <option value = "0"> Sales 
        </option>
        <option value = "2"> Management
        </option>
        <option value = "1"> Engineering
        </option>
      </select>
  </p>

  <p><input id="submit" type="submit" name="submit" value="Register"></p>
</form><!-- End of the page content. -->
<?php 
include ('footer.php'); ?></p>
</div>
</div>
</body>
</html>