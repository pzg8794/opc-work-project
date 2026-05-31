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


<div id="nav"> <!-- The side menu column contains the vertical menu block -->

  <nav>
    <ul>

      <li>
        <a href="index.php" title="Home">Home</a>
      </li>

      <li>
        <a href="logout.php">Logout</a>
      </li>
      <li>
        <a href="search.php">Search</a>
      </li>
      
      <li>
        <a href="#">Instructions</a>
        <ul>
          <li>
            <a href="Assembly.php">Assembly</a>
          </li>
          
          <li>
            <a href="Software.php">Software</a>
             <ul>
            <li>
              <a href="#">HTML</a>
            </li>
            <li>
              <a href="#">CSS</a>
            </li>
          </ul>
          </li>
          
          <li>
            <a href="#">Others</a>
          </li>

        </ul>
      </li>
        <!--  <li><a href="page-3.php" title="Page three">Page 3 </a></li>
<li><a href="page-4.php" title="Page four">Page 4 </a></li>
<li><a href="page-5.php" title="Page five">Page 5 </a></li> -->
      
    </ul>
  </nav>
</div><!--end of side column and menu -->