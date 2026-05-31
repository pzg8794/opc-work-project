


	<div id="container1">
		<?php get_template_part('calendarEvent'); ?>

		<style type ="text/css">
			h2
			{
				font-family	: "FontAwesome";
  				font-size	: 30px;
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
  				font-size	: 20px;
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
  				font-size	: 20px;
				font-weight	: bold;
  				color		: black;
				margin-left	: 10px;
  				text-align	: left;			
			}
		</style>
	</div>
 
	<style type ="text/css">
		h1
		{
			font-family	: "Times New Roman", Times, red serif;
  			font-size	: 38px;
			font-weight	: bold;
  			color		: black;
  			text-align	:center;
			margin-top	: -5px;
    			text-shadow	: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		} 

		h3
		{
			font-family	: "Times New Roman", Times, red serifs;
  			font-size	: 38px;
			font-weight	: bold;
  			color		: black;
  			text-align	:center;
			margin-top	: -5px;
    			text-shadow	: -1px 0 #FF00CC, 0 1px #FF00CC, 1px 0 #FF00CC, 0 -1px #FF00CC;
		} 
	</style>
	
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
	?>

	<form method="post" action="<?php echo $PHP_SELF;?>">
		<div id="content1">     
      			<div class="tab-content1">
          			<h1 align="center">Register for a Class</h1>
          			<div class="top-row">
            				<div class="field-wrap">
              					<label>
                					Name <span class="req">*</span>
              					</label>
              					<input type="name" required autocomplete="on" align="right" name="Stname" size="30" maxlength="30" 
    						value="<?php if (isset($_POST['Stname'])) echo $_POST['Stname'];?>"/>
           				</div>
          					
					<div class="field-wrap">
             					<label>
                					Email <span class="req">*</span>
              					</label>	
             					<input type="Stemail" required autocomplete="on" align="right" name="Stemail" size="30" maxlength="30" 
    						value="<?php if (isset($_POST['Stemail'])) echo $_POST['Stemail'];?>"/>
           				</div>
				</div>
            
          			<div class="field-wrap">
            				<label>
              					Phone Number<span class="req">*</span>
            				</label>
          				<input type="text"required autocomplete="on" name="Stnumber" size="30" maxlength="30" 
    					value="<?php if (isset($_POST['Stnumber'])) echo $_POST['Stnumber'];?>"/>
          			</div>
          
           
	 			<div class="field-wrap">
					<!-- Please Choose Type of Class:<br /> -->
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

				<p>
					<div id="label"> <label> Class Date: </label></div> 
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
        							echo '  <option value="' . $m . '">' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
    							}
    						echo '</select>' . PHP_EOL;

						$t=date('d-m-Y');
						//$dayName = strtolower(date("D",strtotime($t)));
						$dayNum = strtolower(date("d",strtotime($t)));
	   					// build days menu
    						echo '<select name="cday">' . PHP_EOL;
    							for ($d=$dayNum; $d<=31; $d++) {
       								echo '<option value="' . $d . '">' . $d . '</option>' . PHP_EOL;
   							}
    						echo '</select>' . PHP_EOL; 
					?>
				</p>

				<p>
  					<div id="label"> <label> Class Time: </label> </div>
					<label> Hour: </label>
					<select name="chour">
						<?php foreach (range(0,24) as $hour):?>
						<option value="<?php echo $hour;?>"><?php echo $hour;?></option>
						<?php endforeach?>
					</select>

					<label> Minute(s): </label>
					<select name="cminute">
						<?php foreach (range(0,59) as $minute):?>
						<option value="<?php echo $minute;?>"><?php echo $minute;?></option>
						<?php endforeach?>
					</select>
				</p>

				<label>
					<p><input id="submit" type="submit" name="submit" value="REGISTER"></p> 
				</label>
      			</div> <!-- tab-content -->
		</div> <!-- /form --> <!-- End of the page content. --> 
	</form> 



	<div id="sidebar">   
		<h3 align="center">Classes Available</h3>
		<div style="float:left;"> 
        		<img id="octagon"
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title="
SLIDERS and More:			On September 12th 		10:00am-01:00pm
Celebrate the end of summer with tasty sliders. Our Chef/Instructors will teach you about grinding
your own meat for more flavorful burgers. You will create a Red, White, and Blue Burger using freshly
ground beef, blue cheese, lettuce, and sweet onions on a homemade sesame seed slider bun. For your 
second slider, you will learn to make a simple pickling solution for onions and cucumbers and a fresh
tomato chutney. These will be served atop a grilled Portobello mushroom open face on a homemade roll. 
You will make plank cut French fries and thinner cut sweet potato fries. To celebrate National 
Chocolate Milkshake Day, you will finish your meal with a creamy chocolate shake.">
								SLIDERS<br> & More! </a></span></strong> </p> </>
      			<img id="octagon1" 
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title=" 
CLASSIC MEXICAN FLAVORS with a Twist:	On September 13th 		10:00am-01:00pm
September 16th is Mexican Independence Day, and to celebrate our Chef/Instructors are offering a twist 
on classic Mexican flavors. You will start your class with a fresh pico de gallo and a choice of baked 
or fried tortilla chips. Next you will make a fresh green tomatillo salsa you can eat with chips, which
 will also serve as the base for a shredded chicken and cheese enchilada. A simple adjustment and you 
