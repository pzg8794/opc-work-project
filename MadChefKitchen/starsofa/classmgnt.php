<?php
/**
Template Name: classmgnt
 */

?>

<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>
</head>
  
<body>

<h2> Class Registration </h2>
<!--display the form on the screen -->

	<form method="post" action="<?php echo $PHP_SELF;?>">
		<div id="content1">     
      			<div class="tab-content1">
          			<div class="top-row">
            				<div class="field-wrap">
              					<label>
                					Name: <span class="req">*</span>
              					</label>
              					<input type="name" required autocomplete="on" align="right" name="Stname" size="30" maxlength="30" 
    						value="<?php if (isset($_POST['Stname'])) echo $_POST['Stname'];?>"/>
           				</div>
          					
					<div class="field-wrap">
             					<label>
                					Email: <span class="req">*</span>
              					</label>	
             					<input type="Stemail" required autocomplete="on" align="right" name="Stemail" size="30" maxlength="30" 
    						value="<?php if (isset($_POST['Stemail'])) echo $_POST['Stemail'];?>"/>
           				</div>
				</div>
            
          			<div class="field-wrap">
            				<label>
              					Phone Number: <span class="req">*</span>
            				</label>
          				<input type="text"required autocomplete="on" name="Stnumber" size="30" maxlength="30" 
    					value="<?php if (isset($_POST['Stnumber'])) echo $_POST['Stnumber'];?>"/>
          			</div>
          
            			<div class="field-wrap">
              				<label>
                				Class Type: <span class="req"></span>
              				</label>
              				<input type="text" align="right" name="Stname" size="30" maxlength="30";"/>
           			</div>

				<div class="field-wrap">
              				<label>
                				Class Date: <span class="req"></span>
              				</label>
              				<input type="text" align="right" name="Stname" size="30" maxlength="30";"/>
           			</div>

				<div class="field-wrap">
              				<label>
                				Class Time: <span class="req"></span>
              				</label>
              				<input type="text" align="right" name="Stname" size="30" maxlength="30";"/>
           			</div>

				<label>
					<p><input id="submit" type="submit" name="submit" value="REGISTER"></p> 
				</label>
      			</div> <!-- tab-content -->
		</div> <!-- /form --> <!-- End of the page content. --> 
	</form> 

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
		//$link = require('mysqli_connect.php'); //connect to the database
		//The script performs an INSERT query that adds a record to the users table.
		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			$errors  = array(); // Initialize an error array.
			$errors2 = array(); // Initialize an error array.

		  	//was the name of the class entered?
			if (empty($_POST['Stname']))
			{
				$errors[] = 'You Did Not Enter Your Name';
			}
			else
			{
				$errors2[] = 'Name Entered';
				//echo '<h3> Name Entered </h3>';
				$Stname 	   = mysqli_real_escape_string($dbcon, trim($_POST['Stname']));
			}

		  	//was the date entered?
			if (empty($_POST['Stemail']))
			{
				$errors[] = 'You Did Not Enter Your Email';
			}
			else
			{
				$errors2[] = 'Email Entered';
				//echo '<h3> Email Entered </h3>';
				$Stemail   = mysqli_real_escape_string($dbcon, trim($_POST['Stemail']));
			}
  
			// was the time entered?
			if (empty($_POST['Stnumber']))
			{
				$errors[] = 'You Did Not Enter Your Number';
			}
			else
			{
				$errors2[] = 'Number Entered';
				//echo '<h3> Number Entered </h3>';
				$Stnumber  = mysqli_real_escape_string($dbcon, trim($_POST['Stnumber']));
			}

		  	//was the class entered?
			if (empty($_POST['classtype']))
			{
				$errors[] = 'You Did Not Enter A Class';
			}	
			else
			{
				$errors2[] = 'Class Entered';
				//echo '<h3> Class Entered </h3>';
				$classtype = mysqli_real_escape_string($dbcon, trim($_POST['classtype']));
			}

  			//was the date entered?
			if (empty($_POST['cyear'])||empty($_POST['cmonth'])||empty($_POST['cday']))
			{
				$errors[] = 'You Did Not Enter Or Complete The Date.';
			}
			else
			{
    				$m = $_POST['cmonth']; 	$d = $_POST['cday'];	$y = $_POST['cyear'];
   				$m .= "-"; 		$m .= $d; 		$m .= "-"; $m .= $y;
			}
  
			// was the time entered?
			if (empty($_POST['chour']))
			{
				$errors[] = 'You Did Not Enter the Time.';
			}
			else
			{
    				$hr = $_POST['chour'];	$ms = $_POST['cminute'];
		     		$tm .= $hr;	$tm .= ":";	$tm .= $ms;
				$ttm = mysqli_real_escape_string($dbcon, trim(tm));
				$errors2[] = 'Time Entered';
			}
	
			//Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
  			if( empty($errors)) 
			{ //If no problems encountered //make the query
    				//Retrieve the class_id
				$q  = "SELECT * FROM StudentsIn WHERE Email='$email'";
		
				//Run the query and assign it to the variable result
				$rs   = @mysqli_query($dbcon, $q);
    				$data = mysqli_fetch_array($rs, MYSQLI_NUM);
    		
				if( mysqli_num_rows($rs) > 0)
				{  
        				echo '<h3> <br> Error! </h3>
	      				<p class="error"> Class Was Already Added';
    	  				echo '</p><h3>Please Try Another Class Name</h3>';
    				}
    				else
				{
					//var currentTime = new Date();
					//var month 	  = currentTime.getMonth() + 1;
					//var day 	  = currentTime.getDate();
					//var year 	  = currentTime.getFullYear(); 

					//set the default timezone to use. Available since PHP 5.1
					date_default_timezone_set('America/Los_Angeles');

					//$cdate = date("m");	//$cdate.= "-";	//$cdate = date("d");
					//$cdate.= "-";		//$cdate = date("y");
					$cdate = date("m-d-y");

					$ctime = date("H:i:s"); $errors2[] = 'Testing!';
					//echo '<h3> Testing1 </h3>';

					$q  = "SELECT * FROM StudentsIn";
					$rs   = @mysqli_query($dbcon, $q);	//Run the query and assign it to the variable result
					$total_users = mysqli_num_rows($rs);	//echo " $total_users users ";
					if( $total_users == 0)
					{
						$q = "TRUNCATE TABLE StudentsIn";
						$result = @mysqli_query($dbcon, $q); 
					}

					$q  = "SELECT * FROM StudentsIn WHERE ClassName= '$classtype' AND ClassDate='$m' AND ClassTime='$tm'";
					$rs   = @mysqli_query($dbcon, $q);	//Run the query and assign it to the variable result
					$num_users = mysqli_num_rows($rs);	//echo " $num_users users ";

					if( $num_users >= 10)
					{
      						$q = "INSERT INTO StudentsOut (StName, StEmail, StNumber, ClassName, ClassDate, ClassTime, RegDate, RegTime, ClassLoc)
	    					VALUES('$Stname', '$Stemail', '$Stnumber', '$classtype', '$m', '$tm', '$cdate', '$ctime', '')";
							
						$message = "Welcome to the MadChefKitchen Family!\r\n";	$message.= "\r\n";
						$message.= "Unfortunately the $classtype class is currently full    \r\n"; 
						$message.= "Date: $m\r\n"; $message.= "Time: $tm\r\n";	$message.= "\r\n";
						$message.= "We will contact you once we have any vacancy available. \r\n"; 
						$message.= "Thanks for your interest.\r\n";	        $message.= "\r\n";
						$message.= "Sincerely,\r\n";  $message.= "The MadChefKitchen Family.\r\n";

						$subject = "Confirmation for the $classtype Class Waiting List";
					}
					else if( $num_users < 10)
					{	
      						$q = "INSERT INTO StudentsIn (StName, StEmail, StNumber, ClassName, ClassDate, ClassTime, RegDate, RegTime, ClassLoc)
	    					VALUES('$Stname', '$Stemail', '$Stnumber', '$classtype', '$m', '$tm', '$cdate', '$ctime', '')";

						$message = "Welcome to the MadChefKitchen Family! \r\n"; $message.= "\r\n";
						$message.= "You have registered for the $classtype class	     \r\n"; 
						$message.= "Date: $m\r\n"; 			$message.= "Time: $tm\r\n";
						$message.= "One of our MadChefs will contact you with all the details and arrange for payment.\r\n";
						$message.= "We look forward to sharing our kitchen with you.\r\n";

						$subject = "Registration Confirmation for the $classtype Class";
					}
  		    			$result = @mysqli_query($dbcon, $q); //Run the query.

	 		   		if($result == True) //If it ran ok.
					{	
						$errors2[] = 'Testing2!';
						$errors2[] = 'Insert Query Worked';
						echo "<label> Registration Was Succesfull! </label> <br>";

						function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
   						{ 
    							$exploded  = explode('@', $to);
        						$exploded2 = explode('.', $exploded[1]);

						        switch (strtolower($exploded2[0]))
        						{
            							case 'hotmail'	 : $headers = "From: Dave Matthews<dave-noreply@hotmail.com>		\r\n"; 	  break;
            							case 'outlook'	 : $headers = "From: Dave Matthews<dave-noreply@outlook.com>		\r\n"; 	  break;
            							case 'live'	 : $headers = "From: Dave Matthews<dave-noreply@live.com>		\r\n"; 	  break;
            							case 'gmail'	 : $headers = "From: Dave Matthews<dave-noreply@gmail.com>		\r\n"; 	  break;
            							case 'googlemail': $headers = "From: Dave Matthews<dave-noreply@googlemail.com>		\r\n"; 	  break;
            							case 'yahoo'	 : $headers = "From: Dave Matthews<dave-noreply@yahoo.com>		\r\n"; 	  break;
            							case 'ymail'	 : $headers = "From: Dave Matthews<dave-noreply@ymail.com>		\r\n"; 	  break;
            							case 'rocketmail': $headers = "From: Dave Matthews<dave-noreply@rocketmail.com>		\r\n"; 	  break;
            							case 'aol'	 : $headers = "From: Dave Matthews<dave-noreply@aol.com>		\r\n"; 	  break;
            							case 'talktalk'	 : $headers = "From: Dave Matthews<dave-noreply@talktalk.com>		\r\n"; 	  break;
            							default		 : $headers = "From: Dave Matthews<dave-noreply@madchefkitchen.com>	\r\n"; 	  break;
        						}

							$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
	      						$subject   = "=?UTF-8?B?".base64_encode($subject)."?=";

      							//$headers = "From: $from_user <$from_email>\r\n"; 
							$headers.= "Reply-To: Dave Matthews <dave@madchefkitchen.com>\r\n";
							$headers.= "Return-Path: $from_email\r\n";
							$headers.= "CC : piter@madchefkitchen.com\r\n";
							$headers.= "BCC: piter@madchefkitchen.com\r\n";
  
							$headers .= "Organization: MadChefKitchen\r\n";
  							$headers .= "MIME-Version: 1.0\r\n";
  							$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  							$headers .= "X-Priority: 3\r\n";
  							$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
      					
     							return mail($to, $subject, $message, $headers); 
	   					}

						if(mail_utf8($Stemail,'Dave Matthews', 'dave@madchefkitchen.com', $subject, $message))
						{// Call Jenny
							
						}else
						{
							echo "There Was Something Wrong Wit Your Email <br>
							Please Resubmit Your Form";
						}

						if( $num_users >= 10)
						{
							echo "Welcome To The MadChefKitchen Family!<br>
							Unfortunately, there is no vacancy for the CLASS and DATE You Have Chosen. <br>
							However, you will added on waiting list and notified when there is a vacancy. <br>";

							$subject = "A New User Has Been Added To The $classtype Class Waiting List";
							$message = "The new user named $Stname has been added to the $classtype class\r\n";
							$message.= "Date: $m \r\n"; $message.= "Time: $tm \r\n";
							mail_utf8('dave@madchefkitchen.com','Dave Matthews', 'dave@madchefkitchen.com', $subject, $message);
						}
						else if( $num_users < 10)
						{
							echo "Welcome To The MadChefKitchen Family!<br>
							A Confirmation Email Has Been Sent";

							$subject = "A New User Registered For The $classtype Class";
							$message = "The new user named $Stname has registered for the $classtype class\r\n";
							$message.= "Date: $m \r\n"; $message.= "Time: $tm \r\n";
							mail_utf8('dave@madchefkitchen.com','Dave Matthews', 'dave@madchefkitchen.com', $subject, $message);
						}
 		    				//exit();
		    				//end of SUCCESSFUL SECTION
	    				}
	    				else
					{ 	// if the form handler or database table contained errors
		    				//display an error message
						echo '<label> Registration was not Successful </label>';

		    				//echo '<h2> System Error </h2>
		    				//<p class="error"> Sorry, Your Registration Was not Possible Due To A System Error.
						//<br>Please Try Again Later.</p>';

			    			//Debug the message:
			    			//echo '<p>' . mysqli_error($dbcon). '<br><br>Query: ' . $q . '</p>';

		    			}//End of if clause($result).   		 
					mysqli_close($dbcon); //Close the database connection.
	    				// Include the footer and wuit the script:
	    				//exit();
	    			}    
  			}
			else
			{ //Display the errors
	  			//echo '<h2> Error! </h2>
	  			//<p class="error"> The following error(s) occurred:<br>';

			  	//foreach ($errors as $msg) 
				//{ //Print each error.
					//echo " - $msg<br>\n";
	  			//}
	  			//echo '</p><h3>Please Try Again.</h3>';
			} //End of if (empty($errors))IF.
		}//End of the main Submit Conditional
	?>

</body>
</html>


