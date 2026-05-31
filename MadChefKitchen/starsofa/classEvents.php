<?php

/**

 */
	get_header(); 
?>

<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>

	<!-- CSS CODE FOR THE STRUCTURE OF THE FORM AND CALENDAR OF EVENTS------------------------------------ -->
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

		/* TITLE FOR THE ADDING CLASS FORM */
		h2{
			font-family: "Times New Roman", Times, red serif;
  			font-size: 38px;
			font-weight: bold;
  			color: black;
  			text-align:center;
			margin-top: -5px;
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
	<!-- CSS CODE FOR THE STRUCTURE OF THE FORM AND CALENDAR OF EVENTS------------------------------------ -->


	<?php	// CONNECTING TO THE DATABASE---------------------------------------------------------------------------------------------------------
		// This file provides the information for accessing the database and connecting to MySQL. 
		// It also sets the language coding to utf-8. First we define the constants:

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
		// CONNECTING TO THE DATABASE---------------------------------------------------------------------------------------------------------
	?>
</head>


<body>


	<!--  LEFT SIDE OF PAGE CONTAINING THE ADDING CLASS FORM -->
	<div id="form"> <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
		<h2> Adding a Class </h2><!--display the TITLE of form on the screen -->
		<form method="post" action="<?php echo $PHP_SELF;?>">  <!-- ----------------------------------------------------------------------------------- -->
			<table width="450px"> <!-- ---------------------------------------------------------------------------------------------------------- -->
				<tr> 	<!--FIELD FOR THE NAME OF THE CLASS-------------------------------------------------------------------------------- -->
    					<td valign="top"> 
						<label for="Class_Name">Class Name: </label>  
					</td>

    					<td valign="top"> 
  						<input  type="text" required autocomplete="on" name="Class_Name" maxlength="50" size="30">
					</td>
				</tr>	<!--FIELD FOR THE NAME OF THE CLASS------------------------------------------------------------ -->

				<tr>	<!--FIELD TO ENTER THE DATE OF THE CLASS--------------------------------------------------------------------------- -->
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
				</tr>	<!--FIELD TO ENTER THE DATE OF THE CLASS-------------------------------------------------------------------------- -->

				<tr>	<!--FIELD TO ENTER THE TIME THAT THE CLASS STARTS----------------------------------------------------------------- -->
 					<td valign="top">
  						<label for="Class_sTime">Class Start Time: </label>
 					</td>
					
					<td valign="top">
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
					</td>		
				</tr>	<!--FIELD TO ENTER THE TIME THAT THE CLASS STARTS--------------------------------------------------------------- -->


				<tr>	<!--FIELD TO ENTER THE TIME THE CLASS ENDS------------------------------------------------------------------------->
 					<td valign="top">
  						<label for="Class_sTime">Class End Time: </label>
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
	
				  		<!-- <input id="Class_eTime" type="text" name="Class_eTime" size="30" maxlength="40"
  						value=""<?php if (isset($_POST['Class_eTime'])) echo $_POST['Class_eTime']; ?>"> -->
					</td>		
				</tr>	<!--FIELD TO ENTER THE TIME THE CLASS ENDS-------------------------------------------------------------------- -->


				<tr>	<!--FIELD FOR THE LOCATION OF THE CLASS----------------------------------------------------------------------- -->
 					<td valign="top">
  						<label for="Class_Location">Class Location: </label>
 					</td>
    		
 					<td valign="top">
					 	<input id="lebel1" type="text" name="Class_Location" size="30" maxlength="30" 
    						value="<?php if (isset($_POST['Class_Location'])) echo $_POST['Class_Location']; ?>">
					</td>
				</tr>	<!--FIELD FOR THE LOCATION OF THE CLASS---------------------------------------------------------------------- -->


				<tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS-------------------------------------------------------------- -->
 					<td valign="top">
  						<label for="comments">Comments: </label>
 					</td>


 					<td valign="top">
 						<textarea name='comments' id='comments'></textarea><br />
 			 			<input type='hidden' name='articleid' id='articleid' 
 			 			value=""<?php if (isset($_POST['comments'])) echo $_POST['comments']; ?>">
					</td>
				</tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS------------------------------------------------------------- -->


				<tr>	<!-- BUTTON TO SUBMIT THE FOR TO ADD THE CLASS-------------------------------------------------------------- -->
 					<td valign="top">
  						<label for="submit"></label>
 					</td>


 					<td valign="top">
						<input id="submit" type="submit" name="submit" value="ADD CLASS">
					</td>
				</tr>	<!-- BUTTON TO SUBMIT THE FOR TO ADD THE CLASS------------------------------------------------------------- -->

			</table> <!-- --------------------------------------------------------------------------------------------------------------- -->
		</form> <!-- End of the page content.-------------------------------------------------------------------------------------------------- -->
	</div> <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->


	<!--  RIGHT SIGHT OF THE PAGE DISPLAYING THE MESSAGE -->
	<div style="float:right; margin-top:0px; text-align: aligncenter"> 	
		<h2> Message </h2>

		<?php
			//$link = require('mysqli_connect.php'); //connect to the database.

			//The script performs an INSERT query that adds a record to the CLASSES table.----------------------------------------------------------
			if($_SERVER['REQUEST_METHOD'] == 'POST') 
			{
				$errors = array(); // Initialize an error array.
				$errors2 = array(); // Initialize an NOT error array.

			  	//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
				if (empty($_POST['Class_Name']))
				{
					$errors[] = 'You Did Not Enter the Name of the Class.';
				}
				else
				{
					$errors2[] = 'Name Entered';
					$cn = mysqli_real_escape_string($dbcon, trim($_POST['Class_Name']));
				}
				//---------------------------------------------------------------------------
	

		    		//WAS THE DATE OF THE CLASS ENTERED? ----------------------------------------
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
				//----------------------------------------------------------------------------

				
				// WAS THE START TIME OF THE CLASS ENTERED? ----------------------------------
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
				//----------------------------------------------------------------------------


				// WAS THE ENDING TIME OF THE CLASS ENTERED?-----------------------------------
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
				//-------------------------------------------------------------------------------


		 	 	//WAS THE LOCATION OF THE CLASS ENTERED?-----------------------------------------
				if (empty($_POST['Class_Location']))
				{
					$errors[] = 'You Did Not Enter the Location of the Class.';
				}
				else
				{
					$errors2[] = 'Class Location Entered';
					$loc = mysqli_real_escape_string($dbcon, trim($_POST['Class_Location']));
				}
				//-------------------------------------------------------------------------------


				// WAS THE COMMENT(S) OF THE CLASS ENTERED?--------------------------------------
				if (!empty($_POST['comments']))
				{
					$com = mysqli_real_escape_string($dbcon, trim($_POST['comments']));
  				}
				else
				{
			  		$com = " ";
 				}
				//-------------------------------------------------------------------------------

			  	//START OF THE SUCCESSFUL SECTION IF ALL THE FIELD WERE FILLED OUT WITHOUT ERRORS.------------------------------------
  				if( empty($errors)) 
				{ 	
					//CHECKING IF THE CLASSES DATASET IS EMPTY-------
					$q  = "SELECT * FROM Classes";
					$rs   = @mysqli_query($dbcon, $q);	
					$total_users = mysqli_num_rows($rs);	
					if( $total_users == 0)
					{
						//$q = "TRUNCATE TABLE Classes";
						//$result = @mysqli_query($dbcon, $q); 
					}
					//------------------------------------------------
					
					else
					{
						//CHECKING IF THE COLORS DATASET IS EMPTY----------------
						$q  = "SELECT * FROM Colors";
						$rs = @mysqli_query($dbcon, $q);	
						$total_colors = mysqli_num_rows($rs);	
						if( $total_colors == 0)
						{
							//echo "<label> test1 </label>";
							//$colors = array();								// set array
							$i = 1;
							while(count($colors) != ($total_users+1)) 
							{
   								$hex = substr(str_shuffle(implode(array_merge(range(0, 9), range('A', 'F')))), 0, 6);
   								while (in_array($hex, $colors)) 
								{
   									$hex = substr(str_shuffle(implode(array_merge(range(0, 9), range('A', 'F')))), 0, 6);
								}
								$colors[$hex] = '#' . $hex;

      								//echo implode("\n", $colors);
      								//break;

      								$q2 = "UPDATE Classes
								SET ColorId='$colors[$hex]'
								WHERE ClassId='$i'";
			      					$rs2 = @mysqli_query($dbcon, $q2); //Run the query.
   							
								$i++;
							}

							$query = mysql_query("SELECT * FROM Classes");	// run query

							while($row = mysql_fetch_assoc($query))		// look through query
							{
								$pieces = explode("-", $row['Class_Date']);
								$mth = $pieces[0];
								$cid = $row['ClassId'];
								$crid = $row['ColorId'];

								//echo "<label> $mth </label><br/>";
								//echo "<label> $cid </label><br/>";
								//echo "<label> $crid </label><br/>";

		 					 	// add each row returned into an array
      								$q1 = "INSERT INTO cColors (classId, cMonth, cColor)
		    						VALUES('$cid', '$mth', '$crid')";
			      					$rs1 = @mysqli_query($dbcon, $q1); 
							}
						}
						//--------------------------------------------------------
						else
						{
							do 
							{	
   								$hex = substr(str_shuffle(implode(array_merge(range(0, 9), range('A', 'F')))), 0, 6);
								$qry = mysql_query("SELECT * FROM Classes WHERE ColorId='$hex'");	// run query
								$rts = @mysqli_query($dbcon, $q1); 

							} while ( mysqli_num_rows($rts) != 0);
						}

						
					}

		    			//CHECKING IF THE CLASS ENTERED IS ALREADY IN THE CLASSES DATASET--------------------------------
					$q  = "SELECT * FROM Classes WHERE Class_Name ='$cn' AND Class_Date ='$m' AND Class_sTime ='$tm' 
					AND Class_eTime ='$etm' AND Class_Location ='$loc'";
		
					//Run the query and assign it to the variable result
					$rs  = @mysqli_query($dbcon, $q);
					//-----------------------------------------------------------------------------------------------

					
					//QUITING INSERTING THE CLASS IF IS ALREADY IN THE CLASSES DATASET-----
		    			if( mysqli_num_rows($rs) > 0)
					{  
        					echo '<label> Class Was Already Added </label><br>';
    	  					echo '<label>Please Try Another Class Name</label>';
    					}
					//---------------------------------------------------------------------
	    				
					// INSERING THE CLASS IF THIS IS NOT FOUND IN THE CLASSES DATASET---------------------------------------------------
					else
					{
						$errors2[] = 'Testing!';
      						$q = "INSERT INTO Classes (ColorId, Class_Name, Class_Date, Class_sTime, Class_eTime, Class_Location, Comments)
		    				VALUES('$hex', '$cn', '$m', '$tm','$etm', '$loc', '$com')";

			      			$result = @mysqli_query($dbcon, $q); //Run the query.
				    		if($result == True) //If it ran ok.
						{
							$query = mysql_query("SELECT * FROM Classes WHERE ColorId='$hex'");	// run query
							while($row = mysql_fetch_assoc($query))		// look through query
							{
								$pieces = explode("-", $m);
								$mth = $_POST['cmonth'];
								$cid = $row['ClassId'];
								$crid = $hex;
		
				 				// add each row returned into an array
      								$q1 = "INSERT INTO cColors (classId, cMonth, cColor)
		    						VALUES('$cid', '$mth', '$crid')";
			      					$rs1 = @mysqli_query($dbcon, $q1); 
							}
					
							$errors2[] = 'Testing2!';
							$errors2[] = 'Insert Query Worked';
							echo '<label> Class was added Succesfully </label>';
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
					//-------------------------------------------------------------------------------------------------------------   
  				}
				//-------------------------------------------------------------------------------------------------------------------------

				//DISPLAYING ANY ERROR FOUND IN THE FORM IF USER DID NOT FILLED IT OUT CORRECTLY.------------------------------------------
				else
				{ //Display the errors

				  		echo ' <h2> Error! </h2> 
				  		<label> The following error(s) occurred:</label> <p class="error">';

					  	foreach ($errors as $msg) 
						{ //Print each error.
							echo " - $msg<br>\n";
				  		}
	  					echo '</p> <label> Please Try Again.</label>';
				}
				//-------------------------------------------------------------------------------------------------------------------------

			}
			//End of the main Submit Conditional---------------------------------------------------------------------------------------------------
		?>
	</div>

</body>
</html>