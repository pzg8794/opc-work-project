<?php

/**

 */
	get_header(); 
?>

<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>
	<style type ="text/css">

		label
		{
			position	: relative;
			font-family	: "FontAwesome";
  			font-size	: 20px;
			font-weight	: bold;
  			color		: black;
			margin-left	: 0px;
  			text-align	: left;			
		}
		form
	 	{
			
			label{
				color: black;
				text-align: right;
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
  			font-size: 35px;
			font-weight: bold;
  			color: black;
  			text-align: right;
			margin-top: -35px;
    			text-shadow: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		}
	</style>
</head>


<body>

<h2> Adding a Class </h2>
<h3> Message </h3>
<!--display the form on the screen -->

	<form method="post" action="<?php echo $PHP_SELF;?>">
	<p>
    		<label> <div id="label" for="Class_Name"> <label> Class Name: </label> </div> </label>
    		<div id="label"> <input id="lebel1" type="text" name="Class_Name" size="60" maxlength="60" 
    			value="<?php if (isset($_POST['Class_Name'])) echo $_POST['Class_Name']; ?>">
		</div>
	
	</p>

	<p>
		<div id="label" for="start"> <label> Class Date: </label> </div>
		<div id="label1">
			<?php
				$date =date('Y-m-d');
				$month =date("M",strtotime($date))."(".date("m",strtotime($date)).")";

				// current year
   				$now = date('Y');

	    			// build years menu
				echo '<select name="cyear">' . PHP_EOL;	
				$y=$now;
    				for ($counter =0; $counter<=1; $counter++) {
        				echo '  <option value="' . $y . '">' . $y . '</option>' . PHP_EOL;
        				$y++;
	    			}
    				echo '</select>' . PHP_EOL;

	    			// build months menu
    				echo '<select name="cmonth">' . PHP_EOL;
    				for ($m=date('m', strtotime('-0 month')); $m<=12; $m++) {
        				echo '  <option value="' . $m . '">' . date('M', mktime(0,0,0,$m,1)) . '</option>' . PHP_EOL;
    				}
    				echo '</select>' . PHP_EOL;

				$t=date('d-m-Y');
				//$dayName = strtolower(date("D",strtotime($t)));
				$dayNum = strtolower(date("d",strtotime($t)));
	   			// build days menu
    				echo '<select name="cday">' . PHP_EOL;
    				for ($d=1; $d<=31; $d++) {
       					echo '<option value="' . $d . '">' . $d . '</option>' . PHP_EOL;
   				}
    				echo '</select>' . PHP_EOL; 
			?>
		</div>	
	</p>

	<p>
  		<div id="label" for="Class_sTime"> <label> Class Start Time: </label> </div>
		<div id="label1">
			Hour:
			<select name="shour">
				<?php foreach (range(0,24) as $shour):?>
					<option value="<?php echo $shour;?>"><?php echo $shour;?></option>
				<?php endforeach?>
			</select>

			Minute(s):
			<select name="sminute">
				<?php foreach (range(0,59) as $sminute):?>
					<option value="<?php echo $sminute;?>"><?php echo $sminute;?></option>
				<?php endforeach?>
			</select>

	  		<!-- <input id="Class_sTime" type="text" name="Class_sTime" size="30" maxlength="40"
  			value=""<?php if (isset($_POST['Class_sTime'])) echo $_POST['Class_sTime']; ?>"> -->
		</div>		
	</p>

	<p>
  		<div id="label" for="Class_eTime"> <label> Class End Time: </label> </div>
		<div id="label1">
			Hour:
			<select name="ehour">
				<?php foreach (range(0,24) as $ehour):?>
					<option value="<?php echo $ehour;?>"><?php echo $ehour;?></option>
				<?php endforeach?>
			</select>

			Minute(s):
			<select name="eminute">
				<?php foreach (range(0,59) as $eminute):?>
					<option value="<?php echo $eminute;?>"><?php echo $eminute;?></option>
				<?php endforeach?>
			</select>

	  		<!-- <input id="Class_eTime" type="text" name="Class_eTime" size="30" maxlength="40"
  			value=""<?php if (isset($_POST['Class_eTime'])) echo $_POST['Class_eTime']; ?>"> -->
		</div>		
	</p>

	<p>
    		<div id="label" for="Class_Location"> <label> Class Location: </label> </div>
    		<div id="label"> <input id="lebel1" type="text" name="Class_Location" size="30" maxlength="30" 
    			value="<?php if (isset($_POST['Class_Location'])) echo $_POST['Class_Location']; ?>">
		</div>
	</p>

	<p>
  		<div id="label" for="comments"> <label> Comments: </label> </div>
 		<textarea name='comments' id='comments'></textarea><br />
  		<input type='hidden' name='articleid' id='articleid' 
  		value=""<?php if (isset($_POST['comments'])) echo $_POST['comments']; ?>">
	</p>

	<p><input id="submit" type="submit" name="submit" value="ADD CLASS"></p>
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

	<?php
	//$link = require('mysqli_connect.php'); //connect to the database.

	//The script performs an INSERT query that adds a record to the users table.
	if($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
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
		if (empty($_POST['cyear'])||empty($_POST['cmonth'])||empty($_POST['cday']))
		{
			$errors[] = 'You Did Not Enter Or Complete The Date.';
		}
		else
		{
    			$m = $_POST['cmonth'];
    			$d = $_POST['cday'];
    			$y = $_POST['cyear'];
   		    		
			$m .= "-";
    			$m .= $d;
    			$m .= "-";
    			$m .= $y;
		}

		// was the time entered?
		if (empty($_POST['shour']))
		{
			$errors[] = 'You Did Not Enter the Time.';
		}
		else
		{
    			$hr = $_POST['shour'];
    			$ms = $_POST['sminute'];

	     		$tm .= $hr;
    			$tm .= ":";
    			$tm .= $ms;
			$ttm = mysqli_real_escape_string($dbcon, trim(tm));
			$errors2[] = 'Time Entered';
		}


		// was the time entered?
		if (empty($_POST['ehour']))
		{
			$errors[] = 'You Did Not Enter the Time.';
		}
		else
		{
    			$ehr = $_POST['ehour'];
    			$ems = $_POST['eminute'];

	     		$etm .= $ehr;
    			$etm .= ":";
    			$etm .= $ems;
			$ettm = mysqli_real_escape_string($dbcon, trim(etm));
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

		if (!empty($_POST['comments'])){
			$com = mysqli_real_escape_string($dbcon, trim($_POST['comments']));
      
  		}else{
	  		$com = " ";
 		}

	  	//Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
  		if( empty($errors)) 
		{ 	//If no problems encountered //make the query

			$q  = "SELECT * FROM Classes";
			$rs   = @mysqli_query($dbcon, $q);	//Run the query and assign it to the variable result
			$total_users = mysqli_num_rows($rs);	//echo " $total_users users ";
			if( $total_users == 0)
			{
				//$q = "TRUNCATE TABLE Classes";
				//$result = @mysqli_query($dbcon, $q); 
			}

    			//Retrieve the class_id
			$q  = "SELECT * FROM Classes WHERE Class_Name ='$cn' AND Class_Date ='$m' AND Class_sTime ='$tm' AND Class_eTime ='$etm' AND Class_Location ='$loc'";
		
			//Run the query and assign it to the variable result
			$rs  = @mysqli_query($dbcon, $q);

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
    			//$data = mysqli_fetch_array($rs, MYSQLI_NUM);

    			if( mysqli_num_rows($rs) > 0)
			{  
        			echo '<h3> Class Was Already Added </h3><br>';
    	  			echo '<h3>Please Try Another Class Name</h3>';
    			}
    			else
			{
        			$errors2[] = 'Testing!';
      				$q = "INSERT INTO Classes (Class_Name, Class_Date, Class_sTime, Class_eTime, Class_Location, Comments)
		    		VALUES('$cn', '$m', '$tm','$etm', '$loc', '$com')";

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
</body>
</html>