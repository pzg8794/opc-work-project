<!doctype html>
<html lang="en">

  <head>
    <title>The Login Page</title>
    <meta charset=utf-8>
      <link rel="stylesheet" type="text/css" href="includes.css">
</head>

  <body>
    <div id='container'>
      <?php include('nav1.php'); ?>
      <div id='content'><!--Start of page content. -->
<p>
<?php

//This section processes submissions from the login form
//Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//connect to database
	require ('mysqli_connect.php');
	
	// Validate the email address
	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string($dbcon, $_POST['email']);
	}
	else {
		$e = FALSE;
		echo '<p class="error"> You Have Not Entered Your Email Address. </p>';
	}
	
	//Validate the password
	if (!empty($_POST['psword'])){
		$p = mysqli_real_escape_string($dbcon, $_POST['psword']);
	}
	else{
		$p = FALSE;
		echo '<p class="error"> You Have Not Entered Your Password. </p>';
	}
	
	if ($e && $p) { //If no problems	
		//Retrieve the user_id, first_name, last_name, user_level for that email/password 
		//combination 
		$q = "SELECT user_id, fname, lname, user_level FROM users WHERE (email ='$e' AND psword=SHA1('$p'))";
		
		//Run the query and assign it to the variable result
		$result = mysqli_query($dbcon, $q);
		
		// Count the number of rows that match the email/pasword combination
		if (@mysqli_num_rows($result) == 1) {
			
			//if one database row (record) matches the input: start the session,
			// fetch the record and insert the three values in a array
			session_start();
			$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			//Ensure that the user level is an integer.
			$_SESSION['user_level'] = (int)$_SESSION['user_level'];
			
			//Use a ternary operation to set the URL
			if($_SESSION['user_level'] == 1) {
          			 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-page.php">';    
      			}else{
          			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=members-page.php">';  
      			}
			exit(); //Cancel the rest of the script
			mysqli_free_result($result);
			mysqli_close($dbcon);
		 }
		 else{//No match was made.
			echo '<p class="error"> Please try again. </p>';
		 }
		// mysqli_close($dbcon);
	}
	else{ //If there was a problem.
		echo '<p class="error"> Please Try Again. </p>';
	}
	mysqli_close($dbcon);
}//End of SUBMIT conditional.
?>

<!-- Display The Form Fields -->
<div id="loginfields">
  
  <h2> Login </h2>
  <form action="login.php" method="post">
    <p>
      <label class="label" for="email">Email Address:</label>
      <input id="email" type="text" name="email" size="30" maxlength=""
      value=""<?php if(isset($_POST['email'])) echo $_POST['email'];?>" >
    </p>

    <p>
      <label class="label" for="psword">Current Password:</label>
      <input id="psword" type="password" name="psword" size="12" maxlength=""
      value=""<?php if(isset($_POST['psword'])) echo $_POST['psword'];?>">
      <span>&nbsp;</span>
    </p>

    <!--<input name="searchbox" onfocus="if (this.value=='search') this.value = ''" type="text" value="search"> --->

    <p>&nbsp;</p>
    <p>
      <input id="submit" type="submit" name="""submit" value="login">
    </p>
  </form>
  <br>
    
</div><br>
<?php include ('footer.php'); ?></p>
</div>
</div>
</body>
</html>  