<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
	if(!isset($_SESSION['user_level']) or $_SESSION['user_level'] == 0){
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang=en>
	<head>
		<title> Edit A Record </title>
		<meta charset=utf-8>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		
		<!-- Custom styles for this template -->
		<link href="sticky-footer-navbar.css" rel="stylesheet">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>	  
	</head>
	
	<body>
		<div class='container'>
			<?php include('mainbar.php'); ?>
			<div class='content'> <!--Start to edit the page content. -->
				<h2> Edit A Record </h2>
				<p>
					<?php
						
						//After clicking the edit link in the found_record.php page, the editing interface appears
						//The code looks for a valid user ID, either through GET or POST
						
						if((isset($_GET['id'])) && (is_numeric($_GET['id']))){ 
							//From View_Users.php
							$id= $_GET['id'];
						}
						else if ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ){ 
							//Form submission
							$id = $_POST['id'];
						}
						else { //if not valid id, stop the script
							echo '<p class="error"> This Page Has Been Accessed In Error</p>';
							include ('footer.php');
							exit();
						}
						
						
						//The link to the database is moved here to the top of the PHP code.
						require('mysqli_connect.php'); //connect to the database.
						//The script performs an INSERT query that adds a record to the users table.
						if($_SERVER['REQUEST_METHOD'] == 'POST') {
							//$errors = array(); // Initialize an error array.
							
							//was the first name entered?
							if (empty($_POST['serialnumber'])){
								//$errors[] = 'You Did Not Enter The Serial Number.';
							}
							else{
								$sn = mysqli_real_escape_string($dbcon, trim($_POST['serialnumber']));
							}
							// was the last name entered?
							if (empty($_POST['org_name'])){
								//$errors[] = 'You Did Not Enter The Organization Name.';
							}
							else{
								$on = mysqli_real_escape_string($dbcon, trim($_POST['org_name']));
							}
							// was the email entered?
							if (empty($_POST['addr1'])){
								//$errors[] = 'You Did Not Enter The Primary Address.';
							}
							else{
								$fa = mysqli_real_escape_string($dbcon, trim($_POST['addr1']));
							}
							
							if (empty($_POST['addr2'])){
								//$errors[] = 'You Did Not Enter The Secundary Address.';
							}
							else{
								$sa = mysqli_real_escape_string($dbcon, trim($_POST['addr2']));
							}
							
							if (empty($_POST['city'])){
								//$errors[] = 'You Did Not Enter The City.';
							}
							else{
								$c = mysqli_real_escape_string($dbcon, trim($_POST['city']));
							}
							
							if (empty($_POST['state'])){
								//$errors[] = 'You Did Not Enter The State.';
							}
							else{
								$s = mysqli_real_escape_string($dbcon, trim($_POST['state']));
							}
							
							if (empty($_POST['zcode'])){
								//$errors[] = 'You Did Not Enter The Zip Code.';
							}
							else{
								$zc = mysqli_real_escape_string($dbcon, trim($_POST['zcode']));
							}
							
							if (empty($_POST['contact_fname'])){
								//$errors[] = 'You Did Not Enter First Name.';
							}
							else{
								$fn = mysqli_real_escape_string($dbcon, trim($_POST['contact_fname']));
							}
							
							if (empty($_POST['contact_lname'])){
								//$errors[] = 'You Did Not Enter Last Name.';
							}
							else{
								$ln = mysqli_real_escape_string($dbcon, trim($_POST['contact_lname']));
							}
							
							if (empty($_POST['email'])){
								//$errors[] = 'You Did Not Enter The Contact Email.';
							}
							else{
								$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
							}
							
							if (empty($_POST['phone'])){
								//$errors[] = 'You Did Not Enter The Contact Phone.';
							}
							else{
								$p = mysqli_real_escape_string($dbcon, trim($_POST['phone']));
							}
							
							if (empty($_POST['delivered'])){
								//$errors[] = 'You Did Not Enter The Delivered Date.';
							}
							else{
								$d = mysqli_real_escape_string($dbcon, trim($_POST['delivered']));
							}
							
							if (empty($_POST['install_loc'])){
								//$errors[] = 'You Did Not Enter The Installing Location.';
							}
							else{
							$il = mysqli_real_escape_string($dbcon, trim($_POST['install_loc']));
							}
							
							if (empty($_POST['soft_build'])){
							//$errors[] = 'You Did Not Enter The Soft Build Type.';
							}
							else{
							$sb = mysqli_real_escape_string($dbcon, trim($_POST['soft_build']));
							}
							
							if (empty($_POST['tab_mak_mod'])){
							//$errors[] = 'You Did Not Enter The TMMod.';
							}
							else{
							$tmm = mysqli_real_escape_string($dbcon, trim($_POST['tab_mak_mod']));
							}
							
							if (empty($_POST['op_sys'])){
							//$errors[] = 'You Did Not Enter The Operating System.';
							}
							else{
							$os = mysqli_real_escape_string($dbcon, trim($_POST['op_sys']));
							}
							
							if (empty($_POST['master_subor'])){
							//$errors[] = 'You Did Not Enter The Master Subor.';
							}
							else{
							$ms = mysqli_real_escape_string($dbcon, trim($_POST['master_subor']));
							}
							
							if (empty($_POST['mount'])){
							//$errors[] = 'You Did Not Enter The Mount Type.';
							}
							else{
							$m = mysqli_real_escape_string($dbcon, trim($_POST['mount']));
							}
							
							if (empty($_POST['doors'])){
							//$errors[] = 'You Did Not Enter The Number Of Doors.';
							}
							else{
							$ds = mysqli_real_escape_string($dbcon, trim($_POST['doors']));
							}
							
							if (empty($_POST['active'])){
							//$errors[] = 'You Did Not Enter Yes Or Not.';
							}
							else{
							$a = mysqli_real_escape_string($dbcon, trim($_POST['active']));
							}
							
							if (empty($_POST['notes'])){
							//$errors[] = 'You Did Not Enter Any Note.';
							}
							else{
							$n = mysqli_real_escape_string($dbcon, trim($_POST['notes']));
							}
							
							//Start of the SUCCESSFUL SECTION. i.e all the fields were filled out.
							if( empty($errors)) { //If no problems encountered, register user in the database
								//make the query
								//check that the email is not already in the users table
								$q = "UPDATE chargedad SET 
								serialnumber='$sn' OR org_name=$on OR addr1=$fa OR addr2=$sa OR city=$c OR state=$s 
								OR zcode=$zc OR contact_fname=$fn OR contact_lname=$ln OR email=$e OR phone=$p OR delivered=$d 
								OR install_loc=$il OR soft_build=$sb OR tab_mak_mod=$tmm OR op_sys=$os OR master_subor=$ms 
								OR mount=$m OR doors=$ds OR active=$a OR notes=$n WHERE id = $id";
								$result = @mysqli_query ($dbcon, $q);
								
								if($result) {//If it ran ok.
								
									if (mysqli_affected_rows($dbcon) == 1){
									
										//If it ran OK
										//Echo a message if the edit was satisfactory
										echo '<h3> The User Has Been Edited. </h3>';								
									}
									else { // If the email address is already registered								
										echo '<p class="error"> The email address has already been registered. </p>';
									}
								} else { //echo a message if the query failed
									
										echo '<p class="error"> The User Could Not Be Edited Due To A System Error..
										We Apologize For The Inconvenience.</p>'; // Error Message.
										echo '</p>'.mysqli_error($dbcon).'<br />Query: '.$q.'</p>'; //Debugging Message.
								}
														
								mysqli_close($dbcon); //Close the database connection.
								// Include the footer and wuit the script:
								include ('footer.php');
								exit();
							} else{ //Display the errors
								echo '<h2> Error! </h2>
								<p class="error"> The following error(s) occurred:<br>';
								foreach ($errors as $msg) { //Print each error.
								echo " - $msg<br>\n";
								}
								echo '</p><h3>Please Try Again.</h3><p><br></p>';
							} //End of if (empty($errors))IF.
						}//End of the main Submit Conditional
						
						//select the record
						$q = "SELECT * FROM chargedad WHERE id=$id";
						$result = @mysqli_query($dbcon, $q);
						
						if(mysqli_num_rows($result) == 1) { // Valid user ID, display the form.
							// Get the user's information
							$row = mysqli_fetch_array ($result, MYSQLI_NUM);
							//Create the form
							echo '<form action="edit_CDrecord.php" method="post">
							
							<p><label for="serialnumber">Serial Number:</label>
							<input class="fl-left" id="serialnumber" type="text" name="serialnumber" size="30" maxlength="30" 
							value="'.$row[1].'">
							<p>
							<label for="org_name">Organization Name:</label>
							<input class="fl-left" type="text" name="org_name" size="30" maxlength="40"
							value="'.$row[2].'">
							</p>
							
							<p>
							<label  for="addr1">Contact Primary Address:</label>
							<input class="fl-left" type="text" name="addr1" size="30" maxlength="60"
							value="'.$row[3].'">
							</p>
							
							<p>
							<label  for="addr2">Contact Secundary Address:</label>
							<input class="fl-left" type="text" name="addr2" size="30" maxlength="60"
							value="'.$row[4].'">
							</p>
							
							<p>
							<label  for="city">City:</label>
							<input class="fl-left" type="text" name="city" size="30" maxlength="60"
							value="'.$row[5].'">
							</p>
							
							<p>
							<label  for="state">State:</label>
							<input class="fl-left" type="text" name="state" size="30" maxlength="60"
							value="'.$row[6].'">
							</p>
							
							<p>
							<label  for="zcode">Zip Code:</label>
							<input class="fl-left" type="text" name="zcode" size="30" maxlength="60"
							value="'.$row[7].'">
							</p>
							
							<p>
							<label for="contact_fname">Contact First Name:</label>
							<input class="fl-left" type="text" name="contact_fname" size="30" maxlength="60"
							value="'.$row[8].'">
							</p>
							
							<p>
							<label for="contact_lname">Contact Last Name:</label>
							<input class="fl-left" type="text" name="contact_lname" size="30" maxlength="60"
							value="'.$row[9].'">
							</p>
							
							<p>
							<label for="email">Contact Email Address:</label>
							<input class="fl-left" type="text" name="email" size="30" maxlength="60"
							value="'.$row[10].'">
							</p>
							
							<p>
							<label  for="phone">Contact Phone Number:</label>
							<input class="fl-left" type="text" name="phone" size="30" maxlength="60"
							value="'.$row[11].'">
							</p>
							
							<p>
							<label  for="delivered">Delivered Date:</label>
							<input class="fl-left" type="text" name="delivered" size="30" maxlength="60"
							value="'.$row[12].'">
							</p>
							
							<p>
							<label  for="install_loc">Install Location:</label>
							<input class="fl-left" type="text" name="install_loc" size="30" maxlength="60"
							value="'.$row[13].'">
							</p>
							
							<p>
							<label for="soft_build">Soft Build Material:</label>
							<input class="fl-left" type="text" name="soft_build" size="30" maxlength="60"
							value="'.$row[14].'">
							</p>
							
							<p>
							<label for="tab_mak_mod">Tablet Brand:</label>
							<input class="fl-left" type="text" name="tab_mak_mod" size="30" maxlength="60"
							value="'.$row[15].'">
							</p>
							
							<p>
							<label for="op_sys">Operating System:</label>
							<input class="fl-left" type="text" name="op_sys" size="30" maxlength="60"
							value="'.$row[16].'">
							</p>
							
							<p>
							<label for="master_subor">Master or Subornate:</label>
							<input class="fl-left" type="text" name="master_subor" size="30" maxlength="60"
							value="'.$row[17].'">
							</p>
							
							<p>
							<label for="mount">Mount Type:</label>
							<input class="fl-left" type="text" name="mount" size="30" maxlength="60"
							value="'.$row[18].'">
							</p>
							
							<p>
							<label for="doors">Doors Number:</label>
							<input class="fl-left" type="text" name="doors" size="30" maxlength="60"
							value="'.$row[19].'">
							</p>
							
							<p>
							<label for="active">Active Mode:</label>
							<input class="fl-left" type="text" name="active" size="30" maxlength="60"
							value="'.$row[20].'">
							</p>
							
							<p>
							<label for="notes">Notes:</label>
							<input class="fl-left" type="text" name="notes" size="30" maxlength="60"
							value="'.$row[21].'">
							</p>
							
							
							<button class="btn btn-default" id="submit" type="submit" name="submit" value="edit">Confirm</button>
							
														
							<input type="hidden" name="id" value="'. $id .'"/>
							
							<a href="chargedaddyForm.php">Cancel</a>
													
							</form>';
						} else { //The record could not be validated
							echo '<p class="error"> This Page Has Been Accessed In Error</p>';
						}
						mysqli_close($dbcon); // Close the datqabase connection.
						//<!-- End of the page content. -->
						
					?>
				</p>
			</div>
		</div>
		<?php include ('footer.php');?>
	</body>
</html>						