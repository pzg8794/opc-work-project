<!doctype html>
<html lang=en>
<head>
<title>View users page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="tstyle.css">
</head>
<body>
<div id="container">
<?php include("header.php"); ?>
<?php include("info-col.php"); ?>
<div id="content"><!-- Start of the page-specific content. -->
<h2>These are the registered users</h2>
<p>
<?php 
// This script retrieves all the records from the users table.
require ('mysqli_connect.php'); // Connect to the database.
// Make the query:
$q = "SELECT SerialNumber AS sernum, 
      DATE_FORMAT(Delivered, '%M %d, %Y') AS datedel, 
      SoftwareBuild AS softb,
      TabletMakeModel AS tabmm,
      OS AS opsys,
      MasterSlave AS masl,
      Mount AS mt,
      Doors AS drs,
      Active AS av,
      Customer AS cu,
      Location AS lo,
      Notes AS nts
FROM chargedaddy ORDER BY SerialNumber ASC";		
$result = @mysqli_query ($dbcon, $q); // Run the query.
if ($result) { // If it ran OK, display the records.
// Table header.
echo '<table>
<tr><td><b>Serial Number</b></td><td><b>Date Delivered</b></td><td><b>Software Build</b></td><td><b>Tablet Make &amp; Model</b></td>
    <td><b>Operating System</b></td><td><b>Master or Subordinate</b></td><td><b>Mount Type</b></td><td><b>Doors</b></td>
    <td><b>Active</b></td><td><b>Customer</b></td><td><b>Location</b></td><td><b>Notes</b></td></tr>';
// Fetch and print all the records:
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	echo '<tr><td>' . $row['sernum'] . '</td>
        <td>' . $row['datedel'] . '</td>
        <td>' . $row['softb'] . '</td>
        <td>' . $row['tabmm'] . '</td>
        <td>' . $row['opsys'] . '</td>
        <td>' . $row['masl'] . '</td>
        <td>' . $row['mt'] . '</td>
        <td>' . $row['drs'] . '</td>
        <td>' . $row['av'] . '</td>
        <td>' . $row['cu'] . '</td>
        <td>' . $row['lo'] . '</td>
        <td>' . $row['nts'] . '</td></tr>';
	}
	echo '</table>'; // Close the table.
	mysqli_free_result ($result); // Free up the resources.	
} else { // If it did not run OK.
// Public message:
	echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';
	// Debugging message:
	echo '<p>' . mysqli_error($dbcon) . '<br><br />Query: ' . $q . '</p>';
} // End of if ($r) IF.
mysqli_close($dbcon); // Close the database connection.
?>
</p>
</div><!-- End of the page-specific content. -->
<?php include("footer.php"); ?>
</div>
</body>
</html>