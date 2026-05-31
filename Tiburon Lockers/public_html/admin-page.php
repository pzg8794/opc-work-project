<?php
if(session_status() == PHP_SESSION_NONE){
  session_start();
}

if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)){
  header("Location: login.php");
  exit();
}
?>

<!doctype html>
<html lang="en">
<head>
  <title>Admin Page</title>
  <meta charset=utf-8>
  <link rel="stylesheet" type="text/css" href="includes.css">
	<Style type"text/css">
		#midcol {
      width:98%;
    }
    #midcol p {
      margin-left: 160px;
    }
	</style>
</head>

  <body>
    <div id='container'>
      
      <?php include('admin-nav.php'); ?>
     
      <div id='content'><!--Start of page content. -->

	  <?php
		//echo '<h2> <br> </h2>';
	    echo '<h2> Welcome To The Admin\'s Page ';
		if( isset($_SESSION['fname'])){
			echo "{$_SESSION['fname']}";
		}
		echo '</h2>';
	  ?>

        <div id= "midcol">
          <h3> You Have Permission To: </h3>
          <p>&#9632; Edit And Delete A Record.</p>
          <p>&#9632; Use The View Members Button To See A Table Of Registered Members.</p>
          <p>&#9632; Use The Search Button To Locate A Particular Member.</p>
          <p>&#9632; Use The Addresses Button To Locate a Member's Address And Phone Number.</p>
          </p>&nbsp;</p>
        </div>
</div>
  <?php include ('footer.php'); ?></p>
</div>
</body>
</html>  