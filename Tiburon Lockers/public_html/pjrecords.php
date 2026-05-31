<?php
session_start();
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)){
  header("Location: login.php");
  exit();
}
?>
<!doctype html>
<html lang="en">

  <head>
    <title> Administrator View-Members Page</title>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="includes.css">
  </head>

  <body>
    <div id='container'>
      <?php include('nav1.php'); ?>
      <div id='content'>
        <!--Start of the view_users_page content. -->

        <h2> List of Projects Assigned </h2>
        <p>
          <?php
//This script retrives all the records from the users table.
require('mysqli_connect.php'); //Connect to the database.


//Make the query.
$q = "SELECT * FROM cdprojects ORDER BY id";
$result = @mysqli_query ($dbcon, $q); // Run the query

if ($result) { // If it ran OK, display the records.
		echo '<table>
	  <tr>
    <td><b>Edit</b></td>
    <td><b>Delete</b></td>
    <td><b>id</b></td>
    <td><b>File</b></td>
    <td><b>Share</b></td>
    <td><b>Priority</b></td>
    <td><b>Done</b></td>
    <td><b>Project</b></td>
    <td><b>Assigned</b></td></td>
    <td><b>Status</b></td></td>
    <td><b>Start</b></td></td>
    <td><b>End</b></td></td>
    <td><b>Comments</b></td></td>
    <td><b>Level</b></td></td>
    </tr>';
	 // Fetch and print all the records:
	
	  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	  	echo '<tr>
      <td><a href="edit_record.php?id='.$row['id'] . '">Edit</a></td>
      <td><a href="delete_record.php?id='.$row['id'].'">Delete</a></td>
      <td>'.$row['id'].'</td>
      <td><a href="edit_record.php?id='.$row['id'] . '">File</a></td>
      <td><a href="delete_record.php?id='.$row['id'].'">Share</a></td>
      <td>'.$row['priority'].'</td>
      <td>'.$row['done'].'</td>
      <td>'.$row['project_name'].'</td>
      <td>'.$row['assignedTo'].'</td>
      <td><a href="delete_record.php?id='.$row['id'].'">Status</a></td>
      <td>'.$row['start'].'</td>
      <td>'.$row['end'].'</td>
      <td>'.$row['comments'].'</td>
      <td>'.$row['proj_level'].'</td>
      </tr>';
	}
		echo '</table>'; // Close the table so that it is ready for displaying.
		mysqli_free_result($result); // Free up the resources.
}
else{ // If it did not run ok.
	//Error Message
	echo '<p class="error"> The Current Users Could Not Be Retrieved. We Apologize for the Inconvinience.</p>';
	// Debug message:
	echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
}//End of if($result)

mysqli_close($dbcon); // Close the datqabase connection.
?>
        </p>
      </div>
      <!-- End of the User's Table Page Content -->
      <?php include("footer.php"); ?>
    </div>
  </body>
</html>