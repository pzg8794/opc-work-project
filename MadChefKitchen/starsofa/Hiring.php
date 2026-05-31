<?php
/**

Template Name: HiringForm
 */
	get_header(); 
?>

<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>

	<!-- CSS CODE FOR THE STRUCTURE OF THE FORM AND CALENDAR OF EVENTS -->
	<style type ="text/css">

		/* CSS CODE FOR EVERY FIELD IN THE FORM SUCH AS NAME ETC */
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


		/* CSS CODE TO DISPLAY ERRORS IN READ*/	
		p.error
		{
			position	: relative;
			font-family	: "FontAwesome";
  			font-size	: 15px;
			font-weight	: bold;
  			color		: red;
			margin-left	: 0px;
  			text-align	: left;	

		}

		/* TITLE FOR THE HIRING FORM AND CALENDAR OF EVENTS*/
		h2{
			font-family: "Times New Roman", Times, red serif;
  			font-size: 38px;
			font-weight: bold;
  			color: black;
  			text-align:center;
			margin-top: -5px;
    			text-shadow: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		}
		
		/* EMPHASIZING THE SUBMIT BUTTON */
		#submit{
			font-family: "Times New Roman", Times, red serif;
			position: relative;
  			font-size: 25px;
			font-weight: bold;
  			color: black;
  			text-align: center;
    			text-shadow: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		}


		/* EMPHASIZING THE BORDER OF THE FORM */
		#form{
			float:left; 
			background-color: #00FFFF;
			border-top: 3px dotted #FF00CC;
			border-bottom: 3px dotted #FF00CC;
			width:460px;
			border-left: 3px dotted #FF00CC;

			border-right: 3px dotted #FF00CC;
			margin-bottom: 1px;
			border-radius: 10px;
		}


	</style>

	<?php //CONNECTING TO DATABASE
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

	?>
</head>


