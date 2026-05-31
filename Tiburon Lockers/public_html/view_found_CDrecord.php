<!doctype html>
<html lang=en>

<head>
<title> Administrator View-Members Page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">

  <style type ="text/css">
    p{
    text-align:center;
    //margin-right:150px;
    //margin:auto;
    margin-left:-1em;
    }

    p.error{
    color:red; font-size:105%; font-weight:bold; text-align:center; margin-left:9em;
    }

    p1{
    position:obsolute;
    text-align:center;
    //margin-right:150px;
    //margin:auto;
    margin-left:26em;
    }

    #content {
    position: obsolute;
    //margin-right:150px;
    //margin:auto;
    margin-left:1em;
    }


    #header {
    background:#FFF url(tiburon.png)no-repeat center top; width:290px; height:80px;
    margin:0px auto 10px; padding: 10px 905px 10px 0px; text-align:center;
    }

    h2 {
    font-size:150%; color:navy; text-align:center;
    //margin-right:150px;
    //margin:auto;
    margin-top: 60px;
    margin-left:6em;
    }

    #footer {
    //text-align:center;
    //margin-right:150px;
    //margin:auto;
    margin-left:11em;
    }

  </style>
</head>
  
<body>
  <div id='container'>
    <?php include('nav1.php'); ?>
    <div id='content'>
      <!--Start of the view_users_page content. -->

      <h2> Search Result </h2>
      <p>
        <?php
            
