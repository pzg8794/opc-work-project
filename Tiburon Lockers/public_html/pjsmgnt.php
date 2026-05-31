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
        /* calendar */
    table.calendar		{ border-left:1px solid #999; }
    tr.calendar-row	{  }
    td.calendar-day	{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
    td.calendar-day:hover	{ background:#eceff5; }
    td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
    td.calendar-day-head { background:#ccc; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
    div.day-number		{ background:#999; padding:5px; color:#fff; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }
    /* shared */
    td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }
    
    
  </style>
</head>
  
<body>
  <div id='container'>
    <?php include('pnav.php'); ?>
    <div id='content'>
      <!--Start of the view_users_page content. -->
      <h2> Projects Management </h2>
      <h3 class="red"> Create New Projects or Follow Up on a Project </h3>
     <h4>

      </h4>
      <?php include("footer.php"); ?>
    </div>
  </div>
</body>
</html>