<?php
if(session_status() == PHP_SESSION_NONE){
  session_start();
}

//If no session variable exist then redirect the user
if (!isset($_SESSION['user_id'])){
	header("Location: index.php");
	exit();
//Cancel session and redirect user
}
else{ //Cancel The Session
   $_SESSION = array(); //Destroy the variables.
   session_destroy();   //Destroy the session.
  setcookie('PHIPSESSID', ", time()-3600, '/', ", 0, 0); //Destroy the cookie
  header("location: index.php");
  exit();
}
?>