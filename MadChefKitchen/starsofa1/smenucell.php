<?php
/**
 */
?>

<!DOCTYPE html>
<html lang=en>

	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8">
		
		<style type ="text/css">
		<!-- CSS CODE FOR THE STRUCTURE OF THE  -->
						h2
			{
				font-family	: "FontAwesome";
  				font-size	: 17px;
				font-weight	: bold;
  				color		: #990066;
  				text-align	: center;
				margin-left	: -0px;
    				text-shadow	: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
			} 

		</style>
	</head>
	
<body>

		<form name="management" method="post" id="management" action="<?php echo $PHP_SELF;?>">
			<table width="100%">
							
				<td valign="top"> 
					<?php
						//$link = require('mysqli_connect.php'); //connect to the database
						//The script performs an INSERT query that adds a record to the users table.
						if($_SERVER['REQUEST_METHOD'] == 'POST') 
						{
							if ($_POST['select']){
								header("Location: ".$_POST['select']);
							}
				
						}//End of the main Submit Conditional
					?>	
				</td>
				
				<tr>	
		 			<td align = "center" valign="top"> 
						<h2> MadChef Management Menu </h2>
						<select name="select" onchange="document.getElementById('management').submit()">
							
							<option value="#"> SELECT FROM THIS LIST </option>  
							<option value="http://madchefkitchen.com/">HOME</option>  
							<option value="http://madchefkitchen.com/explore/cooking-classes/">CLASSES</option>    
							<option value="http://madchefkitchen.com/explore/">SERVICES</option>     
							<option value="http://madchefkitchen.com/hireus/">HIRE A CHEF</option>   
							<option value="http://madchefkitchen.com/mckstore/">MCK STORE</option>
							<option value="http://madchefkitchen.com/recipe-2/">RECIPES</option>
							<option value="http://madchefkitchen.com/chefblog/">CHEF'S BLOG</option>
							<option value="http://madchefkitchen.com/our-sponsors/">OUR PARTNERS</option>
							<option value="http://madchefkitchen.com/our-story/">ABOUT US</option>
							<option value="http://madchefkitchen.com/contact-us/">CONTACT US</option>
							<option value="http://madchefkitchen.com/signreg/">MANAGEMENT</option>
						<select>
					</td>
				</tr>

			</table>
		</form> 
</body>
</html>
