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
      
        if(isset($_SERVER['HTTP_REFERER'])) {
          $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
           
        }else
          $url = basename($_SERVER['PHP_SELF']); 
        
         echo "<a href='$url'>Back</a>";
  ?>
    </li>


    <li>
    <a href="index.php" title="Home">Home</a>
  </li>

    <li>
      <a href="#">Project View</a>
      <ul>
        
        <li>
          <a href="ecalendar.php">Schedule</a>
        </li>
        
        <li>
          <a href="pjrecords.php"> Project Levels </a>
        </li>
        
      </ul>
    </li>

    <li>
      <a href="addProject.php">New Project</a>
    </li>
    
</ul>
  </nav>
    </div><!--end of side column and menu -->

