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

    <title>Search page</title>

    <meta charset="utf-8">

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

        <h2> Search For A Record In The Users Database </h2>

        <h3 class="red"> Both Names Are Required Items</h3>





        <form action="view_found_record.php" method="post">



          <p>

            <label class="label" for="fname">First Name:</label>

            <input id="fname" type="text" name="fname" size="30" maxlength="30"

                   value=""

                 <?php 

                    if (isset($_POST['fname'])){ 

                         echo $_POST['fname']; 

                    }

                 ?>">

          </p>



          <p>

            <label class="label" for="lname">Last Name:</label>

            <input id="lname" type="text" name="lname" size="30" maxlength="40"

            value=""

                 <?php 

                    if (isset($_POST['lname'])) 

                        echo $_POST['lname']; 

                 ?>">

          </p>



          <b>

            <input id="submit" type="submit" name="submit" value="Search">

        </b>



        </form>

        <?php include("footer.php"); ?>

        <!-- End of the page content. -->

      </div>

    </div>

  </body>

</html>