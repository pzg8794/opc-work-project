<?php
session_start();
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) {
	header("Location: login.php");
	exit();
}
?>

<!doctype html>
<html lang=en>
	<head>
		<title> Administrator View-Members Page</title>
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
		<div class="container">
		
			<?php include('mainbar.php'); ?>

			<div id="content"><!--Start of the view_users_page content. -->

				<h2> These are the Registered Users </h2>
				<p>
				<?php
					//This script retrives all the records from the users table.
					require('mysqli_connect.php'); //Connect to the database.

					//Set The Number of Rows Per Display Page
					$pagerows = 25;

					//Has the total number of pages already been calculated?
					if(isset($GET['p']) && is_numeric($_GET['p'])){
						//Already been calculated
						$pages = $_GET['p'];
					}
					else { //Use the next block of code to calculate the number of pages
						//First, check for the total number of records
						$q = "SELECT COUNT(user_id) FROM users";
						$result = @mysqli_query ($dbcon, $q);
						$row = @mysql_fetch_array($result, MYSQLI_NUM);
						$records = $row[0];

						//Now Calculate The Number of Pages 
						if($records > $pagerows){ //If the number of records will fill more than one page
						//Calculate the number of pages and Round the Result Up to the nearest integer
						$pages = ceilt($record/$pagesrows);
						}
						else {
							$pages = 1;
						}
					}//page check finished

					//Declare which record to start with
					if(isset($_GET['s']) && is_numeric($_GET['s'])){
						//already been calculated
						$start = $_GET['s'];
					}
					else{
						$start = 0;
					}

					//Make the query.
					$q = "SELECT lname, fname, email, DATE_FORMAT(registration_date, '%M %d, %Y') 
					AS regdat, user_id FROM users ORDER BY registration_date ASC LIMIT $start, $pagerows";
					$result = @mysqli_query ($dbcon, $q); // Run the query.
					$members = mysqli_num_rows($result);

					if ($result) { // If it ran OK, display the records.
						//Tablet Header
						echo '<table class="table">
						<tr>
						<td><b>Edit</b></td>
						<td><b>Delete</b></td>
						<td><b>Last Name</b></td>
						<td><b>First Name</b></td>
						<td><b>Email</b></td>
						<td><b>Date Registered</b></td></td>
						</tr>';
						// Fetch and print all the records:

						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							echo '<tr>
							<td><a href="edit_record.php?id='.$row['user_id'] . '">Edit</a></td>
							<td><a href="delete_record.php?id='.$row['user_id'].'">Delete</a></td>
							<td>'.$row['lname'].'</td>
							<td>'.$row['fname'].'</td>
							<td>'.$row['email'].'</td>
							<td>'.$row['regdat'].'</td>
							</tr>';
						}
						echo '</table>'; // Close the table so that it is ready for displaying.
						mysqli_free_result($result); // Free up the resources.
					}
					else { // If it did not run ok.
						//Error Message
						echo '<p class="error"> The Current Users Could Not Be Retrieved. We Apologize for the Inconvinience.</p>';
						// Debug message:
						echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
					}//End of if($result)

					//Now display the figure for the total number of records/members
					$q = "SELECT COUNT(user_id) FROM users";
					$result = @mysqli_query ($dbcon, $q);
					$row = @mysqli_fetch_array ($result, MYSQLI_NUM);
					$members = $row[0];
					mysqli_close($dbcon); // Close the datqabase connection.
					echo "<p> Total membership: $members</p>";

					if ($pages > 1){
						echo '<p>';
						//What number is the current page?
						$current_page = ($start/pagerows)+1;

						//If the page is not the first page then create a Previous link
						if($current_page != 1){
						echo '<a href="register-view_users.php?s='.($start-$pagerows).
						'&p='.$pages.'">Previous</a>';
						}
						//Create a Next Link
						if($current_page != $pages){
						echo'<a href="register-view_users.php?s='.(start + $pagerows).'&p='.$pages.'">Next</a>';
						}
						echo '</p>';
					}
				?>
				</p>
			</div><!-- End of the User's Table Page Content -->	
		</div>
	<?php include("footer.php"); ?>
	</body>
</html>