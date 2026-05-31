<?php
/**
 */
 
 
	// CONNECTING TO THE DATABASE
			// This file provides the information for accessing the database and connecting to MySQL. It also sets the language coding to utf-8
			// First we define the constants:

			// ** MySQL settings - You can get this info from your web host ** //
			/** The name of the database for WordPress */
			define('DB_NAME', 'madchef_classes');

			/** MySQL database username */
			define('DB_USER', 'madchef_madchef');

			/** MySQL database password */
			define('DB_PASSWORD', 'Brando2025');

			/** MySQL hostname */
			define('DB_HOST', 'localhost');

			/** Database Charset to use in creating database tables. */
			define('DB_CHARSET', 'utf8');

			/** The Database Collate type. Don't change this if in doubt. */
			define('DB_COLLATE', '');

			//Make the connection
			$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' .mysqli_connect_error() );

			//setting
			mysqli_set_charset($dbcon, 'utf8');
?>

<!DOCTYPE html>
<html>
<head>
<style type ="text/css">
table, th, td {
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
td{
	color: #8B0000; font-weight: bold;
	font-family: 'FontAwesome', sans-serif; font-size: 8pt; 
}

th{
	color: black; font-weight: bold;
	width:33%;
	word-wrap:break-word;
	font-family: 'FontAwesome', sans-serif; font-size: 8pt; 
}

table{
    border-collapse:collapse; table-layout:fixed; 
}

   table td {word-wrap:break-word;}
   

		.note
		{
			width: 100%;
		}	
		
		.yellow2 
		{	
			width: 100%;
  			transform: rotate(0deg);	
			position: relative;
		}		

				.yellow2::after {
			
  content: "";
			
  opacity: 0.3;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
width: 100%;
  			background-image: url("http://madchefkitchen.com/wp-content/uploads/2015/11/Catering-photo.jpg");
			 background-repeat: no-repeat;
			background-position: center; 
			background-size: 100%;
			top: -0%; 
			position: absolute;
			z-index: -1;     
}
		
			h2 
			{ 
				text-align:center;
				position: relative; 
				font-size: 10pt;
				color:white;
				top: 0%; 
				left: 12%; 
				width: 75%; 
			}
</style>
</head>

	<body>
		<table style="width:100%">
			<tr>
				<th>
					<div class="note yellow2">
						<table style="width:100%">
							<tr>
								<th>  
			<a href="http://madchefkitchen.com/private-chef-services/"> 
					<h2>
						<br/><br/><br/> <br/> 
						<span style="font-family: 'FontAwesome', sans-serif; width:bold; font-size: 15pt; color: #8B0000;"><br> Private Chef <br></span>
						<br/><br/>
						Private chef services are our most personalized option. The chef is typically hired to work exclusively for  one person and/or family.
						<br/><br/><br/>
						<cite class="author" > <a style="font-family: 'FontAwesome', sans-serif; font-size: 12pt; width:bold;  color: #8B0000;" href="http://madchefkitchen.com/private-chef-services/"/> Read More About Us </a></cite>
						<br/><br/><br/><br/> 
					</h2>
					</a>
								</th>
							</tr>
						</table>
					</div>
				</th>
							
				<td>
					<div class="note yellow2">
						<table style="width:100%">
							<tr>
								<th>  
										<a href="http://madchefkitchen.com/the-personal-chef-services/"> 
					<h2>
					<br/><br/><br/>
						<span style="font-family: 'FontAwesome', sans-serif; width:bold; font-size: 15pt;  color: #8B0000;"><br>  Personal Chef <br></span>
						<br/>
						Personal Chef services can be hired as a one time event or multiple events. As a personal chef, we offer menu planning, meal preparation, grocery shopping, 
						maintaining a clean kitchen all in the comforts of your home.
						<br/><br/>
						<cite class="author" > <a style="font-family: 'FontAwesome', sans-serif; font-size: 12pt;  width:bold;  color: #8B0000;" href="http://madchefkitchen.com/the-personal-chef-services/"/> Read More About Us </a></cite>
					<br/><br/><br/><br/>
					</h2>
					</a>
								</th>
							</tr>
						</table>
					</div>
				</td>
				
				<td>
					<div class="note yellow2">
						<table style="width:100%">
							<tr>
								<th>  
								
											<a href="http://madchefkitchen.com/explore/cooking-classes/"> 
					<h2>
					<br/><br/><br/>
						<span style="font-family: 'FontAwesome', sans-serif; width:bold; font-size: 15pt; color: #8B0000;"><br> Cooking Classes <br></span>
						<br/>
						Classes are offered in the comfort of your home or in one of our test kitchens located in the San Gabriel Valley and Greater Los Angeles. 
						Classes can be customized and/or are offered on our Calendar.
						<br/><br/>
						<cite class="author" > <a style="font-family: 'FontAwesome', sans-serif; font-size: 12pt; width:bold;  color: #8B0000;" href="http://madchefkitchen.com/explore/cooking-classes/"/> Read More About Us </a></cite>
					<br/><br/><br/><br/><br/>
					</h2>
					</a>
								
								</th>
							</tr>
						</table>
					</div>
				</td>
			</tr>
				
		<tr>
				<th>
					<div class="note yellow2">
						<table style="width:100%">
							<tr>
								<th>  
								
													<a href="http://madchefkitchen.com/explore/catering/"> 
					<h2>
					<br/><br/><br/> <br/> 
						<span style="font-family: 'FontAwesome', sans-serif; font-size: 15pt;  width:bold; color: #8B0000;"><br> Catering <br></span>
						<br/><br/>
							We offer catering services for large venues. Should you require catering information, contact our event planning department for more information. 
						<br/><br/>
						<cite class="author" > <a style="font-family: 'FontAwesome', sans-serif; font-size: 12pt;  width:bold;  color: #8B0000;" href="http://madchefkitchen.com/our-chefs/"/> Read More About Us </a></cite>
					<br/><br/><br/><br/> 
					</h2>
					</a>
								
								</th>
							</tr>
						</table>
					</div>
				</th>
							
				<td>
					<div class="note yellow2">
						<table style="width:100%">
							<tr>
								<th>  
								
													<a href="http://madchefkitchen.com/explore/demonstrations/"> 
					<h2>
					<br/><br/><br/><br/> 
						<span style="font-family: 'FontAwesome', sans-serif; font-size: 15pt;  width:bold; color: #8B0000;"><br>  Product Demonstrations <br></span>
						<br/><br/>
						If you are in need of a demonstrator to showcase your food related product or appliances, please contact our demo department for more information.
						<br/><br/>
						<cite class="author" > <a style="font-family: 'FontAwesome', sans-serif; font-size: 12pt;  width:bold;  color: #8B0000;" href="http://madchefkitchen.com/explore/demonstrations/"/> Read More About Us </a></cite>
					<br/><br/><br/><br/> 
					</h2>
					</a>
								
								</th>
							</tr>
						</table>
					</div>
				</td>
				
				<td>
					<div class="note yellow2">
						<table style="width:100%">
							<tr>
								<th>  
								
													<a href="http://madchefkitchen.com/explore/the-organized-kitchen-service/"> 
					<h2>
					<br/><br/><br/><br/> 
						<span style="font-family:'Comic Sans MS', sans-serif; font-size: 15pt; width:bold; color: #8B0000;"><br> Kitchen Organizer <br></span>
						<br/><br/>
						We are pleased to offer kitchen organization services. Our kitchen specialists are certified with the National Association of Organizers. Contact us for more information.
						<br/><br/>
					</a>
						<cite class="author" > <a style="font-family: 'Comic Sans MS', sans-serif; font-size: 12pt; width:bold;  color: #8B0000;" href="http://madchefkitchen.com/explore/the-organized-kitchen-service/"/> Read More About Us </a></cite>
					<br/><br/><br/><br/> 
					</h2>
								
								</th>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			
		<!-- <tr>
				<th>
					<div class="note yellow">
						<table style="width:100%">
							<tr>
								<th>  </th>
							</tr>
						</table>
					</div>
				</th>
							
				<td>
					<div class="note yellow">
						<table style="width:100%">
							<tr>
								<th>  </th>
							</tr>
						</table>
					</div>
				</td>
				
				<td>
					<div class="note yellow">
						<table style="width:100%">
							<tr>
								<th>  </th>
							</tr>
						</table>
					</div>
				</td>
			</tr> -->
		</table>
	</div>
</body>
</html>
