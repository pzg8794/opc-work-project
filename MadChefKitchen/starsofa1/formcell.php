<?php
/**
 */
	// CONNECTING TO THE DATABASE
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
			
			get_template_part('smenu');	
			get_template_part('theloop'); 
?>

<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>
			<style type ="text/css">
			h2
			{
				font-family	: "FontAwesome";
  				font-size	: 17px;
				font-weight	: bold;
  				color		: #990066;
  				text-align	: center;
				margin-left	: -0px;
    				text-shadow	: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
			} 

			errors
			{
				position	: absolute;
				font-family	: "FontAwesome";
  				font-size	: 10px;
				font-weight	: bold;
  				color		: red;
  				text-align	: center;
				margin-left	: -410px;
				margin-top	: 450px;			
			}

			label
			{
				position	: relative;
				font-family	: "FontAwesome";
  				font-size	: 10px;
				font-weight	: bold;
  				color		: black;
				margin-left	: 10px;
  				text-align	: left;			
			}
			
			/* EMPHASIZING THE BORDER OF THE FORM */
			#form
			{
				float:left; 
				background-color: white;
				border-top: 3px dotted #FF00CC;
				border-bottom: 3px dotted #FF00CC;
				width:100%;
				border-left: 3px dotted #FF00CC;

				border-right: 3px dotted #FF00CC;
				margin-bottom: 0px;
				border-radius: 10px;
			}
			
			#contentt 
			{	
		    	float:left;
				margin-left: 0px;
				width:45%;
	
				background: white;
				text-align: right;

				.tab-content
				{
					display:none;
				}
			}

			#sidebart 
			{
				float:right;
				width:50%;
				margin-top:-0px;
				background: white;
				text-align: left;
	
			}
			
			#container2 
			{
				margin-top: -20%;
				position: relative;
				width:100%;	
				background: white;
				
		z-index: -1;
			}
			
			 p
		{
    		font-color:black;
    		font-size:10px;
    		font-weight:bold;
			margin-top: -0px;
			margin-left: 15px;
    		text-align:left;
    	}
    
			div.day-numb		
			{ 	
				background:#5F9EA0; padding:5px; color:white; font-weight:bold; 
				float:left; margin:8px -10px 8px -15px; 
				width:15px; text-align:left;  
			}	
		</style>
</head>
  
