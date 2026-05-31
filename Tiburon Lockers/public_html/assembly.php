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
        </style>
      </head>

  <body>
    <div id='container'>
      <?php include('nav1.php'); ?>
      <div id='content'>
        <!--Start of the view_users_page content. -->
        <h2> Assembly Instructions </h2>
        <h3 class="red"> Please Choose A Section From Below </h3>

        <h4>
          <br>
            
            <select name="Database" onchange="window.location=this.value">
              <option value = '#'> Select A Section </option>
              <option value = 'atstud.php'> Anti-Theft Stud </option>
              <option value = 'magnet.php'> Magnet </option>
              <option value = 'reed.php'> Reed Swtich </option>
              <option value = 'linkage.php'> Linkage </option>
              <option value = 'servo.php'> Servo Mounting </option>
              <option value = 'rework.php'> Metal Rework</option>
              <option value = 'compmnt.php'> Compartments </option>
              <option value = 'circuit.php'> PCB </option>
              <option value = '#j8'> J8 </option>
              <option value = '12vps.php'> 12V Power Supply  </option>
              <option value = '5vps.php'> 5V Power Supply </option>
              <option value = 'mainac.php'> Main AC Wiring </option>
              <option value = 'chassis.php'> Chassis Assembly </option>
              <option value = 'quad.php'> Quad Assembly </option>
            </select>

          </br>
        </h4>
        <?php include("footer.php"); ?>
      </div>
    </div>
  </body>
</html>