//This section processes submissions from the login form
//Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	  //connect to database
  
    //This script retrives records from the users table.
    require('mysqli_connect.php'); //Connect to the database.
    //echo '<p> 
    //<br>If Not Record Is Shown Is Because Of An Incorrect Or Missing Entry In The Search Form.</br>
    //Click The Back Button On The Browser And Try Again </p>';
   
    if(!empty($_POST['submit'])){
      $sh = $_POST['search'];
      $list = explode(" ", $sh);
   
    
      function displayA($result){
      
        if ($result) { // If it ran OK, display the records.
	        //Tablet Header
	        echo '<table>
	        <tr>
       
          <td><b>Edit</b></td>
          <td><b>Delete</b></td>
      
          <td><b>ID</b></td>
          <td><b>SN</b></td>
          <td><b>O. Name</b></td>
          <td><b>A1</b></td>
          <td><b>A2</b></td>
          <td><b>City</b></td>
          <td><b>State</b></td>
          <td><b>Zip</b></td>
          <td><b>CFName</b></td>
          <td><b>CLName</b></td>
          <td><b>Email</b></td>
          <td><b>Phone</b></td>
          <td><b>Delivered</b></td>
          <td><b>Install Loc</b></td>
          <td><b>SBuild</b></td>
          <td><b>Brand</b></td>
          <td><b>OS</b></td>
          <td><b>M/S</b></td>
          <td><b>Mount</b></td>
          <td><b>Doors</b></td>
          <td><b>Active</b></td>
          <td><b>Notes</b></td></td>
          </tr>';
         // Fetch and print all the records:
      
	       while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		        echo '<tr>
        
            <td><a href="edit_CDrecord.php?id='.$row['id'] . '">Edit</a></td>
            <td><a href="delete_CDrecord.php?id='.$row['id'].'">Delete</a></td>
          
            <td>'.$row['id'].'</td>
            <td>'.$row['serialnumber'].'</td>
            <td>'.$row['org_name'].'</td>
            <td>'.$row['addr1'].'</td>
            <td>'.$row['addr2'].'</td>
            <td>'.$row['city'].'</td>
            <td>'.$row['state'].'</td>
            <td>'.$row['zcode'].'</td>
            <td>'.$row['contact_fname'].'</td>
            <td>'.$row['contact_lname'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['delivered'].'</td>
            <td>'.$row['install_loc'].'</td>
            <td>'.$row['soft_build'].'</td>
            <td>'.$row['tab_mak_mod'].'</td>
            <td>'.$row['op_sys'].'</td>
            <td>'.$row['master_subor'].'</td>
            <td>'.$row['mount'].'</td>
            <td>'.$row['doors'].'</td>
            <td>'.$row['active'].'</td>
            <td>'.$row['notes'].'</td>
            </tr>';
	        }
		      echo '</table>'; // Close the table so that it is ready for displaying.
		      mysqli_free_result($result); // Free up the resources.<td>'.$row['regdat'].'</td>
        }
        else{ // If it did not run ok.
	        //Error Message
	        echo '<p class="error"> <br>There Was No Match For Your Search.</br> Please Try With A Different String </p>';
  	      // Debug message:
	        echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
        }//End of if($result)
      }
  
      function displayM($result){
        if ($result) { // If it ran OK, display the records.
	        //Tablet Header
	        echo '<table>
  	      <tr>
          <td><b>ID</b></td>
          <td><b>SN</b></td>
          <td><b>O. Name</b></td>
          <td><b>A1</b></td>
          <td><b>A2</b></td>
          <td><b>City</b></td>
          <td><b>State</b></td>
          <td><b>Zip</b></td>
          <td><b>CFName</b></td>
          <td><b>CLName</b></td>
          <td><b>Email</b></td>
          <td><b>Phone</b></td>
          <td><b>Delivered</b></td>
          <td><b>Install Loc</b></td>
          <td><b>SBuild</b></td>
          <td><b>Brand</b></td>
          <td><b>OS</b></td>
          <td><b>M/S</b></td>
          <td><b>Mount</b></td>
          <td><b>Doors</b></td>
          <td><b>Active</b></td>
          <td><b>Notes</b></td></td>
          </tr>';
	    
          // Fetch and print all the records:
	        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  		      echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['serialnumber'].'</td>
            <td>'.$row['org_name'].'</td>
            <td>'.$row['addr1'].'</td>
            <td>'.$row['addr2'].'</td>
            <td>'.$row['city'].'</td>
            <td>'.$row['state'].'</td>
            <td>'.$row['zcode'].'</td>
            <td>'.$row['contact_fname'].'</td>
            <td>'.$row['contact_lname'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['delivered'].'</td>
            <td>'.$row['install_loc'].'</td>
            <td>'.$row['soft_build'].'</td>
            <td>'.$row['tab_mak_mod'].'</td>
            <td>'.$row['op_sys'].'</td>
            <td>'.$row['master_subor'].'</td>
            <td>'.$row['mount'].'</td>
            <td>'.$row['doors'].'</td>
            <td>'.$row['active'].'</td>
            <td>'.$row['notes'].'</td>
            </tr>';
	        }
		      echo '</table>'; // Close the table so that it is ready for displaying.
		      mysqli_free_result($result); // Free up the resources.<td>'.$row['regdat'].'</td>
        }
        else{ // If it did not run ok.
	        //Error Message
    	    echo '<p class="error"> <br>There Was No Match For Your Search.</br> Please Try With A Different String </p>';
	        // Debug message:
	        echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
        }//End of if($result)
     }

      function displayB($result){
   
        if ($result) { // If it ran OK, display the records.
	        //Tablet Header
	        echo '<table>
    	    <tr>
          <td><b>Edit</b></td>
          <td><b>ID</b></td>
          <td><b>SN</b></td>
          <td><b>O. Name</b></td>
          <td><b>A1</b></td>
          <td><b>A2</b></td>
          <td><b>City</b></td>
          <td><b>State</b></td>
          <td><b>Zip</b></td>
          <td><b>CFName</b></td>
          <td><b>CLName</b></td>
          <td><b>Email</b></td>
          <td><b>Phone</b></td>
          <td><b>Delivered</b></td>
          <td><b>Install Loc</b></td>
          <td><b>SBuild</b></td>
          <td><b>Brand</b></td>
          <td><b>OS</b></td>
          <td><b>M/S</b></td>
          <td><b>Mount</b></td>
          <td><b>Doors</b></td>
          <td><b>Active</b></td>
          <td><b>Notes</b></td></td>
          </tr>';
	    
          // Fetch and print all the records:
	        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		         echo '<tr>
             <td><a href="edit_CDrecord.php?id='.$row['id'] . '">Edit</a></td>
            <td>'.$row['id'].'</td>
            <td>'.$row['serialnumber'].'</td>
            <td>'.$row['org_name'].'</td>
            <td>'.$row['addr1'].'</td>
            <td>'.$row['addr2'].'</td>
            <td>'.$row['city'].'</td>
            <td>'.$row['state'].'</td>
            <td>'.$row['zcode'].'</td>
            <td>'.$row['contact_fname'].'</td>
            <td>'.$row['contact_lname'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['delivered'].'</td>
            <td>'.$row['install_loc'].'</td>
            <td>'.$row['soft_build'].'</td>
            <td>'.$row['tab_mak_mod'].'</td>
            <td>'.$row['op_sys'].'</td>
            <td>'.$row['master_subor'].'</td>
            <td>'.$row['mount'].'</td>
            <td>'.$row['doors'].'</td>
            <td>'.$row['active'].'</td>
            <td>'.$row['notes'].'</td>
            </tr>';
	        }
		      echo '</table>'; // Close the table so that it is ready for displaying.
		      mysqli_free_result($result); // Free up the resources.<td>'.$row['regdat'].'</td>
        }
        else{ // If it did not run ok.
	        //Error Message
	        echo '<p class="error"> <br>There Was No Match For Your Search.</br> Please Try With A Different String </p>';
	        // Debug message:
	        echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
        }//End of if($result) 
      }

      switch(count($list)){
        
        case "1":
             //Make the query.
          $q = "SELECT * FROM chargedad WHERE 
          id LIKE '$sh' OR serialnumber LIKE '$sh' OR org_name LIKE '$sh' OR addr1 LIKE '$sh' OR addr2 LIKE '$sh' OR city LIKE '$sh' OR state LIKE '$sh' 
          OR zcode LIKE '$sh' OR contact_fname LIKE '$sh' OR contact_lname LIKE '$sh' OR email LIKE '$sh' OR phone LIKE '$sh' OR delivered LIKE '$sh' 
          OR install_loc LIKE '$sh' OR soft_build LIKE '$sh' OR tab_mak_mod LIKE '$sh' OR op_sys LIKE '$sh' OR master_subor LIKE '$sh' 
          OR mount LIKE '$sh' OR doors LIKE '$sh' OR active LIKE '$sh' OR notes LIKE '$sh'";
          $result = @mysqli_query ($dbcon, $q); // Run the query
        
        break;
        
        case "2":
          $sh = $list[0];
          $ss = $list[1];
             //Make the query.
          $q = "SELECT * FROM chargedad WHERE 
          id LIKE '$sh' OR serialnumber LIKE '$sh' OR org_name LIKE '$sh' OR addr1 LIKE '$sh' OR addr2 LIKE '$sh' OR city LIKE '$sh' OR state LIKE '$sh' 
          OR zcode LIKE '$sh' OR contact_fname LIKE '$sh' OR contact_lname LIKE '$sh' OR email LIKE '$sh' OR phone LIKE '$sh' OR delivered LIKE '$sh' 
          OR install_loc LIKE '$sh' OR soft_build LIKE '$sh' OR tab_mak_mod LIKE '$sh' OR op_sys LIKE '$sh' OR master_subor LIKE '$sh' 
          OR mount LIKE '$sh' OR doors LIKE '$sh' OR active LIKE '$sh' OR notes LIKE '$sh' 
          UNION
          SELECT * FROM chargedad WHERE 
          id LIKE '$ss' OR serialnumber LIKE '$ss' OR org_name LIKE '$ss' OR addr1 LIKE '$ss' OR addr2 LIKE '$ss' OR city LIKE '$ss' OR state LIKE '$ss' 
          OR zcode LIKE '$ss' OR contact_fname LIKE '$ss' OR contact_lname LIKE '$ss' OR email LIKE '$ss' OR phone LIKE '$ss' OR delivered LIKE '$ss' 
          OR install_loc LIKE '$ss' OR soft_build LIKE '$ss' OR tab_mak_mod LIKE '$ss' OR op_sys LIKE '$ss' OR master_subor LIKE '$ss' 
          OR mount LIKE '$ss' OR doors LIKE '$ss' OR active LIKE '$ss' OR notes LIKE '$ss'";
          $result = @mysqli_query ($dbcon, $q); // Run the query
 
        break;  
  
        case "3": 
          $sh = $list[0];
          $ss = $list[2];
          $cs = $list[1];
             //Make the query.
          $q = "SELECT * FROM chargedad WHERE 
          id LIKE '$sh' OR serialnumber LIKE '$sh' OR org_name LIKE '$sh' OR addr1 LIKE '$sh' OR addr2 LIKE '$sh' OR city LIKE '$sh' OR state LIKE '$sh' 
          OR zcode LIKE '$sh' OR contact_fname LIKE '$sh' OR contact_lname LIKE '$sh' OR email LIKE '$sh' OR phone LIKE '$sh' OR delivered LIKE '$sh' 
          OR install_loc LIKE '$sh' OR soft_build LIKE '$sh' OR tab_mak_mod LIKE '$sh' OR op_sys LIKE '$sh' OR master_subor LIKE '$sh' 
          OR mount LIKE '$sh' OR doors LIKE '$sh' OR active LIKE '$sh' OR notes LIKE '$sh' 
          UNION
          SELECT * FROM chargedad WHERE 
          id LIKE '$cs' OR serialnumber LIKE '$cs' OR org_name LIKE '$cs' OR addr1 LIKE '$cs' OR addr2 LIKE '$cs' OR city LIKE '$cs' OR state LIKE '$cs' 
          OR zcode LIKE '$cs' OR contact_fname LIKE '$cs' OR contact_lname LIKE '$cs' OR email LIKE '$cs' OR phone LIKE '$cs' OR delivered LIKE '$cs' 
          OR install_loc LIKE '$cs' OR soft_build LIKE '$cs' OR tab_mak_mod LIKE '$cs' OR op_sys LIKE '$cs' OR master_subor LIKE '$cs' 
          OR mount LIKE '$cs' OR doors LIKE '$cs' OR active LIKE '$cs' OR notes LIKE '$cs' 
          UNION
          SELECT * FROM chargedad WHERE 
          id LIKE '$ss' OR serialnumber LIKE '$ss' OR org_name LIKE '$ss' OR addr1 LIKE '$ss' OR addr2 LIKE '$ss' OR city LIKE '$ss' OR state LIKE '$ss' 
          OR zcode LIKE '$ss' OR contact_fname LIKE '$ss' OR contact_lname LIKE '$ss' OR email LIKE '$ss' OR phone LIKE '$ss' OR delivered LIKE '$ss' 
          OR install_loc LIKE '$ss' OR soft_build LIKE '$ss' OR tab_mak_mod LIKE '$ss' OR op_sys LIKE '$ss' OR master_subor LIKE '$ss' 
          OR mount LIKE '$ss' OR doors LIKE '$ss' OR active LIKE '$ss' OR notes LIKE '$ss'";
          $result = @mysqli_query ($dbcon, $q); // Run the query

        break;
        
        case "4":
          break;
          case "5":
          break;
        default:
      }
      
      $row_cnt = $result->num_rows;
      
      if ($row_cnt!= 0){
    
        if($ul == 2)
          displayB($result);
        else if($ul == 1)
          displayA($result);
        else
          displayM($result);
      }
      else{ // If it did not run ok.
	      //Error Message
	      echo '<p class="error">There Was No Match For Your Search </p>';
      } //End of if($result) 
     
      //Now display the figure for the total number of records/members
      $q = "SELECT COUNT(id) FROM chargedad";
      $result = @mysqli_query ($dbcon, $q);
      $row = @mysqli_fetch_array ($result, MYSQLI_NUM);
      $members = $row[0];
      mysqli_close($dbcon); // Close the datqabase connection.
      echo "<p1> Total Number Of Records In The ChargeDaddy Database: $members</p1>";
    }
    else{
      //Error Message
	    echo '<p class="error"> The Search Field Was Empty.</p>';
	    // Debug message:
    }
  }
  include("footer.php"); ?>
      </p>
    </div>
    <!-- End of the User's Table Page Content -->
  </div>
</body>
</html>