can make a cheese enchilada for those who do not eat meat. While your enchiladas are baking, you will 
make refried beans to round out your meal. You will finish your Mexican Independence Celebration with 
Tres Leches Cake.">
								CLASSIC MEXICAN FLAVORS<br> with a Twist </a> </span></strong> </p></>
      			<img id="octagon2" 
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title=" 
OKTOBERFEST! It is Sausage and Beer (must be 21 years old):	On September 18th 06:00pm-09:00pm
September 19th kicks of Oktoberfest and what better way to celebrate then fresh sausages and beer.
Strike up the oompah-pah band and dig out your lederhosen and join us to kick off Oktoberfest. Our
Chef/Instructor will teach you the techniques to making fresh sausages, from grinding your own meat
and picking your seasonings, to choosing and sourcing casings. You will make a beef, a chicken, a 
pork, and a vegetarian sausage. You will create a beer-braised red cabbage with apples and onions 
and round out your meal with homemade spaetzli with a brown butter sauce. There will be different 
beers to taste and pair with your sausages. Prosit!"> 
								OKTOBERFEST!<br> It is Sausage & Beer </a></span></strong> </p></>
      			<img id="octagon4" 
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title=" 
FALL IS IN THE AIR		On October 3rd			12:00pm-03:00pm
Have fun with fall ingredients and new techniques. Master a simple risotto you can start in 
advance before your guests arrive and finish in 10 minutes, just before dinner is served. Use 
your leftover risotto to make risotto balls and freeze as an appetizer for your next party. For 
a twist on the dreaded brussels sprout, a brussels sprout ceasar salad with rosemary-cranberry 
crouton. A simple pork tenderloin stuffed with cranberries and apricots, and glazed with an apple 
cider reduction. We will finish the evening with a simple chocolate pot au creme."> 
								FALL IS IN THE AIR <br> Tasty Fall </a></span></strong> </p></>
      			<img id="octagon3"
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title=" 
PASTA BASICS:  It is all about the Sauce	On September 19th	10:00am-01:00pm
Master the quick meal using pasta, the secret is in the sauce. You will create a slowly simmered 
red sauce which can be frozen and then thawed for a quick week-night meal. This classic marinara 
then becomes the basis for a vodka sauce, a clam sauce, and a simple meat sauce. You will learn 
to make a healthy fresh tomato sauce with vegetables for a simple take on the classic primavera. 
Next, a rich, creamy Alfredo can set the stage for a romantic dinner on date night. You will 
finish your sauce class with a pesto sauce that you can adapt, depending upon the ingredients in 
your pantry.">  
								PASTA BASICS<br> It is all about the Sauce</a></span></strong> </p></>
		</div>

		<div style="float:right;"> 
      			<img id="octagon3"
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title="
PASTA BASICS 101:  Making Fresh Pasta	On Sept 19th(10:00am-1:00pm) & Oct 11th(11:00am-2:00pm)
Create fresh pasta from simple ingredients. You will use a manual and a motorized pasta machine.
You will start your evening with lasagna roll ups. While your fresh dough is resting, you will  
create a basic tomato sauce which becomes a springboard for your own flavor creations. You will 
create spaghetti, tagliatelle, and fettuccine noodles. As your pasta cooks you will turn your   
attention to a classic Alfredo. You will finish your meal with a lemon panna cotta.">
								PASTA BASICS 101<br> Making Fresh Pasta</a></span></strong> </p></> 
   			<img id="octagon3" 
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"> <a href="#" data-toggle="tooltip" title=" 
PASTA BASICS 201: Variations on a Theme	On Sept 26th(12:00pm-3:00pm) & Oct 18th(12:00pm-3:00pm)
You have mastered the basics, now you will step it up a notch. You will start your evening with a 
Caprese salad on a stick with a balsamic drizzle Learn how to make a fresh gnocchi with a walnut 
pesto, fresh ravioli using two different fillings and two different tools, and create a decadent 
pasta al quattro fromaggio using a pasta extruder to make the pasta. You will finish your pasta 
experience with a southern classic simple beef with fresh egg noodles."> 
								PASTA BASICS 201<br>  Variations on a Theme </a> </span></strong> </p></>
 			<img id="octagon5"
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title=" 
HALLOWEEN FOR TWEENS			On October 17th		10:00am-12:00pm
Still working on the recipes and descriptions for this class."> 
								HALLOWEEN<br> FOR TWEENS </a></span></strong> </p></>
 			<img id="octagon5"
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title=" 
HALLOWEEN FOR ADULTS			On October 17th		02:00pm-05:00pm
Still working on the recipes and descriptions for this class">
								HALLOWEEN<br> FOR ADULTS </a></span></strong> </p></>
 			<img id="octagon6" 
			<p> <strong><span style="font-family:; font-size: 10pt; color: black;"><a href="#" data-toggle="tooltip" title=" 
