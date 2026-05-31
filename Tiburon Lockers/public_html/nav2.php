 <?php
if(session_status() == PHP_SESSION_NONE){
  session_start();
}

		echo '<h1>';
		if(isset($_SESSION['fname']))
			echo "{$_SESSION['fname']}";
    
    if(isset($_SESSION['lname']))
        echo " {$_SESSION['lname']}" . "<br>";
        
    //Use a ternary operation to set the URL
		if(isset($_SESSION['user_level'])){
    
        $ul = $_SESSION['user_level'];
        if($ul == 0)
          echo "Logged as a Sales Member";
         else if($ul == 2)
           echo "Logged as a Technician";
         else if($ul == 1)
           echo "Logged as an Administrator";
    }  
		echo '</h1>';
	  ?>


<style type ="text/css">
  /*set general anchor style*/
  li a {
  display: block; width:140px; color:white; font-weight:bold; text-decoration:none;
  }

  /* mouseover */
  li a:hover {
  display:block; background: #0a4adf; border: 4px outset #8abaff; width:140px;
  }

</style>

<div id="header">

  <div id="reg-navigation">
    <ul>
      <img alt="Lockers" title="Locker Rental" height="77" src="sharky.gif"
          width ="150">
      </ul>
  </div>
</div>

<div id="nav"><!-- The side menu column contains the vertical menu block -->
  <nav>
  <ul>

    <li>
      <?php 
    $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
      echo "<a href='$url'>Back</a>";
  ?>
    </li>
    
    <li>
    <a href="index.php" title="Home">Home</a>
  </li>

    <li>
        <a>Sections:
          <select name="Database" onchange="window.location=this.value">
            <option value = '#'> Sections List </option>
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
        </a>
    </li>
</ul>
  </nav>
    </div><!--end of side column and menu -->

