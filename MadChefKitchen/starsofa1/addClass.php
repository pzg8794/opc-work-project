<?php

//CHECKING IF THE CLASSES DATASET IS EMPTY-------
				function addClass($cn, $m, $tm, $etm, $loc, $com)
				{
					echo $cn;
					echo $loc;
					echo $com;
					
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
?>