IT IS ALL ABOUT THE GOURD: Are you a Pumpkin Eater? on October 24th	12:00pm-03:00pm
Still working on the recipes and descriptions for this class">
								IT IS ALL ABOUT THE GOURD<br> Are you a Pumpkin Eater?</a></span></strong> </p></>	
		</div>
	</div>




</div>
	






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
    				$m = $_POST['cmonth'];
    				$d = $_POST['cday'];
    				$y = $_POST['cyear'];
   		    		
				$m .= "-";
    				$m .= $d;
    				$m .= "-";
    				$m .= $y;
			}
  
			// was the time entered?
			if (empty($_POST['chour']))
			{
				$errors[] = 'You Did Not Enter the Time.';
			}
			else
			{
    				$hr = $_POST['chour'];
    				$ms = $_POST['cminute'];

		     		$tm .= $hr;
    				$tm .= ":";
    				$tm .= $ms;
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

					//$cdate = date("m");
					//$cdate.= "-";
					//$cdate = date("d");
					//$cdate.= "-";
					//$cdate = date("y");
					$cdate = date("m-d-y");

					$ctime = date("H:i:s"); 
      					$errors2[] = 'Testing!';
					//echo '<h3> Testing1 </h3>';
	
      					$q = "INSERT INTO StudentsIn (StName, StEmail, StNumber, ClassName, ClassDate, ClassTime, RegDate, RegTime, ClassLoc)
	    				VALUES('$Stname', '$Stemail', '$Stnumber', '$classtype', '$m', '$tm', '$cdate', '$ctime', '')";
	
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
            							case 'hotmail'	 : $headers = "From: Dave Matthews<dave@hotmail.com>		\r\n"; 	  break;
            							case 'outlook'	 : $headers = "From: Dave Matthews<dave@outlook.com>		\r\n"; 	  break;
            							case 'live'	 : $headers = "From: Dave Matthews<dave@live.com>		\r\n"; 	  break;
            							case 'gmail'	 : $headers = "From: Dave Matthews<dave@gmail.com>		\r\n"; 	  break;
            							case 'googlemail': $headers = "From: Dave Matthews<dave@googlemail.com>		\r\n"; 	  break;
            							case 'yahoo'	 : $headers = "From: Dave Matthews<dave@yahoo.com>		\r\n"; 	  break;
            							case 'ymail'	 : $headers = "From: Dave Matthews<dave@ymail.com>		\r\n"; 	  break;
            							case 'rocketmail': $headers = "From: Dave Matthews<dave@rocketmail.com>		\r\n"; 	  break;
            							case 'aol'	 : $headers = "From: Dave Matthews<dave@aol.com>		\r\n"; 	  break;
            							case 'talktalk'	 : $headers = "From: Dave Matthews<dave@talktalk.com>		\r\n"; 	  break;
            							default		 : $headers = "From: Dave Matthews<dave@madchefkitchen.com>	\r\n"; 	  break;
        						}


							$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
	      						$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

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

						$message = "Welcome to the MadChefKitchen Family! \r\n";
						$message = "\r\n";
						$message.= "You have registered for the $classtype class\r\n"; 
						$message.= "Date: $m\r\n"; 
						$message.= "Time: $tm\r\n";
						$message.= "One of our MadChefs will contact you with all the details and arrange for payment.\r\n";
						$message.= "We look forward to sharing our kitchen with you.\r\n";
					
						$subject = "Registration Confirmation for the $classtype Class";

						if(mail_utf8($Stemail,'Dave Matthews', 'dave@madchefkitchen.com', $subject, $message))
						{
							echo "Welcome To The MadChefKitchen Family!<br>
							A Confirmation Email Has Been Sent";
							// Call Jenny


							if(mail($Stnumber."messaging.sprintpcs.com", $subject, $message,"From: Dave Matthews <dave@madchefkitchen.com>\r\n"))
							{}
							else
							{ 
								if(mail($Stnumber."sprintpaging.com", $subject, $message,"From: Dave Matthews <dave@madchefkitchen.com>\r\n"))
								{}
							}
								
						}else
						{
							echo "There Was Something Wrong Wit Your Email <br>
							Please Resubmit Your Form";
						}


						$subject = "A New User Registered For The $classtype Class";

						$message = "The new user named $Stname has registered for the $classtype class\r\n";
						$message.= "Date: $m \r\n"; 
						$message.= "Time: $tm \r\n";

						//mail_utf8('dave@madchefkitchen.com','Dave Matthews', 'dave@madchefkitchen.com', $subject, $message);

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

