<?php
if(session_status() == PHP_SESSION_NONE){
  session_start();
}

//if one database row (record) matches the input: start the session,
// fetch the record and insert the three values in a array

if(empty($_SESSION['user_id'])){
 // exit(); 
}
else {

 if( $_SESSION['user_level']!= 1){
    header("Location: chargedaddyForm.php");
    exit();
  }
}
?>
<!doctype html>
<html lang=en>

<head>
<title>Search page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">

  <style type ="text/css">
    h3.red {
    color:red;
    font-size:105%;
    font-weight:bold;
    text-align:center;
    }

    h4{
    text-align: center;
    }

    h{
    position:absolute; bottom:230px; right:50px; color:navy; width:666px; text-align:center;
    margin:5px auto 0;
    }
  </style>
</head>
  
<body>
  <div id='container'>
    <?php include('nav1.php'); ?>
    <div id='content'>
      <!--Start of the view_users_page content. -->
      <h2> Search For A Record </h2>
      <h3 class="red"> Please Choose A Database To Search </h3>
      
     <h4>
        <br>
          <select name="Database" onchange="window.location=this.value">
            <option value = 'search.php'> Select Database From This List </option>
            <option value = 'chargedaddyForm.php'> ChargeDaddy </option>
            <option value = 'usersForm.php'> Users </option>
          </select>
          
        </br>
      </h4>
      <?php include("footer.php"); ?>
    </div>
  </div>
</body>
</html>