<body>
	<div id="container2">
		<?php get_template_part('calendarEvent1'); ?>
				
		<form name="calendar" method="post" id="calendar" action="<?php echo $PHP_SELF;?>">
			<table width="100%">					
				<tr>	<!--  FIELD FOR THE USER TO ENTER THE DATE OF THE EVENT-->
		 			<td valign="top"> 
						<?php
							$y=date('Y');	$m= date('m', strtotime('-0 month')); 
							$monthName = date("F", mktime(null, null, null, $m));
							echo '<h2 align="center" >Cooking Classes for '. $monthName.' '.$y.'</h2>';
							echo draw_calendar($m,$y);
						?>
					</td>
				</tr>
				
				<tr>	
		 			<td align = "center" valign="top"> 
						<label> Select Month and, or, Year to See Upcoming Classes </label> <br/>
						<?php
							date_default_timezone_set('America/Los_Angeles'); 
							$date =date('Y-m-d');
						?>
			
						<select name="cyear" onchange="document.getElementById('calendar').submit()">
							<?php
								$y=date('Y');
								echo '  <option value="' . $y . '">' . 'Year' . '</option>' . PHP_EOL;
								for ($counter =0; $counter<=1; $counter++) {
									echo '  <option value="' . $y . '">' . $y . '</option>' . PHP_EOL;
									$y++;
								}
							?>
						<select>
					
						<select name="cmonth" onchange="document.getElementById('calendar').submit()"> 
							<?php			
								$m=date('m', strtotime('-0 month')); 					
								echo '  <option value="' . $m . '">' . 'Month' . '</option>' . PHP_EOL;
								for ($m=1; $m<=12; $m++) 
								{
									echo '  <option value="' . $m . '">' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
								}
							?>
						<select>
					</td>
				</tr>
				
				<td valign="top"> 
					<?php
						//$link = require('mysqli_connect.php'); //connect to the database
						//The script performs an INSERT query that adds a record to the users table.
						if($_SERVER['REQUEST_METHOD'] == 'POST') 
						{
							$errors  = array(); // Initialize an error array.

							//was the date entered?
							if (empty($_POST['cyear']))
							{
								$y = date('Y');
								$monthName = date("F", mktime(null, null, null, $m));
								echo '<h2 align="center" >Cooking Classes for '. $monthName.' '.$y.'</h2>';
								echo draw_calendar($m,$y);
							}
							else if (empty($_POST['cmonth']))
							{
								$m= date('m', strtotime('-0 month')); 
								$monthName = date("F", mktime(null, null, null, $m));
								echo '<h2 align="center" >Cooking Classes for '. $monthName.' '.$y.'</h2>';
								echo draw_calendar($m,$y);
							}
							else
							{
								$m = $_POST['cmonth']; $y = $_POST['cyear'];
								$monthName = date("F", mktime(null, null, null, $m));
								echo '<h2 align="center" >Cooking Classes for '. $monthName.' '.$y.'</h2>';
								echo draw_calendar($m,$y);
							}
						}//End of the main Submit Conditional
					?>	
				</td>
			</table>
		</form> 
	</div>

	<!-- HTML CODE FOR THE FORM TO REGISTER FOR A CLASS -->
	<div id="form">  
		<h2 align="center"> Register for a Class </h2>
		<form method="post" action="<?php echo $PHP_SELF;?>">
   
			<table width="100%">			
				<tr> 	<!--  FIELD FOR THE USER TO ENTER A NAME -->
					<td valign="top"> 
						<label> Name: <span class="req">*</span> </label>
 					</td>

 					<td valign="top">	
						<input type="name" required autocomplete="on" align="right" name="Stname" size="20" maxlength="30" 
    						value="<?php if (isset($_POST['Stname'])) echo $_POST['Stname'];?>"/>
 					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER AN EMAIL ADDRESS -->
 					<td valign="top">
						<label> Email: <span class="req">*</span> </label>
 					</td>
 
		 			<td valign="top">
  						<input type="Stemail" required autocomplete="on" align="right" name="Stemail" size="20" maxlength="30" 
    						value="<?php if (isset($_POST['Stemail'])) echo $_POST['Stemail'];?>"/>
           				</td>
 				</tr>
				
				<tr>	<!--  FIELD FOR THE USER TO ENTER A NUMBER -->
 					<td valign="top">
						<label> Phone Number: <span class="req">*</span> </label>
 					</td>
 			
					<td valign="top">
  						<input type="text"required autocomplete="on" name="Stnumber" size="20" maxlength="30" 
    						value="<?php if (isset($_POST['Stnumber'])) echo $_POST['Stnumber'];?>"/>
          				</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER AN ADDRESS -->
 					<td valign="top">	
  						<label for="classtype">  </label>
 					</td>

					<td valign="top">
  						<div class="field-wrap">
							<label>
            						<select name="classtype">
                 					<option value=" "> 				Choose a Class			</option>
                 					<option value="SLIDERS and More	"> 		SLIDERS AND MORE		</option>
                  					<option value="CLASSIC MEXICAN FLAVORS">	CLASSIC MEXICAN FLAVORS		</option>
               						<option value="OKTOBERFEST">  			OKTOBERFEST			</option>
               						<option value="PASTA BASICS(SAUCE)">  		PASTA BASICS(SAUCE)		</option>
                 					<option value="PASTA BASICS 101">  		PASTA BASICS 101		</option>
                 					<option value="PASTA BASICS 201">  		PASTA BASICS 201		</option>
                 					<option value="FALL IS IN THE AIR">  		FALL IS IN THE AIR		</option>
                					<option value="HALLOWEEN(TWEENS)">  		HALLOWEEN(TWEENS)		</option>
                 					<option value="HALLOWEEN(ADULTS)">  		HALLOWEEN(ADULTS)		</option>
                  					<option value="IT IS ALL ABOUT THE GOURD">  	IT IS ALL ABOUT THE GOURD	</option>
							</select><br />
							</label>
            					</div>	
					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE DATE OF THE EVENT-->
		 			<td valign="top"> 
						<label> Class Date: </label>
 					</td>
 			
					<td valign="top">
						<?php
						date_default_timezone_set('America/Los_Angeles'); 
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
        							echo '  <option value="' . $m . '">' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
    							}
    						echo '</select>' . PHP_EOL;

						$t=date('d-m-Y'); //$dayName = strtolower(date("D",strtotime($t)));
						$dayNum = strtolower(date("d",strtotime($t)));
	   					
						// build days menu
    						echo '<select name="cday">' . PHP_EOL;
    							for ($d=$dayNum; $d<=31; $d++) {
       								echo '<option value="' . $d . '">' . $d . '</option>' . PHP_EOL;
   							}
    						echo '</select>' . PHP_EOL; 
					?>
					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE TIME THE EVENT STARTS -->
 					<td valign="top">
  						<label for="sTime"> Class Time: </label>
 					</td>
 			
					<td valign="top">
						Hour:
						<select name="chour">
						<?php foreach (range(0,24) as $hour):?>
						<option value="<?php echo $hour;?>"><?php echo $hour;?></option>
						<?php endforeach?>
						</select>

						Minute(s):
						<select name="cminute">
						<?php foreach (range(0,59) as $minute):?>
						<option value="<?php echo $minute;?>"><?php echo $minute;?></option>
						<?php endforeach?>
						</select>
 					</td>
				</tr>


				<tr>	<!--  FIELD FOR THE USER TO  -->
 					<td valign="top">
 					</td>
 			
					<td valign="top">
						<label> <p><input id="submit" type="submit" name="action" value="REGISTER"></p> </label>
 					</td>
				</tr>
			</table>
		</form> 

		<?php
			//$link = require('mysqli_connect.php'); //connect to the database
			//The script performs an INSERT query that adds a record to the users table.
		if(isset($_POST['action']) && $_POST['action'] == 'REGISTER') {
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
							//$q = "TRUNCATE TABLE StudentsIn";
							//$result = @mysqli_query($dbcon, $q); 
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

			    				echo '<h2> System Error </h2>
			    				<p class="error"> Sorry, Your Registration Was not Possible Due To A System Error.
							    <br>Please Try Again Later.</p>';
	
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
	  				echo '<h2> Error! </h2>
		  			<p class="error"> The following error(s) occurred:<br>';
	
				  	foreach ($errors as $msg) 
					{ //Print each error.
						echo " - $msg<br>\n";
		  			}
	  				echo '</p><h3>Please Try Again.</h3>';
				} //End of if (empty($errors))IF.
			}//End of the main Submit Conditional
		}
		?>	
	</div> <!-- /form --> <!-- End of the page content. --> 

		<h2 align="center">Classes Available</h2>
	<div id="sidebar" style="width:100%;">   

		<?php
			// run query
			$query = mysql_query("SELECT * FROM Classes");

			// set array
			$array = array();

			// look through query
			while($row = mysql_fetch_assoc($query)){

				$pieces = explode("-", $row['Class_Date']);
				$mth = $pieces[0]; // piece1
				$dte = sprintf("%02d", $pieces[1]); // piece2
				//echo $dte;
			  	//echo "AND";
				//echo $list_day;
				//echo $dte;
		  		// add each row returned into an array
				if( $mth == $month && $dte == $day)
				{
					$array[] = $row;
		 			// OR just echo the data:
  					//echo $row['Class_Date']; // etc
 					// echo $datef;
					// exit();
				}
			}
			$num = sizeof($array);
		?>

		<div id="contentt"> 
			<?php
				$query 	 = mysql_query("SELECT * FROM Classes");	// run query
				$classes = array(); 					// set array
			
				$cnt = 0;
				while($row = mysql_fetch_assoc($query))			// look through query
				{
  					$classes[] = $row;				// add each row returned into an array
					$cnt++;
				}

				$num  = 0;
				$temp = ($cnt / 2);
				
        			//echo $temp; 
				while($num < $temp)
				{
					$col  = $classes[$num]['ColorId'];
					$name = $classes[$num]['Class_Name'];
					$com  = $classes[$num]['Comments'];

        			echo '<div class="day-numb" style="background-color:'.$col.'"></div> <p> 
					<span style="font-family:; font-size: 10pt; color: black;">
					<a href="#" data-toggle="tooltip" title="'.$com.'">'.$name.'</a></span> </p>';
					$num++;
				}
			?>
		</div>

		<div id="sidebart"> 
		<?php 
			while($num < $cnt)
			{
				$col  = $classes[$num]['ColorId'];
				$name = $classes[$num]['Class_Name'];
				$com  = $classes[$num]['Comments'];
				
        			echo '<div class="day-numb" style="background-color:'.$col.'"></div> 
				<p> <span style="font-family:; font-size: 8pt; color: black;">
				<a href="#" data-toggle="tooltip" title="'.$com.'">'.$name.'</a></span> </p>';
				$num++;
			}

		?>
		</div>
	</div>
		
	</div>

</body>
</html>