<body>
	<!--  LEFT SIDE OF PAGE CONTAINING THE HIRING FORM FOR USER TO HIRE A CHEF -->
	<div id="form"> 
		<h2> Hiring A Chef </h2>

		<!--  HIRING FORM -->
		<form method="post" action="<?php echo $PHP_SELF;?>">
			
			<table width="450px">
			
				<tr> 	<!--  FIELD FOR THE USER TO ENTER A NAME -->
					<td valign="top"> 
  						<label for="uName"> Name: *</label>
 					</td>

 					<td valign="top">
  						<input  type="text" required autocomplete="on" name="uName" maxlength="50" size="30">
 					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER AN EMAIL ADDRESS -->
 					<td valign="top">
  						<label for="uEmail">Email Address: *</label>
 					</td>
 
		 			<td valign="top">
  						<input  type="text" required autocomplete="on" name="uEmail" maxlength="80" size="30">
 					</td>
 				</tr>
				
				<tr>	<!--  FIELD FOR THE USER TO ENTER A NUMBER -->
 					<td valign="top">
  						<label for="uNumber">Telephone Number:</label>
 					</td>
 			
					<td valign="top">
  						<input  type="text" required autocomplete="on" name="uNumber" maxlength="30" size="30">
 					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER AN ADDRESS -->
 					<td valign="top">	
  						<label for="uAddress1">Address 1:</label>
 					</td>

					<td valign="top">
  						<input  type="text" required autocomplete="on" name="uAddress1" maxlength="30" size="30">
 					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER APARTMENT/HOUSE NUMBER -->
 					<td valign="top">
  						<label for="uAddress2">Address 2:</label>
 					</td>
 			
					<td valign="top">
  						<input  type="text" required autocomplete="on" name="uAddress2" maxlength="30" size="30">
 					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE CITY -->
 					<td valign="top">
  						<label for="uCity">City:</label>
 					</td>
 			
					<td valign="top">
  						<input id="uCity" required autocomplete="on" type="text" name="uCity" maxlength="25" /><br />
					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE ZIP CODE -->
 					<td valign="top">
						<label for="uZip">Zip Code:</label>
 					</td>
 			
					<td valign="top">		
						<input id="uZip" required autocomplete="on" type="text" name="uZip" maxlength="5" /><br />	
					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE NUMBER OF PEOPLE ATTENDING THE EVENT -->
 					<td valign="top">
  						<label for="uNoP">No. of People:</label>
 					</td>
 			
					<td valign="top">
  						<input id="uNoP" required autocomplete="on" type="text" name="uNoP" size="10" maxlength="10"/><br />
					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE DATE OF THE EVENT-->
		 			<td valign="top">
  						<label for="eDate">Date of Event:</label>
 					</td>
 			
					<td valign="top">
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
					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE TIME THE EVENT STARTS -->
 					<td valign="top">
  						<label for="sTime">Start Time: </label>
 					</td>
 			
					<td valign="top">
						Hour:
						<select name="shour">
							<?php foreach (range(0,24) as $ehour):?>
								<option value="<?php echo $ehour;?>"><?php echo $ehour;?></option>
							<?php endforeach?>
						</select>

						Minute(s):
						<select name="sminute">
							<?php foreach (range(0,59) as $eminute):?>
								<option value="<?php echo $eminute;?>"><?php echo $eminute;?></option>
							<?php endforeach?>
						</select>
 					</td>
				</tr>


				<tr>	<!--  FIELD FOR THE USER TO ENTER THE TIME THE EVENT ENDS -->
 					<td valign="top">
  						<label for="eTime">End Time: </label>
 					</td>
 			
					<td valign="top">
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
 					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE TYPE OF MEAL FOR THE EVENT -->
 					<td valign="top">
  						<label for="mealtype">Meal Type: </label>
 					</td>
 			
					<td valign="top">
						<input type="radio" name="mealtype"
							<?php 
								if (isset($mealtype) && $mealtype=="buffet") 
									echo "checked";
							?>
							value="buffet">Buffet
						<input type="radio" name="mealtype"
							<?php 	
								if (isset($mealtype) && $mealtype=="plated") 
									echo "checked";
							?>
							value="plated">Plated Meal
 					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER THE SERVICE NEEDED IN THE EVENT -->
 					<td valign="top">
  						<label for="need">Service: </label>
 					</td>
 			
					<td valign="top">
						<input type="checkbox" name="need"
							<?php if (isset($need) && $need=="sommeller") echo "checked";?>
								value="sommeller">Sommeller
						<input type="checkbox" name="need"
							<?php if (isset($need) && $need=="bartender") echo "checked";?>
								value="bartender">Bartender
						<input type="checkbox" name="need"
							<?php if (isset($need) && $need=="none") echo "checked";?>
								value="none">None
 					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER ANY DIETARY RESTRICTIONS -->
 					<td valign="top">
  						<label for="dRes">Dietary Restrictions:</label>
 					</td>
 				
					<td valign="top">
 						<textarea name="dRes" id="dRes"></textarea><br />
  						<input type="hidden" name='articleid' id='articleid' 
  							value="<?php if (isset($_POST['dRes'])) echo $_POST['dRes']; ?>"/><br />
					</td>
				</tr>

				<tr>	<!--  FIELD FOR THE USER TO ENTER ANY REQUIREMENT-->
 					<td valign="top">
  						<label for="sReq">Special Requirements:</label>
 					</td>
 			
					<td valign="top">
 						<textarea name="sReq" id="sReq"></textarea><br />
  						<input type="hidden" name='articleid' id='articleid' 
  							value="<?php if (isset($_POST['sReq'])) echo $_POST['sReq']; ?>"/><br />
					</td>
				</tr>

				<!--  TABLE EXPLAINING THE TERMS AND CONDITIONS STATED BY MADCHEFKITCHEN TO EVERY CLIENT -->
				<table width="450" height="202" border="1">
					<tr>	<!--  FIELD EXPLAINING TERMS OF THE AGREEMENT TO THE USER-->
    						<td height="152" colspan="2" valign="top">
							<p minmax_bound="true">
								The following is the terms of the agreement between MadChefKitchen and the buyer of goods/services through this site. 
								If you do not agree to these terms, you will not be able to purchase anything, so please review these terms carefully. 
							</p>
	    						<p minmax_bound="true">
								By accepting the Terms you are entering into a contract. 
							</p>
						</td>
  					</tr>
  
  					<tr>	<!--  FIELD FOR THE USER TO ACCEPT TERMS AND SUBMIT FORM-->
    						<td width="174" height="42">  
      							<label> Accept the terms </label>
          						<br />
							<input type="checkbox" name="checkbox"<?php if (isset($agmt) && $agmt=="checkbox") echo "checked";?>
							value="checkbox">            
						</td>
    
						<td width="227" align="center">
							<input id="submit" type="submit" name="submit" value="SUBMIT">
							
 						</td>
 	 				</tr>
				</table>

			</table>
		</form>
	</div>

	<!--  RIGHT SIGHT OF THE PAGE DISPLAYING THE CALENDAR OF EVENTS -->
	<div style="float:right; margin-top:0px; text-align: aligncenter"> 	
		
		<h2> Calendar of Events </h2>
		<?php get_template_part('calendar'); ?>

		<?php
			//$link = require('mysqli_connect.php'); //connect to the database.
			//The script performs an INSERT query that adds a record to the users table.
			if($_SERVER['REQUEST_METHOD'] == 'POST') 
			{
				$errors = array(); // Initialize an error array.
				$errors2 = array(); // Initialize an error array.

			  	//was the name of the class entered?
				if (empty($_POST['uName']))
				{
					$errors[] = 'You Did Not Enter Your Name.';
				}
				else
				{
					$errors2[] = 'Name Entered';
					$first_name = $_POST['uName']; // required
					$string_exp = "/^[A-Za-z .'-]+$/"; 
  					if(!preg_match($string_exp,$first_name)) 
					{
    						$errors[] = 'The First Name you entered does not appear to be valid.';
  					}
					else
					{
						$uN = mysqli_real_escape_string($dbcon, trim($_POST['uName']));
					}		
				}

			  	//was the email entered?
				if (empty($_POST['checkbox']))
				{
					$errors[] = 'Please Accept the Terms and Conditions in Order to Use Our Services.';
				} else{	}	  	

				//was the email entered?
				if (empty($_POST['uEmail']))
				{
					$errors[] = 'You Did Not Enter Your Email.<br/>';
				}
				else
				{
					$errors2[] = 'Email Entered';
		    			$email_from = $_POST['uEmail']; // required
    					$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
 				 	if(!preg_match($email_exp,$email_from)) 
					{
		    				$errors[] = 'The Email Address you entered does not appear to be valid.';
 		 			}
					else
					{
						$uE = mysqli_real_escape_string($dbcon, trim($_POST['uEmail']));
					}
				}

			  	//was the email entered?
				if (empty($_POST['uNumber']))
				{
					$errors[] = 'You Did Not Enter Your Number.';
				}
				else
				{
					$errors2[] = 'Number Entered';
					$uNr = mysqli_real_escape_string($dbcon, trim($_POST['uNumber']));
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
					$errors[] = 'You Did Not Enter the Start Time.';
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
					$errors[] = 'You Did Not Enter the End Time.';
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
				if (empty($_POST['uAddress1']))
				{
					$errors[] = 'You Did Not Enter the Address';
				}
				else
				{
					$errors2[] = 'Address Entered';
					$uA1 = mysqli_real_escape_string($dbcon, trim($_POST['uAddress1']));
				}

		 	 	//was the location entered?
				if (empty($_POST['uAddress2']))
				{
					$errors[] = 'You Did Not Enter the Address';
				}
				else
				{
					$errors2[] = 'Address Entered';
					$uA2 = mysqli_real_escape_string($dbcon, trim($_POST['uAddress2']));
				}


		 	 	//was the location entered?
				if (empty($_POST['uCity']))
				{
					$errors[] = 'You Did Not Enter the City';
				}
				else
				{
					$errors2[] = 'City Entered';
					$uC = mysqli_real_escape_string($dbcon, trim($_POST['uCity']));
				}

			 	//was the location entered?
				if (empty($_POST['uZip']))
				{
					$errors[] = 'You Did Not Enter the Zip Code';
				}
				else
				{
					$errors2[] = 'Zip Code Entered';
					$uZ = mysqli_real_escape_string($dbcon, trim($_POST['uZip']));
				}

			 	//was the location entered?
				if (empty($_POST['uNoP']))
				{
					$errors[] = 'You Did Not Enter the Number of People';
				}
				else
				{
					$errors2[] = 'Number of People Entered';
					$nop = mysqli_real_escape_string($dbcon, trim($_POST['uNoP']));
				}

				if (!empty($_POST['dRes']))
				{
					$errors2[] = 'Address1 entered';
					$dres = mysqli_real_escape_string($dbcon, trim($_POST['dRes']));
  				}
				else
				{
			  		$dres = "NA";
 				}

				if (!empty($_POST['sReq']))
				{
					$errors2[] = 'Address2 entered';
					$sreq = mysqli_real_escape_string($dbcon, trim($_POST['sReq']));
  				}
				else
				{
			  		$sreq = "NA";
 				}

				if (!empty($_POST['mealtype']))
				{
					$errors2[] = 'MealType entered';
					$srad1 = $_POST['mealtype'];
					//if ($srad1 == 'buffet') {}
					//else if ($srad1 == 'plated') {}
		  		}
				else
				{
					$errors[] = 'You Did Not Selected A Meal Type';
		 		}

				if (!empty($_POST['need']))
				{	
					$errors2[] = 'Service entered';
					$srad2 = $_POST['need'];
					//if ($srad2 == 'sommeller') {}
					//else if ($srad2 == 'bartender') {}
					//else if($srad2 == 'none'){}
		  		}
				else { }

			  	//Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
		  		if( empty($errors)) 
				{ 	//If no problems encountered //make the query
					$q  = "SELECT * FROM Clients";
					$rs   = @mysqli_query($dbcon, $q);	//Run the query and assign it to the variable result
					$total_users = mysqli_num_rows($rs);	//echo " $total_users users ";
					if( $total_users == 0)
					{
						$q = "TRUNCATE TABLE Classes";
						$result = @mysqli_query($dbcon, $q); 
					}

		    			//Retrieve the class_id
					$q  = "SELECT * FROM Clients WHERE uName='$uN' AND uEmail='$uE' AND uNumber='$uNr' AND
					uAddress1='$uA1' AND uAddress2='$uA2' AND uCity='$uC' AND uZip='$uZ' AND nop='$nop' 
					AND eDate='$m' AND sTime='$tm' AND eTime='$etm' AND mealtype='$srad1' 
					AND need='$srad2' AND dRes='$dres' AND sReq='$sreq'";

					//Run the query and assign it to the variable result
					$rs  = @mysqli_query($dbcon, $q);

		    			if( mysqli_num_rows($rs) > 0)
					{  
   			     			echo '<h3> Event Was Already Registered </h3><br>';
    					}
    					else
					{
        					$errors2[] = 'Testing!';
     	 					$q = "INSERT INTO Clients (uName, uEmail, uNumber, uAddress1, uAddress2,
						uCity, uZip, nop, eDate, sTime, eTime, mealtype, need, dRes, sReq)
				    		VALUES('$uN', '$uE', '$uNr','$uA1', '$uA2','$uC', '$uZ', '$nop', '$m',
						'$tm', '$etm', '$srad1','$srad2','$dres', '$sreq')";

			      			$result = @mysqli_query($dbcon, $q); //Run the query.
				    		if($result == True) //If it ran ok.
						{	
							$errors2[] = 'Testing2!';
							$errors2[] = 'Insert Query Worked';
							echo '<h3> Event Was Registered Succesfully </h3>';
		    			
		    					//end of SUCCESSFUL SECTION
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


							$message = "Welcome to the MadChefKitchen Family! \r\n"; $message.= "\r\n";
							$message.= "You have hired one of our chef for the following event    \r\n"; 
							$message.= "Date: $m \r\n"; 			$message.= "From $tm to $etm \r\n";
							$message.= "One of our MadChefs will contact you with all the details and arrangements for payment.\r\n";
							$message.= "We look forward to sharing our kitchen with you.\r\n";

							$subject = "Hiring Confirmation";
							if(mail_utf8($uE,'Dave Matthews', 'dave@madchefkitchen.com', $subject, $message))
							{// Call Jenny
							
							}else
							{
								echo "<label> There Was Something Wrong Wit Your Email <br>
								Please Resubmit Your Form </label>";
							}

							echo "Welcome To The MadChefKitchen Family!<br>
							A Confirmation Email Has Been Sent";

							$subject = "A New User Registered For The $classtype Class";
							$message = "The new user named $uN has hired a Chef for an event\r\n";
							$message.= "Date: $m \r\n"; $message.= "From $tm to $etm \r\n";
							mail_utf8('dave@madchefkitchen.com','Dave Matthews', 'dave@madchefkitchen.com', $subject, $message);
	    					}
	    					else
						{ // if the form handler or database table contained errors

				    			//display an error message
				    			echo '<h3> System Error </h3>
		    					<h3 class="error"> Sorry, Your Registration Was not Possible Due To A System Error.
							<br>  Please Try Again Later.</h3>';

					    		//Debug the message:
					    		echo '<h3>' . mysqli_error($dbcon). '<br><br>Query: ' . $q . '</h3>';
	
				    		}//End of if clause($result).
	   		 	
						mysqli_close($dbcon); //Close the database connection.
			    			// Include the footer and wuit the script:
	    					exit();
 		   			}    
		  		}
				else
				{ //Display the errors
			  		echo ' <h2> Error! </h2> 
			  		<label> The following error(s) occurred:</label> <p class="error">';

				  	foreach ($errors as $msg) 
					{ //Print each error.
						echo " - $msg<br>\n";
			  		}
	  				echo '</p> <label> Please Try Again.</label>';
				} //End of if

			}//End of the main Submit Conditional
		?>
	</div> 

</body>
	<?php get_footer(); ?>
</html>