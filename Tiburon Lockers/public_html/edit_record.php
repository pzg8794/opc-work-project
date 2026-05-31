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
<html lang=en>

<head>
<title> Edit A Record </title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">

  <style type ="text/css">
    p{
    text-align:center;
    }
    input.fl.left {
      float:left;
    }
    #submit {
      float: left;
    }
  </style>
  
</head>
  
<body>
  <div id='container'>
    <?php include('nav1.php'); ?>
    <div id='content'> <!--Start to edit the page content. -->
      <h2> Edit A Record </h2>
      <p>
        <?php
    
      //After clicking the edit link in the found_record.php page, the editing interface appears
      //The code looks for a valid user ID, either through GET or POST

  if((isset($_GET['id'])) && (is_numeric($_GET['id']))){ 
    //From View_Users.php
    $id= $_GET['id'];
  }
  else if ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ){ 
    //Form submission
    $id = $_POST['id'];
  }
  else { //if not valid id, stop the script
    echo '<p class="error"> This Page Has Been Accessed In Error</p>';
    include ('footer.php');
    exit();
  }
  
  
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
     
   //Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
  if( empty($errors)) { //If no problems encountered, register user in the database
	  //make the query
	  //check that the email is not already in the users table
        $q = "UPDATE users SET fname='$fn', lname='$ln', email ='$e' WHERE user_id = $id";
        $result = @mysqli_query ($dbcon, $q);
	
	  if($result) {//If it ran ok.
		   
            if (mysqli_affected_rows($dbcon) == 1){
            
              //If it ran OK
              //Echo a message if the edit was satisfactory
              echo '<h3> The User Has Been Edited. </h3>';
         
             }
            else { // If the email address is already registered
            
                echo '<p class="error"> The email address has already been registered. </p>';
            }
	  }
    else { //echo a message if the query failed
      
            echo '<p class="error"> The User Could Not Be Edited Due To A System Error..
            We Apologize For The Inconvenience.</p>'; // Error Message.
            echo '</p>'.mysqli_error($dbcon).'<br />Query: '.$q.'</p>'; //Debugging Message.
    }
	  

	  mysqli_close($dbcon); //Close the database connection.
	  // Include the footer and wuit the script:
	  include ('footer.php');
	  exit();
  }else{ //Display the errors
	  echo '<h2> Error! </h2>
	  <p class="error"> The following error(s) occurred:<br>';
	  foreach ($errors as $msg) { //Print each error.
			echo " - $msg<br>\n";
	  }
	  echo '</p><h3>Please Try Again.</h3><p><br></p>';
  } //End of if (empty($errors))IF.
}//End of the main Submit Conditional
  
//select the record
$q = "SELECT fname, lname, email FROM users WHERE user_id=$id";
$result = @mysqli_query($dbcon, $q);

if(mysqli_num_rows($result) == 1){ // Valid user ID, display the form.
  // Get the user's information
  $row = mysqli_fetch_array ($result, MYSQLI_NUM);
  //Create the form
  echo '<form action="edit_record.php" method="post">

  <p><label class="label" for="fname">First Name:</label>
  <input class="fl-left" id="name" type="text" name="fname" size="30" maxlength="30" 
       value="'.$row[0].'"></p>
  <br><p>
    <label class="label" for="lname">Last Name:</label>
    <input class="fl-left" type="text" name="lname" size="30" maxlength="40"
    value="'.$row[1].'"></p>
  </p>

  <br><p>
    <label class="label" for="email">Email Address:</label>
    <input class="fl-left" type="text" name="email" size="30" maxlength="60"
    value="'.$row[2].'"></p>
  </p>

  <br><p>
    <input id="submit" type="submit" name="submit" value="edit">
  </p>
  <br><input type="hidden" name="id" value="'. $id .'"/>
  </form>';
}
else{ //The record could not be validated
  echo '<p class="error"> This Page Has Been Accessed In Error</p>';
}
mysqli_close($dbcon); // Close the datqabase connection.
//<!-- End of the page content. -->
include ('footer.php')
?>
      </p>
    </div>
  </div>
</body>
</html>