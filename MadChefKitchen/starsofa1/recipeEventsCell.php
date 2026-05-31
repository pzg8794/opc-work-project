<?php

/**

 */
	get_header(); 
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

<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>

	<!-- CSS CODE FOR THE STRUCTURE OF THE FORM AND CALENDAR OF EVENTS------------------------------------ -->
	<style type ="text/css">
		
		
		
		a, body 
		{
			font-family : Arial, Helvetica, sans-serif;
			font-size : 12px; 
		}
			
		label
		{
			position	: relative;
			font-family	: "FontAwesome";
  			font-size	: 15px;
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
  			font-size: 28px;
			font-weight: bold;
  			color: black;
  			text-align:center;
			margin-top: -5px;
    			text-shadow: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		}

			p
			{
				font-color:black;
				font-size:12px;
				font-weight:bold;
				margin-top: -0px;
				text-align:center;
			}
			
								/* EMPHASIZING THE SUBMIT BUTTON */
		#submit{
			font-family: "Times New Roman", Times, red serif;
			position: relative;
  			font-size: 15px;
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
			width:100%;
			border-left: 3px dotted #FF00CC;

			border-right: 3px dotted #FF00CC;
			margin-bottom: 1px;
			border-radius: 10px;
		}
		
		
table.table2, table.table2 th, table.table2 td {
    border: 1px solid black;
    border-collapse: collapse;
}
table.table1{
    border: 0px solid black; 
    border-collapse: collapse;
}

th, td {
    padding: 5px;
    text-align: left;    
}

th, td{
	color: #8B0000; font-weight: bold;
	width:60%;
	font-family: 'Comic Sans MS', sans-serif; font-size: 10pt; 
}

th, th{
	color: black; font-weight: bold;
	width:30%;
	font-family: 'Comic Sans MS', sans-serif; font-size: 10pt; 
}

table.table2, table.table1{
    border-collapse:collapse; table-layout:fixed; 
}

	</style>
	<!-- CSS CODE FOR THE STRUCTURE OF THE FORM AND CALENDAR OF EVENTS------------------------------------ -->
</head>


