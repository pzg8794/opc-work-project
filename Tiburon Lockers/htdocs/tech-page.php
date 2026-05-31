<?php
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 2))
{  header("Location: login.php");
   exit();
}
?>
<!doctype html>
<html lang=en>
<head>
<title>Maintenance</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
<style type="text/css">
#mid-right-col { text-align:center; margin:auto;
}
#midcol h3 { font-size:130%; margin-top:0; margin-bottom:0;
}
</style>
</head>
<body>
<div id="container">
<?php include("includes/header-tech.php"); ?>
	<div id="content"><!-- Start of The Techs page content. -->
<?php
echo '<br><h2>Welcome ';
if (isset($_SESSION['fname'])){
echo "{$_SESSION['fname']}";
}
echo '</h2>';
?>
<div id="midcol">
<div id="mid-left-col">
<br><h3>Need tool bar here</h3>
</div>
</div></div><!-- End of The Tech page content. -->
</div>	
<?php include('includes/footer.php'); ?></body>
</html>