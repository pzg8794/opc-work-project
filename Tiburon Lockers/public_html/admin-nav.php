<?php

if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)){
  header("Location: login.php");
  exit();
}

echo '<h1>';
if(isset($_SESSION['fname'])){
	echo "{$_SESSION['fname']}";
  echo " {$_SESSION['lname']}" . "<br>";
} 
    
//Use a ternary operation to set the URL
if(isset($_SESSION['user_level'])){
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
        <a href="index.php" title="Home">Home</a>
      </li>

      <li>
        <a href="logout.php">Logout</a>
      </li>

      <li>
        <a href="search.php">Search</a>
      </li>

      <li>
        <a href="pjsmgnt.php">Projects</a>
      </li>

      <li>
        <a href="ecalendar.php">Schedule</a>
      </li>


      <li>
        <a href="admin_view-users-page.php">View Users</a>
      </li>
      
      <li>
        <a href="#">Instructions</a>
        <ul>
          <li>
            <a href="assembly.php">Assembly</a>
          </li>
          <li>
            <a href="#">Software</a>
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
      
      <li>
        <a href="register-page.php">New Employee</a>
      </li>
      
      <li>
        <a href="register-password.php">New Password</a>
      </li>


    </ul>
  </nav>
</div><!--end of side column and menu -->