<body>


			<table class="table1" width="100%"> <!-- ---------------------------------------------------------------------------------------------------------- -->
			<tr valign="top" style="width:50%">
			<th>
	<!--  LEFT SIDE OF PAGE CONTAINING THE ADDING CLASS FORM -->
	<div id="form"> <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
		<h2> Adding a Recipe </h2><!--display the TITLE of form on the screen -->
		<form method="post" action="<?php echo $PHP_SELF;?>">  <!-- ----------------------------------------------------------------------------------- -->
			<table class="table2" width="100%"> <!-- ---------------------------------------------------------------------------------------------------------- -->
				<tr> 	<!--FIELD FOR THE NAME OF THE CLASS-------------------------------------------------------------------------------- -->
    				<th> 
						<label for="Rname"> Recipe Name: </label>  
					</th>

    				<td colspan="2"> 
  						<input  type="text" required autocomplete="on" name="Rname" placeholder="Recipe Required" spellcheck="true" maxlength="50" size="20">
					</td>
				</tr>	<!--FIELD FOR THE NAME OF THE CLASS------------------------------------------------------------ -->

				<tr> 	<!--FIELD FOR THE NAME OF THE CLASS-------------------------------------------------------------------------------- -->
    				<th> 
						<label for="Rauthor">Author: </label>  
					</th>

    				<td colspan="2"> 
  						<input  type="text" required autocomplete="on" name="Rauthor" placeholder="Author Required" spellcheck="true" maxlength="50" size="20">
					</td>
				</tr>	<!--FIELD FOR THE NAME OF THE CLASS------------------------------------------------------------ -->
				
				<tr> 	<!--FIELD FOR THE NAME OF THE CLASS-------------------------------------------------------------------------------- -->
    				<th> 
						<label for="Rtype">Type: </label>  
  						<input  type="text" autocomplete="on" name="Rtype" placeholder="Not Req." maxlength="50" spellcheck="true" size="5">
					</th>
					
					<td colspan="2"> 
						<label for="Rcuisine">Cuisine: </label>  
  						<input  type="text" autocomplete="on" name="Rcuisine" placeholder="Not Req." maxlength="50" spellcheck="true" size="5">
					</td>

				</tr>	<!--FIELD FOR THE NAME OF THE CLASS------------------------------------------------------------ -->
				
				<tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS-------------------------------------------------------------- -->
 					<th>
  						<label for="Rsummary">Summary: </label>
 					</th>


 					<td colspan="2">
 						<textarea name='Rsummary' cols="40" rows="5" placeholder="Not Required" spellcheck="true" id='Rsummary'></textarea><br />
 			 			<input type='hidden' name='articleid' id='articleid' 
 			 			value="<?php if (isset($_POST['Rsummary'])) echo $_POST['Rsummary']; ?>">
					</td>
				</tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS------------------------------------------------------------- -->

	
				<tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS-------------------------------------------------------------- -->
 					<th>
  						<label for="Ringredients">Ingridients: </label>
 					</th>


 					<td colspan="2">
 						<textarea name='Ringridients' cols="40" rows="5"  placeholder="Ingredients Required" spellcheck="true" id='Ringridients'></textarea><br />
 			 			<input type='hidden' name='articleid' id='articleid'  
 			 			value="<?php if (isset($_POST['Ringridients'])) echo $_POST['Ringridients']; ?>">
					</td>
				</tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS------------------------------------------------------------- -->

				<tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS-------------------------------------------------------------- -->
 					<th>
  						<label for="Rinstructions">Instructions: </label>
 					</th>

 					<td colspan="2">
 						<textarea name='Rinstructions' cols="40" rows="5" placeholder="Instructions Required"  spellcheck="true" id='Ringridients'></textarea><br />
 			 			<input type='hidden' name='articleid' id='articleid' 
 			 			value="<?php if (isset($_POST['Rinstructions'])) echo $_POST['Rinstructions']; ?>">
					</td>
				</tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS------------------------------------------------------------- -->

				<tr> 	<!--FIELD FOR THE NAME OF THE CLASS-------------------------------------------------------------------------------- -->
    				<th> 
						<label for="Rptime">Prep. Time: </label>  <br>
  						<input  type="text" autocomplete="on" name="Rptime"  placeholder="Not Req." maxlength="50" size="5">
					</th>

					<td> 
						<label for="Rctime">Cooking Time: </label> <br>
  						<input  type="text" autocomplete="on" name="Rctime" placeholder="Not Req." maxlength="50" size="5">
					</td>
					
					<td> 
						<label for="Ryield">Yield: </label> <br>
  						<input  type="text" autocomplete="on" name="Ryield" placeholder="Not Req."  maxlength="50" size="5"><a>servings</a>
					</td>
				</tr>	<!--FIELD FOR THE NAME OF THE CLASS------------------------------------------------------------ -->
	
				<tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS-------------------------------------------------------------- -->
 					<th>
  						<label for="Rnutrition">Nutrition: </label>
 					</th>


 					<td colspan="2">
 						<textarea name='Rnutrition' cols="40" rows="5" placeholder="Not Required"  spellcheck="true" id='comments'></textarea><br />
 			 			<input type='hidden' name='articleid' id='articleid' 
 			 			value="<?php if (isset($_POST['Rnutrition'])) echo $_POST['Rnutrition']; ?>">
					</td>
				</tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS------------------------------------------------------------- -->

				
				<tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS-------------------------------------------------------------- -->
 					<th>
  						<label for="Rnotes">Notes: </label>
 					</th>

 					<td colspan="2">
 						<textarea name='Rnotes' cols="40" rows="5" placeholder="Not Required" spellcheck="true" id='comments'></textarea><br />
 			 			<input type='hidden' name='articleid' id='articleid' 
 			 			value="<?php if (isset($_POST['Rnotes'])) echo $_POST['Rnotes']; ?>">
					</td>
				</tr>	<!--FIELD FOR ADDITION INFORMATION OF THE CLASS------------------------------------------------------------- -->


				<tr>	<!-- BUTTON TO SUBMIT THE FOR TO ADD THE CLASS-------------------------------------------------------------- -->
 					<td colspan="3">
  						<label for="submit"></label>
						<p><input type="submit" id="submit" name="action" value="ADD RECIPE"/></p>
					</td>
				</tr>	<!-- BUTTON TO SUBMIT THE FOR TO ADD THE CLASS------------------------------------------------------------- -->

			</table> <!-- --------------------------------------------------------------------------------------------------------------- -->
		</form> <!-- End of the page content.-------------------------------------------------------------------------------------------------- -->
	</div> <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
	</th>
