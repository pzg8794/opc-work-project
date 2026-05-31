<?php
if(session_status() == PHP_SESSION_NONE){
  session_start();
}

$ul = $_SESSION['user_level'];
if(!isset($_SESSION['user_level']) or ($ul != 1)){
  header("Location: login.php");
  exit();
}
?>

<!doctype html>
<html lang="en">

  <head>
    <title> Adding a Project </title>
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

  //was the start date entered?
	if (empty($_POST['year'])||empty($_POST['month'])||empty($_POST['day'])){
		$errors[] = 'You Did Not Enter Or Complete The Start Date.';
	}
	else{
    $m = $_POST['month'];
    $d = $_POST['day'];
    $y = $_POST['year'];
    
    $m .= "-";
    $m .= $d;
    $m .= "-";
    $m .= $y;
    $date=date_create($m);
		$st = mysqli_real_escape_string($dbcon, trim(date));
	}
  
  //was the end date entered?
	if (empty($_POST['year2'])||empty($_POST['month2'])||empty($_POST['day2'])){
		$errors[] = 'You Did Not Enter Or Complete The End Date.';
	}
	else{
		$m = $_POST['month2'];
    $d = $_POST['day2'];
    $y = $_POST['year2'];
    
    $m .= "-";
    $m .= $d;
    $m .= "-";
    $m .= $y;
		$date=date_create($m);
		$st = mysqli_real_escape_string($dbcon, trim(date));
	}
  
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
  
	// was the project name entered?
	if (empty($_POST['project_name'])){
		$errors[] = 'You Did Not Enter The Project Name.';
	}
	else{
    $pn = mysqli_real_escape_string($dbcon, trim($_POST['project_name']));
	}

  //was the priority level entered?
	if (empty($_POST['priority'])){
	  $errors[] = 'You Have Not Entered The Priority Level.';
  }else{
    $pr = mysqli_real_escape_string($dbcon, trim($_POST['priority']));
  }
  
	if (!empty($_POST['comments'])){
		$com = mysqli_real_escape_string($dbcon, trim($_POST['comments']));
      
  }else{
	  $com = " ";
  }
  
  //Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
  if( empty($errors)) { //If no problems encountered, register user in the database
	  //make the query
    
    //Retrieve the user_id, first_name, last_name, user_level for that email/password 
		//combination 
		$q = "SELECT * FROM cdprojects WHERE project_name ='$pn'";
		//Run the query and assign it to the variable result
		$rs = mysqli_query($dbcon, $q);
    $data = mysqli_fetch_array($rs, MYSQLI_NUM);
    
    if($data[0] > 1){  
        echo '<h2> Error! </h2>
	      <p class="error"> Project Was Already Added <br>';
    	  echo '</p><h3>Please Try Another Project Name</h3>';
    }
    else{
      $assign = $fn;
      $q = "INSERT INTO cdprojects (id, priority, done, project_name, assignedTo, start, end, comments, proj_level)
	    VALUES(' ', '$pr', 'No', '$pn', '$assign', '$st', '$ed', '$com', '$ul')";
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
	    // Include the footer and wuit the script:
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
<h2> Adding a Project </h2>

  <!--display the form on the screen -->
<form action="addProject.php" method="post">
<p><label class="label" for="project_name">Project Name:</label>
<input id="project_name" type="text" name="project_name" size="30" maxlength="30" 
       value="<?php if (isset($_POST['project_name'])) echo $_POST['project_name']; ?>"></p>

<p><label class="label" for="fname">Assigned First Name:</label>
<input id="lname" type="text" name="fname" size="30" maxlength="40"
value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></p>

  <p>
    <label class="label" for="lname">Assigned Last Name:</label>
    <input id="lname" type="text" name="lname" size="30" maxlength="40"
    value=""<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">
  </p>


    <label class="label" for="start">Start Date:</label>
      <?php 
    // current year
    $now = date('Y');

    // build years menu
    echo '<select name="year">' . PHP_EOL;
    
    $y=$now;
    for ($counter =0; $counter<=20; $counter++) {
      
        echo '  <option value="' . $y . '">' . $y . '</option>' . PHP_EOL;
        $y++;
    }
    echo '</select>' . PHP_EOL;

    // build months menu
    echo '<select name="month">' . PHP_EOL;
    for ($m=1; $m<=12; $m++) {
        echo '  <option value="' . $m . '">' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

    // build days menu
    echo '<select name="day">' . PHP_EOL;
    for ($d=1; $d<=31; $d++) {
        echo '  <option value="' . $d . '">' . $d . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
    
?>
  
<p><label class="label" for="end">End Date:</label>
  <?php 

    // current year
    $now = date('Y');

    // build years menu
    echo '<select name="year2">' . PHP_EOL;
    
    $y=$now;
    for ($counter =0; $counter<=20; $counter++) {
      
        echo '  <option value="' . $y . '">' . $y . '</option>' . PHP_EOL;
        $y++;
    }
    echo '</select>' . PHP_EOL;

    // build months menu
    echo '<select name="month2">' . PHP_EOL;
    for ($m=1; $m<=12; $m++) {
        echo '  <option value="' . $m . '">' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

    // build days menu
    echo '<select name="day2">' . PHP_EOL;
    for ($d=1; $d<=31; $d++) {
        echo '  <option value="' . $d . '">' . $d . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
?>
</p>

  <p>
    <label class="label" for="attachment">Attachment:</label>
    <input id="attachment" type="text" name="attachment" size="12" maxlength="12"
    value=""<?php if (isset($_POST['attachment'])) echo $_POST['attachment']; ?>">
  </p>

  <p>
    <label class="label" for="priority">Priority Level:</label>
    <select id="priority" type="text" name="priority">
      <option value = ""> Select Level </option>
      <option value = "low">
        Low
      </option>
      <option value = "medium">
        Medium
      </option>
      <option value = "high">
        High
      </option>
    </select>
  </p>

  <p>
  <label class="label" for="comments">Comments:</label>
  <textarea name='comments' id='comments'></textarea><br />
  <input type='hidden' name='articleid' id='articleid' 
  value=""<?php if (isset($_POST['comments'])) echo $_POST['comments']; ?>">
</p>

  <p><input id="submit" type="submit" name="submit" value="Add Project"></p>
</form><!-- End of the page content. -->
<?php 

include ('footer.php'); ?></p>
</div>
</div>
</body>
</html>