<?php
//if one database row (record) matches the input: start the session,
// fetch the record and insert the three values in a array

if(session_status() == PHP_SESSION_NONE){
  session_start();
}

$url = 'header.php';

if(empty($_SESSION['user_id'])){
 //exit(); 
}
else {

  if(( $_SESSION['user_level'])== 1)
    $url = 'admin-nav.php';
  else
    $url = 'member-nav.php';
}

?>

<!doctype html>
<html lang=en>

<head>
<title>template for an interactive web page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
</head>
  
<body>
<div id='container'>
<?php include($url);?>
<div id='content'><!--Start of page content. -->
  <h2> This is a private website, exclusively for Tiburon Lockers's Employees </h2>
         <h3> Some functions in this website are still under construction </br>
              Sorry for the inconvenience </h3>

</div>
</div>
<?php include('footer.php'); ?>
</body>
</html> 