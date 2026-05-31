<?php
/**
	Template Name: testpage
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Form</title>

		<style type ="text/css">
			@import http://fonts.googleapis.com/css?family=Raleway;
			/*----------------------------------------------
			CSS Settings For HTML Div ExactCenter
			------------------------------------------------*/
			#main 
			{
				width:100%;
				font-family:raleway;
			}

			span 
			{
				color:red
			}
			
			h2 
			{
				background-color:#FEFFED;
				text-align:center;
				border-radius:10px 10px 0 0;
				margin:-10px -40px;
				padding:15px
			}

			hr 
			{
				border:0;
				border-bottom:1px solid #ccc;
				margin:10px -40px;
				margin-bottom:30px;
			}

			#login 
			{
				width:300px;
				float:center;
				border-radius:10px;
				font-family:raleway;
				border:2px solid #ccc;
				padding:10px 40px 25px;
				margin-top:70px;
			}

			input
			{
				width:100%;
				padding:10px;
				margin-top:8px;
				border:1px solid #ccc;
				padding-left:5px;
				font-size:16px;
				font-family:raleway;
			}

			#log 
			{
				width:100%;
				background-color:#FFBC00;
				color:#fff;
				border:2px solid #FFCB00;
				padding:10px;
				font-size:20px;
				cursor:pointer;
				border-radius:5px;
				margin-bottom:15px
			}

			a 
			{
				text-decoration:none;
				color:#6495ed;
			}
			
			i 
			{
				color:#6495ed;
			}
		</style>
		<?php
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
	</head>

	<body>
	
			<h1> Management Login for MCK Employees </h1>
			
	<div style="float:left">
			<div id="main">
			<div id="login">
				<h2>Login Form</h2>
				<form name="mngmnt" method="post" id="mngmnt" action="<?php echo $PHP_SELF;?>">
					<label>UserName :</label>
					<input type="text"required id="name" name="username" placeholder="username" type="text">
					<label>Password :</label>
					<input type="password"required id="password" name="password" placeholder="**********" type="password">
					<input id="log" name="action" type="submit" value="LOGIN">
				</form>
			</div>
		</div>
		<?php
		
		if(isset($_POST['action']) && $_POST['action'] == 'LOGIN') {
			session_start(); // Starting Session
			$error=array(); // Variable To Store Error Message
			if($_SERVER['REQUEST_METHOD'] == 'POST') 
			{
				if (empty($_POST['username'])) 
				{
					$error[] = "You Did not Enter Your Username";
				}
				
				if (empty($_POST['password'])) 
				{
					$error[] = "You Did not Enter Your Password";
				}
				
				if(empty($error))
				{
					// Define $username and $password
					$username=$_POST['username'];
					$password=$_POST['password'];
					// To protect MySQL injection for Security purpose
					$username = stripslashes($username);
					$password = stripslashes($password);
					$username = mysqli_real_escape_string($dbcon, trim($username));
					$password = mysqli_real_escape_string($dbcon, trim($password));
					// SQL query to fetch information of registerd users and finds user match.
					$query = "SELECT * FROM Employees where password='$password' AND username='$username'";
					$rs =@mysqli_query($dbcon, $query);
					$rows = mysqli_num_rows($rs);	//Run the query and assign it to the variable result
					if ($rows == 1) 
					{
						echo "You Have Login Successfully!";
						$_SESSION['login_user']=$username; // Initializing Session
						header("location: mngmntmenu"); // Redirecting To Other Page					
					} 
					else 
					{
						echo "Username or Password is invalid";
					}
					mysqli_close($dbcon); //Close the database connection.
				}
				else
				{	
					$error[] = 'Sorry! <br> The Email $eEmail Is Not In Our DATABASE
					<br> Please, contact our <a style="color:red" href="http://madchefkitchen.com/contact-us/">IT department</a>';
					//Display the errors
					echo '<h2> Error! </h2>
					<p class="error"> The following error(s) occurred:<br>';
	
					foreach ($error as $msg) 
					{ //Print each error.
						echo " - $msg<br>";
					}
					echo '</p><h3>Please Try Again.</h3>';
				} //End of if (empty($errors))IF.
			}
		}
		?>
	</div>
	
	<div style="float:right">
			<div id="main">
			<div id="login">
				<h2>Creat Account</h2>
				<h2 style="margin-top:-10%;font-size:10px; color:red"> Only for MadChefKitchen Employees!</h2>
				<form name="mngmnt" method="post" id="mngmnt" action="<?php echo $PHP_SELF;?>">
					<label>Employee Email :</label>
					<input type="text"required id="name" name="eEmail" placeholder="Employee's Email" type="email">
					<label>Employee's Name :</label>
					<input type="text"required id="name" name="eName" placeholder="Employee's Name" type="text">
					<label>UserName :</label>
					<input type="text"required id="name" name="username" placeholder="username" type="text">
					<label>Password :</label>
					<input type="password"required id="password" name="password" placeholder="**********" type="password">
					<input id="log" name="action" type="submit" value="SIGNIN">
				</form>
			</div>
		</div>
		
		<?php
		
		if(isset($_POST['action']) && $_POST['action'] == 'SIGNIN') {
        // Form 2
			session_start(); // Starting Session
			$errors= array(); // Variable To Store Error Message
			if($_SERVER['REQUEST_METHOD'] == 'POST') 
			{
				if (empty($_POST['eEmail'])) 
				{
					$error[] = "You Did Not Enter Your Email!";
				}
				
				if (empty($_POST['eName'])) 
				{
					$error[] = "You Did Not Enter Your Name!";
				}
				
				if (empty($_POST['username'])) 
				{
					$error[] = "You Did not Enter Your Username";
				}
				
				if (empty($_POST['password'])) 
				{
					$error[] = "You Did not Enter Your Password";
				}
				
				if(empty($errors))
				{
					//echo "TEST 1<br>";
					$email= $_POST['eEmail'];
					// SQL query to fetch information of registerd users and finds user match.
					$query = "SELECT * FROM Employees WHERE eEmail='$email'";
					$rs = @mysqli_query($dbcon, $query);
					$rows = mysqli_num_rows($rs);	//Run the query and assign it to the variable result
					if($rows == 1)
					{
						//echo "TEST 2<br>";
						// Define $username and $password
						$eName = $_POST['eName'];
						$username=$_POST['username'];
						$password=$_POST['password'];
						// To protect MySQL injection for Security purpose
						$username = stripslashes($username);
						$password = stripslashes($password);
						$username = mysqli_real_escape_string($dbcon, trim($username));
						$password = mysqli_real_escape_string($dbcon, trim($password));
							
						// SQL query to fetch information of registerd users and finds user match.
						$query1 = "SELECT username, password FROM Employees WHERE eEmail='$email'";
						$rs1  = @mysqli_query($dbcon, $query1);	//Run the query and assign it to the variable result
						$row = mysqli_fetch_assoc($rs1);
						//echo $row['username'];
						//echo $row['password'];
						
						if(empty($row['username']) && empty($row['password']))	
						{
							//echo "TEST 3<br>";
							// SQL query to fetch information of registerd users and finds user match.
							$q = "UPDATE Employees SET eName='$eName', username='$username', password='$password' WHERE eEmail='$email'";
						    $rs2   = @mysqli_query($dbcon, $q);	//Run the query and assign it to the variable result	
						
							if($rs2)
							{	
								echo "You Have Login Successfully!";
								$_SESSION['login_user']=$username; // Initializing Session
								header("location: mngmntmenu"); // Redirecting To Other Page					
							}
							else
							{ 	// if the form handler or database table contained errors
		    					//display an error message
								echo '<label> Registration was not Successful </label>';

			    				echo '<h2> System Error </h2>
			    				<p class="error"> Sorry, Your Registration Was not Possible Due To A System Error.
							    <br>Please Try Again Later.</p>';
	
				    			//Debug the message:
				    			echo '<p>' . mysqli_error($dbcon). '<br><br>Query: ' . $q . '</p>';
	
			    			}//End of if clause($result).   		
							// Free result set
							mysqli_free_result($rs1);							
							mysqli_close($dbcon); //Close the database connection.
							exit();
						}				
						else
						{	
							echo 'This User Account Was Already Setup <br> Please, Contact <a style="color:red" href="http://madchefkitchen.com/contact-us/">IT For Support</a>';
						}
					}
					else
					{			
						echo "Sorry! <br> The Email $email Is Not In Our DATABASE
						<br> Please, contact our <a style='color:red' href='ttp://madchefkitchen.com/contact-us/'>IT department</a>.";
						//Display the errors
					} 
				}
				else
				{
					echo '<h2> Error! </h2>
						<p class="error"> The following error(s) occurred:<br>';
	
						foreach ($errors as $msg) 
						{ //Print each error.
							echo " - $msg<br>\n";
						}
						echo '</p><h3>Please Try Again.</h3>';
				}//End of if (empty($errors))IF.
			}   		
			// Free result set
			mysqli_free_result($rs1);	
			mysqli_close($dbcon); //Close the database connection.
		}
		?>
	</div>
	</body>
</html>