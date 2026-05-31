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
      <?php include('nav1.php');?>
      <div id='content'>
        <!--Start of the view_users_page content. -->
        <h2> Search For A Record In The ChargeDaddy Database </h2>
        <h3 class="red"> Please Insert Below Either the Name, Zip-Code Or Name Of The Company Below </h3>

        <form action="view_found_CDrecord.php" method="post">

          <p>
            <label class="label" for="search">General Search:</label>
            <input id="search" type="text" name="search" size="30" maxlength="30"
                   value=""
                 <?php 
                    if (isset($_POST['search'])){ 
                         echo $_POST['seach']; 
                    }
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