</tr>

<tr valign="top" style="width:50%">
<th>
	<!--  RIGHT SIGHT OF THE PAGE DISPLAYING THE MESSAGE -->
	<div style="float:right; margin-top:0px; text-align: aligncenter"> 	
		<h2> Load Multiple Recipes </h2>
		
		<form name="load" method="post" id="load" action="<?php echo $PHP_SELF;?>" enctype="multipart/form-data"> 
		
			<table width="100%"> <!-- ---------------------------------------------------------------------------------------------------------- -->
				<tr>
					<input type="file" name="file" size="60" />
					<input type="submit" value="Load" name='action'>
					<br><br><br><br><h2>
				</tr>
				
				
				<tr>
				
				<?php 
					if(isset($_POST['action']) && $_POST['action'] == 'Load') 
					{
						// Pear library includes
						// You should have the pear lib installed
						//include_once('Mail.php');
						//include_once('Mail_Mime/mime.php');

						//Settings 
						$max_allowed_file_size = 100; // size in KB 
						//$allowed_extensions = array("csv", "text", "doc", "xlsx");
						$allowed_extensions = array("csv");
						//$upload_folder = './uploads/'; //<-- this folder must be writeable by the script
						$errors =array();
					
					
					
						if($_SERVER['REQUEST_METHOD'] == 'POST') 
						{
							//Get the uploaded file information
							$name_of_uploaded_file =  basename($_FILES['file']['name']);
							echo $name_of_uploaded_file."<br>";
							//get the file extension of the file
							$type_of_uploaded_file = substr($name_of_uploaded_file, strrpos($name_of_uploaded_file, '.') + 1);
							echo $type_of_uploaded_file."<br>";
							$size_of_uploaded_file = $_FILES["file"]["size"]/1024;
							echo $size_of_uploaded_file."<br>" ;
				
							///------------Do Validations-------------	
							if($size_of_uploaded_file > $max_allowed_file_size ) 
							{
								$errors[] = "\n Size of file should be less than $max_allowed_file_size";
							}
											
							//------ Validate the file extension -----
							$allowed_ext = false;
							for($i=0; $i<sizeof($allowed_extensions); $i++) 
							{ 
								if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
								{
									$allowed_ext = true;		
								}
							}
	
							if(!$allowed_ext)
							{
								$errors[] = "\n The uploaded file is not supported file type. ".
								" Only the following file types are supported: ".implode(',',$allowed_extensions);
							}
	
							//send the email 
							if(empty($errors))
							{
								echo 'No Errors Found';
								$row = 1;
								//FOR CSV FILES ONLY
								if (($handle = fopen($_FILES['uploaded_file']['name'], "r"))) 
								{
									echo 'reading file';
									while (($data = fgetcsv($handle, 1000, ",")) != FALSE) 
									{
										$num = count($data);
										echo "<p> $num fields in line $row: <br /></p>\n";
										$row++;
			
										for ($c=0; $c < $num; $c++)
										{
											echo $data[$c] . "<br />\n";
										}
									}
									fclose($handle);
								}
								
								if($_FILES)
								{
									//Checking if file is selected or not
									if($_FILES['file']['name'] != "") 
									{
										//Checking if the file is plain text or not
										echo "<center><span id='Content'>Contents of ".$_FILES['file']['name']." File</span></center>";
 
										//Getting and storing the temporary file name of the uploaded file
										$fileName = $_FILES['file']['tmp_name'];
		
										//Throw an error message if the file could not be open
										$file = fopen($fileName,"r") or exit("Unable to open file!");
										echo 'No Errors Found When Reading The File <br><br>';
  
										$row = 0;
										$title = array();
										$recipes = array();
								
										while (($data = fgetcsv($file, 1000, ",")) != FALSE) 
										{	
											$num = count($data);
											if($row != 0)
											{
												echo "<br><strong>Recipe No.: $row </strong><br>\n";
												echo "$num fields in Recipe $row: <br />\n";
											}
						
											$recipe = array();
											for ($c=0; $c < $num; $c++)
											{
												if($row == 0)
												{
													$title[] = $data[$c];
												}
												else
												{
													if(!empty($data[$c]))
														$recipe[] = $data[$c];
													else
													{
														
														if(empty($data[$c]) && $c==1)
															$recipe[] ="MCK";
														else if(empty($data[$c]) && ($c==1 || $c==2 || $c==3 || $c==4 || $c==7 || $c==8 || $c==9 || $c==10))
															$recipe[] ="TBD";
														else if(empty($data[$c]) && $c==11)
															$recipe[] ="To Be Contine ...";
														//echo "<br/>\n";
													}
													echo "<div style='text-align:justify'> $title[$c]: $recipe[$c] </div>";
												}	
											}
							
											if($row !=0)
												$recipes[] = $recipe;
									
											$row++;
										}
										$count=0;
						
										foreach ($recipes as $recipe) 
										{ 
											++$count;
											//echo " $count - Class <br>\n <br>\n ";
											//print_r($class);
											$rn= $recipe[0]; 	$ra= $recipe[1]; 	$rt= $recipe[2]; 	$rc= $recipe[3]; 	$rs= $recipe[4]; 	$rts= $recipe[5]; 
											$rns= $recipe[6];	$rpt= $recipe[7]; 	$rct= $recipe[8]; 	$ryd= $recipe[9]; 	$ron= $recipe[10]; 	$res= $recipe[11];
											
											//CHECKING IF THE CLASS ENTERED IS ALREADY IN THE CLASSES DATASET--------------------------------
											$q  = "SELECT * FROM Recipes WHERE Rname ='$rn' AND Rauthor ='$ra' AND Rtype ='$rt' AND Rcuisine ='$rc' 
											AND Rsummary ='$rs' AND Ringredients ='$rts' AND Rinstructions = '$rns' AND Rprep_time='$rpt' AND Rcoock_time = '$rct'
											AND Ryield='$ryd' AND Rnutrition='$ron' AND Rnotes='$res'";
			
											//Run the query and assign it to the variable result
											$rlts  = @mysqli_query($dbcon, $q);
											//-----------------------------------------------------------------------------------------------
											//QUITING INSERTING THE CLASS IF IS ALREADY IN THE CLASSES DATASET-----
											if( mysqli_num_rows($rlts) > 0)
											{  
												echo '<label> The Recipe '.$rn.'  Was Already Added </label><br>';
											}//---------------------------------------------------------------------	
											// INSERING THE CLASS IF THIS IS NOT FOUND IN THE CLASSES DATASET---------------------------------------------------
											else
											{
												$errors2[] = 'Testing!';
												$q  = "INSERT INTO Recipes (Rname, Rauthor, Rtype, Rcuisine, Rsummary, Ringredients, Rinstructions, Rprep_time, Rcoock_time, Ryield, Rnutrition, Rnotes)
												VALUES('$rn','$ra','$rt','$rc','$rs','$rts', '$rns', '$rpt', '$rct', '$ryd', '$ron', '$res')";
											
												$result = @mysqli_query($dbcon, $q); //Run the query.
												if($result == True) //If it ran ok.
												{
													$errors2[] = 'Testing2!';
													$errors2[] = 'Insert Query Worked';
													echo '<label> The Recipe'.$rn.'  Was Added Succesfully </label><br>';
													//end of SUCCESSFUL SECTION
												}
												else
												{ // if the form handler or database table contained errors
													//display an error message
													echo '<h2> System Error </h2>
													<p class="error"> Sorry, The Recipe'.$rn.' Was not Possible To Add Due To A System Error.
													<br>  Please Try Again Later.</p>';

													//Debug the message:
													echo '<p>' . mysqli_error($dbcon). '<br><br>Query: ' . $q . '</p>';
												}//End of if clause($result).
												// Include the footer and wuit the script:
												//------------------------------------------------------------------------------------------------------------- 		
											}
										}
										fclose($file);
										mysqli_close($dbcon); //Close the database connection.
									}
									else 
									{
										if(isset($_FILES) && $_FILES['file']['type'] == '')
											echo "<span>Please Choose a file by click on 'Browse' or 'Choose File' button.</span>";
									}		
								}
							}
							else
							{	
								echo '<h2> Error! </h2>
								<p class="error"> The following error(s) occurred:<br>';
	
								foreach ($errors as $msg) 
								{ //Print each error.
									echo " - $msg<br>";
								}
								echo '</p><h3>Please Try Again.</h3>';
							}
						}
					}
				
				///////////////////////////Functions/////////////////
				// Function to validate against any email injection attempts		
			?>

		<?php
			//$link = require('mysqli_connect.php'); //connect to the database.

			//The script performs an INSERT query that adds a record to the CLASSES table.----------------------------------------------------------
			if(isset($_POST['action']) && $_POST['action'] == 'ADD RECIPE') 
			{
				if($_SERVER['REQUEST_METHOD'] == 'POST') 
				{
					$errors = array(); // Initialize an error array.
					$errors2 = array(); // Initialize an NOT error array.

					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rname']))
					{
						$errors[] = 'You Did Not Enter The Name Of The Recipe.';
						//echo 'test -1';
					}
					else
					{
						//echo 'test 1';
						$errors2[] = 'Name Entered';
						$rn = mysqli_real_escape_string($dbcon, trim($_POST['Rname']));
					}
					//---------------------------------------------------------------------------
	
					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rauthor']))
					{
						$ra = 'MCK';	
						//echo 'test -2';
					}
					else
					{	
						//echo 'test 2';
						$errors2[] = 'Author Entered';
						$ra = mysqli_real_escape_string($dbcon, trim($_POST['Rauthor']));
					}
					//---------------------------------------------------------------------------
	
					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rtype']))
					{	
						//echo 'test -3';
						$rt = 'TBD';
					}
					else
					{
						//echo 'test 3';
						$errors2[] = 'Type Entered';
						$rt = mysqli_real_escape_string($dbcon, trim($_POST['Rtype']));
					}
					//---------------------------------------------------------------------------
	
					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rcuisine']))
					{
						$rc = 'TBD';	
						//echo 'test -4';
					}
					else
					{
						//echo 'test 4';
						$errors2[] = 'Cuisine Entered';
						$rc = mysqli_real_escape_string($dbcon, trim($_POST['Rcuisine']));
					}
					//---------------------------------------------------------------------------

					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rsummary']))
					{
						$rs = 'TBD';	
						//echo 'test -5';
					}
					else
					{		
						//echo 'test 5';
						$errors2[] = 'Summary Entered';
						$rs = mysqli_real_escape_string($dbcon, trim($_POST['Rsummary']));
					}
					//---------------------------------------------------------------------------
				
					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Ringridients']))
					{	
						//echo 'test -6';
						$errors[] = 'You Did Not Enter The Ingridients Of The Recipe.';
					}
					else
					{		
						//echo 'test 6';
						$errors2[] = 'Name Entered';
						$rts = mysqli_real_escape_string($dbcon, trim($_POST['Ringridients']));
					}
					//---------------------------------------------------------------------------
				
					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rinstructions']))
					{
						$errors[] = 'You Did Not Enter The Instructions Of The Recipe.';	
						//echo 'test -7';
					}
					else
					{
						//echo 'test 7';
						$errors2[] = 'Name Entered';
						$rns = mysqli_real_escape_string($dbcon, trim($_POST['Rinstructions']));
					}
					//---------------------------------------------------------------------------
					
					
					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rctime']))
					{
						$rct = 'TBD';	
						//echo 'test -8';
					}
					else
					{
						//echo 'test 8';
						$errors2[] = 'Cooking Time Entered';
						$rct = mysqli_real_escape_string($dbcon, trim($_POST['Rctime']));
					}
					//---------------------------------------------------------------------------
				
					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rptime']))
					{
						$rpt = 'TBD';	
						//echo 'test -9';
					}
					else
					{
						//echo 'test 9';
						$errors2[] = 'Preparation Time Entered';
						$rpt = mysqli_real_escape_string($dbcon, trim($_POST['Rptime']));
					}
					//---------------------------------------------------------------------------
				
					//WAS THE LOCATION OF THE CLASS ENTERED?-----------------------------------------
					if (empty($_POST['Ryield']))
					{
						$ryd = 'TBD';	
						//echo 'test -10';
					}
					else
					{
						//echo 'test 10';
						$errors2[] = 'Yield Entered';
						$ryd = mysqli_real_escape_string($dbcon, trim($_POST['Ryield']));
					}
					//-------------------------------------------------------------------------------

					//WAS THE NAME OF THE CLASS ENTERED?----------------------------------------
					if (empty($_POST['Rnutrition']))
					{
						$ron = 'TBD';	
						//echo 'test -11';
					}
					else
					{	
						//echo 'test 11';
						$errors2[] = 'Nutrition Entered';
						$ron = mysqli_real_escape_string($dbcon, trim($_POST['Rnutrition']));
					}
					//---------------------------------------------------------------------------
				
					// WAS THE COMMENT(S) OF THE CLASS ENTERED?--------------------------------------
					if (!empty($_POST['Rnotes']))
					{
						//echo 'test 12';
						$res = mysqli_real_escape_string($dbcon, trim($_POST['Rnotes']));
					}
					else
					{
						//echo 'test -12';
						$res = "To be continue...";
					}
					//-------------------------------------------------------------------------------

					//START OF THE SUCCESSFUL SECTION IF ALL THE FIELD WERE FILLED OUT WITHOUT ERRORS.------------------------------------
					if( empty($errors)) 
					{ 	
						//echo '<br>NO ERRORS<br>';
						//CHECKING IF THE CLASS ENTERED IS ALREADY IN THE CLASSES DATASET--------------------------------
						$q  = "SELECT * FROM Recipes WHERE Rname ='$rn' AND Rauthor ='$ra' AND Rtype ='$rt' AND Rcuisine ='$rc' 
						AND Rsummary ='$rs' AND Ringredients ='$rts' AND Rinstructions = '$rns' AND Rprep_time='$rpt' AND Rcoock_time = '$rct'
						AND Ryield='$ryd' AND Rnutrition='$ron' AND Rnotes='$res'";
						
						//Run the query and assign it to the variable result
						$rlts  = @mysqli_query($dbcon, $q);
						//-----------------------------------------------------------------------------------------------
						//if($rlts)
						//	echo '<br> Query went well <br>';
						//else
						//	echo '<br> Query went wrong <br>';

						//QUITING INSERTING THE CLASS IF IS ALREADY IN THE CLASSES DATASET-----
						if( mysqli_num_rows($rlts) > 0)
						{  
							echo '<label> Class '.$rn.' Was Already Added </label><br>';
							echo '<label>Please Try Another Class Name</label>';
						}
						//---------------------------------------------------------------------
	    				
						// INSERING THE CLASS IF THIS IS NOT FOUND IN THE CLASSES DATASET---------------------------------------------------
						else
						{
							//echo 'Inserting Recipe into Database';
							
							$errors2[] = 'Testing!';
							$q  = "INSERT INTO Recipes (Rname, Rauthor, Rtype, Rcuisine, Rsummary, Ringredients, Rinstructions, Rprep_time, Rcoock_time, Ryield, Rnutrition, Rnotes)
							VALUES('$rn','$ra','$rt','$rc','$rs','$rts', '$rns', '$rpt', '$rct', '$ryd', '$ron', '$res')";
							$result = @mysqli_query($dbcon, $q); //Run the query.
				    	
							if($result == True) //If it ran ok.
							{			
								//$errors2[] = 'Testing2!';
								$errors2[] = 'Insert Query Worked';
								echo '<label> Class '.$rn.' Was Added Succesfully </label>';
								exit();
								//end of SUCCESSFUL SECTION
							}
							else
							{ // if the form handler or database table contained errors
	
								//display an error message
								echo '<h2> System Error </h2>
								<p class="error"> Sorry, The Class '.$cn.' Was Not Possible To Schedule Due To A System Error.
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
						
						echo 'ERRORS';
						
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
			}	//End of the main Submit Conditional---------------------------------------------------------------------------------------------------
		?>
				
				</tr>
			</table>
		</form>
	</div>
	</th>
</tr>
</table>

</body>
</html>