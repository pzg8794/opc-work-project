<?php
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0))
{  header("Location: header-sales.php");
   exit();
}
?>
<!doctype html>
<html lang=en>
<head>
<title>Sales View page</title>
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
<?php include("includes/header-sales.php"); ?>

<div id="content"><!-- Start of the member's page content. -->

<?php
echo '<br><h2>Welcome ';
if (isset($_SESSION['fname'])){
echo "{$_SESSION['fname']}";
}
echo '</h2>';
?>
<p><a href="view_all_records.php">List All</a>&nbsp;
	<a href="search.php">Search</a></p>

<h3>toolbar goes here</h3>
<p>The Members' page content. The Members' page content. The Members' page content.<br>
The Members' page content. The Members' page content. The Members' page content.<br>
The Members' page content. The Members' page content. The Members' page content.<br>
The Members' page content. The Members' page content. The Members' page content.</p>

</div><!-- content -->
</div><!-- container -->
<?php include('includes/footer.php'); ?></body>
</html>
