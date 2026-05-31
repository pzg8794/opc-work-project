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
?>

<!DOCTYPE html>
<html lang=en>
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8">
		<!-- CSS CODE FOR THE STRUCTURE OF THE  -->
		<style type ="text/css">
		
				/* TITLE FOR THE HIRING FORM AND CALENDAR OF EVENTS*/
		h2{
			font-family: "Times New Roman", Times, red serif;
  			font-size: 28px;
			font-weight: bold;
  			color: black;
  			text-align:center;
			margin-top: -5px;
    			text-shadow: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		}
		lab
		{
			margin-top: -0%;
			position	: relative;
			font-family	: "FontAwesome";
  			font-size	: 20px;
			font-weight	: bold;
  			color		: black;
			margin-left	: 0px;
  			text-align	: left;			
		}
		
		
		/* CSS CODE TO DISPLAY ERRORS IN READ*/	
		.error
		{
			margin-top: -0%;
			position	: relative;
			font-family	: "FontAwesome";
  			font-size	: 14px;
			font-weight	: bold;
  			color		: red;
			margin-left	: 0px;
  			text-align	: left;	
		}

			#contact 
			{
				display: block;
				width: 90%;
				margin: -0px auto;
				margin-left: -.5px;
				padding: 35px;
				border: 1px solid #cbcbcb;
				background-color: #FFF;
				border-radius:5px;
				box-shadow: 0 2px 5px rgba(50, 50, 50, 0.1);
				-webkit-box-shadow: 0 2px 5px rgba(50, 50, 50, 0.1);
				-moz-box-shadow: 0 2px 5px rgba(50, 50, 50, 0.1);
				position: relative;
				
				
			border-top: 3px dotted #FF00CC;
			border-bottom: 3px dotted #FF00CC;
			border-left: 3px dotted #FF00CC;
			border-right: 3px dotted #FF00CC;
			}
		
			#contact h1 
			{
				margin: 10px 0 10px;
				font-size: 24px;
				color: #333333;
			}
		
			#contact p, label, legend 
			{
				font: 1.5em "Lucida Grande", "Lucida Sans Unicode", Arial, sans-serif;
			}
		
			#contact fieldset 
			{
				padding: 20px;
				border: 1px solid #eee;
				margin: 0 0 20px;
			}
		
			#contact legend 
			{
				padding: 7px 10px;
				font-weight: bold;
				color: #000;	
				border: 1px solid #eee;
				margin-bottom: 0px;
			}
		
			#contact label 
			{
				display: inline-block;
				float: left;
				height: 1em;
				line-height: 1em;
				padding: 6px 0 0;
				width: 155px;
				font-size: 1.4em;
				margin: 5px 0;
				clear: both;
			}
		
			#contact input, #contact textarea 
			{
				width: 220px;
				padding: 5px;
				color: #666;
				background: #f5f5f5;
				border: 1px solid #ccc;
				margin: 5px 0;
				outline: none;
				font: 1.4em "Lucida Grande", "Lucida Sans Unicode", Arial, sans-serif;
				border-radius: 5px;
				transition: all 0.25s ease-in-out;
				-webkit-transition: all 0.25s ease-in-out;
				-moz-transition: all 0.25s ease-in-out;
				box-shadow: 0 0 5px rgba(81, 203, 238, 0);
				-webkit-box-shadow: 0 0 5px rgba(81, 203, 238, 0);
				-moz-box-shadow: 0 0 5px rgba(81, 203, 238, 0);
			}

			#contact input:focus, #contact textarea:focus 
			{
				border: 1px solid #ddd;
				background-color: #fff;
				color: #333;
				outline: none;
				position: relative;
				z-index: 5;
				box-shadow: 0 0 5px rgba(81, 203, 238, 1);
				-webkit-box-shadow: 0 0 5px rgba(81, 203, 238, 1);
				-moz-box-shadow: 0 0 5px rgba(81, 203, 238, 1);
				-webkit-transform: scale(1.05);
				-moz-transform: scale(1.05);
				transition: all 0.25s ease-in-out;
				-webkit-transition: all 0.25s ease-in-out;
				-moz-transition: all 0.25s ease-in-out;
			}
		
			#contact input.error, #contact textarea.error, #contact select.error 
			{
				box-shadow: 0 0 5px rgba(204, 0, 0, 0.5);
				-webkit-box-shadow: 0 0 5px rgba(204, 0, 0, 0.5);
				-moz-box-shadow: 0 0 5px rgba(204, 0, 0, 0.5);
				border: 1px solid #faabab;
				background: #fef3f3;
			}
		
			#contact input.submit 
			{
				width: auto;
				cursor: pointer;
				position: relative;
				border: 1px solid #282828;
				color: #fff;
				padding: 6px 16px;
				text-decoration: none;
				font-size: 1.5em;
				background: #555;
				background: -webkit-gradient( linear, left bottom, left top, color-stop(0.12, rgb(60,60,60)), color-stop(1, rgb(85,85,85)) );
				background: -moz-linear-gradient( center bottom, rgb(60,60,60) 12%, rgb(85,85,85) 100% );
				box-shadow: 0 2px 3px rgba(0,0,0,0.25);
				-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.25);
				-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.25);
				text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
			}
		
			#contact input.submit:hover 
			{
				background: #282828 !important;
				transition: none;
				-webkit-transition: none;
				-moz-transition: none;
			}
		
			#message 
			{
				font-size: 1.5em;
				margin: 1em 0;
				padding: 10px;
				display: block;
				background: green;
				border-radius: 10px;
				color: #fff;
				text-align: center;
			}
		
			#map-outer 
			{
				width: 50%;
				padding: 6px;
				border: 1px solid #ccc;
				clear: both;
				border-radius: 3px;
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
				-moz-box-shadow: 0 0 6px #ddd;
				-webkit-box-shadow: 0 0 6px #ddd;
				float: right;
				position: absolute;
				top: 5px;
				right: 0px;
			}

			#map_canvas
			{
				width: 100%;
				height: 200px;
				float: right;
				position: relative;
				background-color: rgb(229, 227, 223);
				overflow: hidden;
				-webkit-transform: translateZ(0);
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
		</style>
		
	</head>
	
	<body>
		<!-- js
		================================================== -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">	
			$(function() 
			{

				var gmap=
				{
					init:function(Lat,Lng) 
					{
						var mapCanvas = document.getElementById('map_canvas');
						var mapOptions = 
						{
							center: new google.maps.LatLng(Lat,Lng),
							zoom: 8,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						var map = new google.maps.Map(mapCanvas, mapOptions);
					}
				}
				google.maps.event.addDomListener(window, 'load', gmap.init(34.1374961, -118.1467534));

			});		
		</script>
	
		<div class="container">
			<section id="contact">
				<header>
					<h1>MadChefKitchen Contact Form</h1>
				</header>
				<mark id="message" style="display: none;"></mark>
				
				<form method="post" action="<?php echo $PHP_SELF;?>">
   
			<fieldset>		
				<div> 	<!--  FIELD FOR THE USER TO ENTER A NAME -->
					<td valign="top"> 
							<label>Name:<span class="req">*</span> </label>
 					</td>

 					<td valign="top">	
  						<input  type="text" required autocomplete="on" name="uName" placeholder="Name Required" maxlength="50" size="30"/>
 					</td>
				</div>

				<div>	<!--  FIELD FOR THE USER TO ENTER AN EMAIL ADDRESS -->
 					<td valign="top">
						<label>Email: <span class="req">*</span> </label>
 					</td>
 
		 			<td valign="top">
  						<input  type="text" required autocomplete="on" name="uEmail" placeholder="Email Required" maxlength="80" size="30"/>
           			</td>
 				</div>
				
				<div>	<!--  FIELD FOR THE USER TO ENTER A NUMBER -->
 					<td valign="top">
						<label>Phone Number: </label>
 					</td>
 			
					<td valign="top">
  						<input  type="text" required autocomplete="on" name="uNumber" placeholder="Not Required" maxlength="30" size="30"/>
          			</td>
				</div>

				<div>	<!--  FIELD FOR THE USER TO ENTER AN ADDRESS -->
 					<td valign="top">	
						<label>Comments: </label>
 					</td>

					<td valign="top">
						<textarea name="comments" cols="40" rows="5" id="comments" placeholder="Enter your comments" spellcheck="true"> </textarea>
					</td>
				</div>
				  
				<div>	<!--  FIELD FOR THE USER TO ENTER AN ADDRESS -->
 					<td valign="top">	
						<input id="submit" type="submit" name="submit" value="SUBMIT"/>
 					</td>

					<td valign="top">
						<label style="color:purple" > <input type="checkbox" name="checkbox"<?php if (isset($agmt) && $agmt=="checkbox") echo "checked";?>
						value="checkbox"> Check Box to Subscribe! </input>
						</label>
					</td>
				</div>     		
					<section id="map-outer">
						<div id="map_canvas"></div>			
							<table style =" width:70%; font-size:14px">
								<tr>	<!--  FIELD FOR THE USER TO ENTER AN EMAIL ADDRESS -->
									<td valign="top"> <label> Email: </label> </td>
									<td valign="top"> <label> Info@MadChefKitchen.com </label> </td>
								</tr>
				
								<tr>	<!--  FIELD FOR THE USER TO ENTER A NUMBER -->
									<td valign="top"> <label> Phone Number: </label> </td>
									<td valign="top"> <label> 626-394-1777 </label> </td>
								</tr>
			
								<tr> 	<!--  FIELD FOR THE USER TO ENTER A NAME -->
									<td valign="top"> <label> Main Address: </label> </td>									
									<td valign="top"> <label> Pasadena, LA California </label> </td>
								</tr>
							</table>
						</section>
						
						<section id="map-outer" style="margin-top:35%">
						
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
					$fname = $_POST['uName']; // required
					$string_exp = "/^[A-Za-z .'-]+$/"; 
  					if(!preg_match($string_exp,$fname)) 
					{
    						$errors[] = 'The Name you entered does not appear to be valid.';
  					}
					else
					{
						$uN = mysqli_real_escape_string($dbcon, trim($_POST['uName']));
					}		
				}

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
					$uNr = "N/A";
				}
				else
				{
					$errors2[] = 'Number Entered';
					$uNr = mysqli_real_escape_string($dbcon, trim($_POST['uNumber']));
				}
				
				if (!empty($_POST['comments']))
				{
					$errors2[] = 'Comments entered';
					$comments = mysqli_real_escape_string($dbcon, trim($_POST['comments']));
  				}
				else
				{
			  		$comments = "NA";
 				}

			  	//Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
		  		if( empty($errors)) 
				{ 	//If no problems encountered //make the query
					
					//Here Write Sql Insert commeand to store 
					//the data into database as well as send acknowledgement mail 
						//Retrieve the class_id
					$q  = "SELECT * FROM Users WHERE uName='$uN' AND uEmail='$uE' AND uNumber='$uNr' AND Comments='$comments'";
					//Run the query and assign it to the variable result
					$rs  = @mysqli_query($dbcon, $q);
		    		if( mysqli_num_rows($rs) > 0)
					{  
   			     		echo '<h2> We Got Your Last Request </h2><br><lab> We Promise We Will Contact You Soon!<lab>';
    				}
    				else
					{
						//set the default timezone to use. Available since PHP 5.1
						date_default_timezone_set('America/Los_Angeles');
						
						$cdate = date("m-d-y");
						$ctime = date("H:i:s");
							
        				$errors2[] = 'Testing!';
     	 				$q = "INSERT INTO Users (uName, uNumber, uEmail, RegDate, RegTime, Comments)
				    	VALUES('$uN', '$uNr', '$uE', '$cdate', '$ctime','$comments')";
			      		$result = @mysqli_query($dbcon, $q); //Run the query.
				    	if($result == True) //If it ran ok.
						{	
							function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
							{ 
								$exploded  = explode('@', $to);
								$exploded2 = explode('.', $exploded[1]);
								switch (strtolower($exploded2[0]))
								{
									case 'hotmail'	 : $headers = "From: Dave Matthews<dave-noreply@hotmail.com>		\r\n"; 	  break;
									case 'outlook'	 : $headers = "From: Dave Matthews<dave-noreply@outlook.com>		\r\n"; 	  break;
									case 'live'	 	 : $headers = "From: Dave Matthews<dave-noreply@live.com>		\r\n"; 	  break;
									case 'gmail'	 : $headers = "From: Dave Matthews<dave-noreply@gmail.com>		\r\n"; 	  break;
									case 'googlemail': $headers = "From: Dave Matthews<dave-noreply@googlemail.com>		\r\n"; 	  break;
									case 'yahoo'	 : $headers = "From: Dave Matthews<dave-noreply@yahoo.com>		\r\n"; 	  break;
									case 'ymail'	 : $headers = "From: Dave Matthews<dave-noreply@ymail.com>		\r\n"; 	  break;
									case 'rocketmail': $headers = "From: Dave Matthews<dave-noreply@rocketmail.com>		\r\n"; 	  break;
									case 'aol'	 	 : $headers = "From: Dave Matthews<dave-noreply@aol.com>		\r\n"; 	  break;
									case 'talktalk'	 : $headers = "From: Dave Matthews<dave-noreply@talktalk.com>		\r\n"; 	  break;
									default		 	 : $headers = "From: Dave Matthews<dave-noreply@madchefkitchen.com>	\r\n"; 	  break;
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
				
							$subject = "Somebody Wish To Contact MadChefKitchen";
							$message = "A new user, named $uN, has requested to contact someone in MadChefKitchen \r\n";
							$message.= "Name: $uN \r\n"; $message.= "Email: $uE \r\n"; $message.= "Number: $uNr \r\n"; $message.= "Comments: $comments \r\n";
							mail_utf8('Piter@madchefkitchen.com','Piter Garcia', 'Piter@madchefkitchen.com', $subject, $message);
					
							//Here i'm considering both sql insert and send mail success so $result=1
							$result=1;
							echo "<h2> Thanks! </h2> <br> <lab> We are looking forward to talk to you soon!</lab>";
							exit();
						}
					}
		  		}
				else
				{ //Display the errors
			  		echo ' <h2> Error! </h2> 
			  		<lab> The following error(s) occurred:</lab> <div class="error">';
				  	foreach ($errors as $msg) 
					{ //Print each error.
						echo " - $msg<br>";
			  		}
	  				echo '</div> <lab> Please Try Again.</lab>';
				} //End of if
			}//End of the main Submit Conditional
		?>
		
						</section>
						
					</fieldset>
				</form> 
			</section>
		</div>
	</body>
</html>
