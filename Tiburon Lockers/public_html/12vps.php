
<!DOCTYPE html PUBtdC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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

        @charset "utf-8";
        /* CSS Document */

        html {
        margin-bottom: 1px;
        min-height: 100%;
        }

        #menu {
        width:15%; float:left; text-align:left;
        }

        #page {
        width:80%; float:right; text-align:left;
        }

        p{
        margin: 10px 0px;
        line-height: 17px;
        }

        img {
        height: 100px;
        }

        img:hover {
        height: 300px;
        }

        th{
        width: 300px;
        text-align: left;
        font-size: 18px;
        }

        td{
        width: 300px;
        text-align: center;
        font-size: 16px;
        }


        h5{
        font-size: 14px;
        font-weight: bold;
        color: navy;
        line-height: 22px;
        margin: 0px 0px -10px 0px;
        text-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
        }

        h6{
        font-size: 10px;
        font-weight: bold;
        color: navy;
        line-height: 20px;
        margin: 0px 0px -10px 0px;
        text-shadow: 0px 1px 1px rgba(0, 0, 0, .2);
        }

      </style>
    </head>

  <body>
    <div id='container'>

      <?php include('nav2.php'); ?>
      <div id='content'>
        <!--Start of the view_users_page content. -->
        <h2>
          <a id="12vpower">12V Power supply</a>
        </h2>

        <h4>
          <br>
            <tr>
              <p>
                <td>Attach power distribution board to top plate using 4-40 x 1/2" pan head. [3 places]</td>
              </p>
              <td>
                <img src="images/pph.png">
              </td>
            </tr>
            
          <tr>
            <p>
              <td>Attach 12V power supply to top plate using 4-40 x 1/4" pan head with lockwashers. [2 places]</td>
            </p>
            <td>
                <img src="images/pph.png">
              </td>
            </tr>
            
          <tr>
            <p>
              <td>Attach AC power wire harness (GREEN/WHITE/BLACK) to J7 on the power distribution board.</td>
            </p>
            <td>
                <img src="images/pph.png">
              </td>
            </tr>
            
          <tr>
            <p>
              <td>Attach the GREEN wire to the GROUND terminal on the 12V power supply.</td>
            </p>
            <td>
                <img src="images/pph.png">
              </td>
            </tr>
            
          <tr>
            <p>
              <td>Attach the WHITE wire to the NEUTRAL terminal on the 12V power supply.</td>
            </p>
            <td>
                <img src="images/pph.png">
              </td>
            </tr>
            
          <tr>
            <p>
              <td>Attach the BLACK wire to the LINE terminal on the 12V power supply.</td>
            </p>
            <td>
                <img src="images/pph.png">
              </td>
            </tr>
            <tr>
              <p>
                <td>Attach DC power wire harness (BLACK/RED) to J11 on the power distribution board.</td>
              </p>
              <td>
                <img src="images/pph.png">
              </td>
            </tr>
            
          <tr>
            <p>
              <td>Attach the BLACK wire to the V- terminal on the 12V power supply.</td>
            </p>
            <td>
                <img src="images/pph.png">
              </td>
            </tr>
            
          <tr>
            <p>
              <td>Attach the RED wire to the V+ terminal on the 12V power supply.</td>
            </p>
            <td>
                <img src="images/pph.png">
              </td>
            </tr>

          </br>
        </h4>
        <?php include("footer.php"); ?>
      </div>
    </div>
  </body>
</html>