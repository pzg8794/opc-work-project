<?php
/**

 */
 get_header(); ?>

<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>

	<style type ="text/css">
		form {
			
			label{
				color: black;
				text-align: left;
				font-weight: bold;
			}
			
			label1{
				color: black;
				text-align: right;
				font-weight: bold;
			}

			p{
				color: black;

			}
		}

		h2{
			font-family: "Times New Roman", Times, red serif;
  			font-size: 38px;
			font-weight: bold;
  			color: black;
  			text-align:left;
			margin-top: -5px;
    			text-shadow: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		}


		h3{
			font-family: "Times New Roman", Times, red serif;
			position: relative;
  			font-size: 38px;
			font-weight: bold;
  			color: black;
  			text-align: right;
			margin-top: -55px;
    			text-shadow: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		}
	</style>
</head>





<h2> Adding a Class </h2>
<h3> Message </h3>
  <!--display the form on the screen -->

<form method="post" action="<?php echo $PHP_SELF;?>">
<p>
    	<div id="label" for="Class_Name"> Class Name: </div>
    		<div id="label"> <input id="lebel1" type="text" name="Class_Name" size="30" maxlength="30" 
    			value="<?php if (isset($_POST['Class_Name'])) echo $_POST['Class_Name']; ?>">
		</div>
	
</p>

<p>
	<div id="label" for="start">Class Date: </div>
		<div id="label1">
			<?php

$date =date('Y-m-d');
$month =date("M",strtotime($date))."(".date("m",strtotime($date)).")";

				// current year
	   			$now = date('Y');

	    			// build years menu
				echo '<select name="year">' . PHP_EOL;
	
				$y=$now;
    				for ($counter =0; $counter<=1; $counter++) {
        				echo '  <option value="' . $y . '">' . $y . '</option>' . PHP_EOL;
        				$y++;
    				}
    				echo '</select>' . PHP_EOL;

	    			// build months menu
    				echo '<select name="month">' . PHP_EOL;

	    			for ($m=date('m', strtotime('-0 month')); $m<=12; $m++) {
        				echo '  <option value="' . $m . '">' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
    				}
    				echo '</select>' . PHP_EOL;

				$t=date('d-m-Y');
				$dayName = strtolower(date("D",strtotime($t)));
				$dayNum = strtolower(date("d",strtotime($t)));

	    			// build days menu
    				echo '<select name="day">' . PHP_EOL;
    				for ($d=$dayNum; $d<=31; $d++) {
        				echo '<option value="' . $d . '">' . $d . '</option>' . PHP_EOL;
    				}
    				echo '</select>' . PHP_EOL; 
			?>
			<!-- <input id="lebel1"  name="Class_Date" value="<?php if (isset($_POST['Class_Date'])) echo $_POST['Class_Date']; ?>"> -->	
		</div>	
</p>

<p>
  	<div id="label" for="Class_Time">Class Time: </div>
		<div id="label1">
			Hour:
			<select name="hour">
				<?php foreach (range(0,24) as $hour):?>
					<option value="<?php echo $hour;?>"><?php echo $hour;?></option>
				<?php endforeach?>
			</select>

			Minute(s):
			<select name="minute">
				<?php foreach (range(0,59) as $minute):?>
					<option value="<?php echo $minute;?>"><?php echo $minute;?></option>
				<?php endforeach?>
			</select>

	  		<!-- <input id="Class_Time" type="text" name="Class_Time" size="30" maxlength="40"
  			value=""<?php if (isset($_POST['Class_Time'])) echo $_POST['Class_Time']; ?>"> -->
		</div>		
</p>

<p>
    	<div id="label" for="Class_Location"> Class Location: </div>
    		<div id="label"> <input id="lebel1" type="text" name="Class_Location" size="30" maxlength="30" 
    			value="<?php if (isset($_POST['Class_Location'])) echo $_POST['Class_Location']; ?>">
		</div>
</p>
<p><input id="submit" type="submit" name="submit" value="Add Class"></p>
</form> <!-- End of the page content. --> 

<?php
// This file provides the information for accessing the database and connecting to MySQL. It also sets the language coding to utf-8
// First we define the constants:

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'madchef_classes');

/** MySQL database username */
define('DB_USER', 'madchef_madchef');

/** MySQL database password */
define('DB_PASSWORD', 'Brando2025');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

//Make the connection
$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' .mysqli_connect_error() );

//setting
mysqli_set_charset($dbcon, 'utf8');

//if($dbcon == False)
//{
//	echo '<h3> CONNECTION UNSUCCESFUL </h3>';
//}
//else
//{
//	echo '<h3> CONNECTION SUCCESFUL </h3>';
//}
?>

<body>
<?php
//$link = require('mysqli_connect.php'); //connect to the database.

