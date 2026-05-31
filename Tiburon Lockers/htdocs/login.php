<!doctype html>
<html lang=en>
<head>
<title>Home Page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
<div id="container">
<?php 
session_start();
include("includes/header.php"); 
echo '<p class="error">test</p>';
 Print_r ($_SESSION);
?>

	<div id="content"><!-- Start of the home page content-->
<h2>file login</h2>
<div id="mid-left-col">
<p>The home page content. The home page content. The home page content. The home page content. The home page content. <br>The home page content. The home page content. The home page content. The home page content. <br>The home page content. The home page content. <br>The home page content. The home page content. The home page content. </p>
</div>
<div id="mid-right-col">
<p>Become a member and support our cause</p>
</div>	<!-- End of the home page content. --></div>
</div>	
<?php include("includes/footer.php"); ?>

</body>
</html>