//The script performs an INSERT query that adds a record to the users table.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); // Initialize an error array.
	$errors2 = array(); // Initialize an error array.

  	//was the name of the class entered?
	if (empty($_POST['Class_Name']))
	{
		$errors[] = 'You Did Not Enter the Name of the Class.';
	}
	else
	{
		$errors2[] = 'Name Entered';
		$cn = mysqli_real_escape_string($dbcon, trim($_POST['Class_Name']));
	}

  	//was the date entered?
	if (empty($_POST['year'])||empty($_POST['month'])||empty($_POST['day']))
	{
		$errors[] = 'You Did Not Enter Or Complete The Date.';
	}
	else
	{
    		$m = $_POST['month'];
    		$d = $_POST['day'];
    		$y = $_POST['year'];
   
    		$m .= "-";
    		$m .= $d;
    		$m .= "-";
    		$m .= $y;

		$dt = new DateTime($m);
		$errors2[] = 'Date Entered';
		$dt = mysqli_real_escape_string($dbcon, trim(dt));
	}
  
	// was the time entered?
	if (empty($_POST['hour']))
	{
		$errors[] = 'You Did Not Enter the Time.';
	}
	else
	{
    		$hr = $_POST['hour'];
    		$ms = $_POST['minute'];

     		$tm .= $hr;
    		$tm .= ":";
    		$tm .= $ms;
		$ttm = mysqli_real_escape_string($dbcon, trim(tm));
		$errors2[] = 'Time Entered';
	}

  	//was the location entered?
	if (empty($_POST['Class_Location']))
	{
		$errors[] = 'You Did Not Enter the Location of the Class.';
	}
	else
	{
		$errors2[] = 'Class Location Entered';
		$loc = mysqli_real_escape_string($dbcon, trim($_POST['Class_Location']));
	}

  	//Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
  	if( empty($errors)) 
	{ //If no problems encountered //make the query
    		//Retrieve the class_id
		$q  = "SELECT * FROM Classes WHERE Class_Name 	  ='$cn'"; 	//combination 
		$q1 = "SELECT * FROM Classes WHERE Class_Date 	  ='$dt'"; 	//combination 
		$q2 = "SELECT * FROM Classes WHERE Class_Time 	  ='$tm'"; 	//combination 
		$q3 = "SELECT * FROM Classes WHERE Class_Location ='$loc'"; 	//combination 
		
		//Run the query and assign it to the variable result
		$rs  = @mysqli_query($dbcon, $q);
		$rs1 = @mysqli_query($dbcon, $q1);
		$rs2 = @mysqli_query($dbcon, $q2);
		$rs3 = @mysqli_query($dbcon, $q3);

		//if(mysqli_num_rows($rs) > 0)
		//{
    		//	$errors2[] = 'Class Already Exists <br> Please Try Another';
		//	exit();
		//}
		//else
    		//	$errors2[] = 'Class Does Not Exists'; 

		//if($rs == True){
		//	$errors2[] = 'Query Worked';
		//}else{
		//	$errors2[] = 'Query Did not Work';
		//}
    		$data = mysqli_fetch_array($rs, MYSQLI_NUM);

    		if( mysqli_num_rows($rs) > 0 && mysqli_num_rows($rs1) > 0 && mysqli_num_rows($rs2) > 0 && mysqli_num_rows($rs3) > 0)
		{  
        		echo '<h3> <br> Error! </h3>
	      		<p class="error"> Class Was Already Added';
    	  		echo '</p><h3>Please Try Another Class Name</h3>';
    		}
    		else
		{
        		$errors2[] = 'Testing!';
      			$assign = $cn;
      			$q = "INSERT INTO Classes (Class_Name, Class_Date, Class_Time, Class_Location)
	    		VALUES('$cn', '$date', '$tm', '$loc')";

      			$result = @mysqli_query($dbcon, $q); //Run the query.
	    		if($result == True) //If it ran ok.
			{	
				$errors2[] = 'Testing2!';
				$errors2[] = 'Insert Query Worked';
				echo '<h3> Class was added Succesfully </h3>';
		    		exit();
		    		//end of SUCCESSFUL SECTION
	    		}
	    		else
			{ // if the form handler or database table contained errors

		    		//display an error message
		    		echo '<h2> System Error </h2>
		    		<p class="error"> Sorry, Your Registration Was not Possible Due To A System Error.
				<br>  Please Try Again Later.</p>';

		    		//Debug the message:
		    		echo '<p>' . mysqli_error($dbcon). '<br><br>Query: ' . $q . '</p>';

	    		}//End of if clause($result).

	   		 mysqli_close($dbcon); //Close the database connection.
	    		// Include the footer and wuit the script:
	    		exit();
    		}    
  	}
	else
	{ //Display the errors
	  	echo '<h2> Error! </h2>
	  	<p class="error"> The following error(s) occurred:<br>';

	  	foreach ($errors as $msg) 
		{ //Print each error.
			echo " - $msg<br>\n";
	  	}
	  	echo '</p><h3>Please Try Again.</h3>';

	} //End of if (empty($errors))IF.

}//End of the main Submit Conditional
?>

<?php get_sidebar(); ?>
<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>

</body>
</html>


