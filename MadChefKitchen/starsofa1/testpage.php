<?php

/**

 */
	get_header(); 
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
 table.table1 table.table2,  table.table1 table.table2 th,  table.table1 table.table2 td {
    border: 1px solid black;
    border-collapse: collapse;
}
table.table1{
    border: 0px solid black; 
    border-collapse: collapse;
}

table.table1 th, table.table1 td {
    padding: 5px;
    text-align: left;    
}

table.table1 table.table2 th, table.table1 table.table2 td{
	color: #8B0000; font-weight: bold;
	width:70%;
	word-wrap:break-word;
	font-family: 'FontAwesome', sans-serif; font-size: 10pt; 
}

table.table1 table.table2 th, table.table1 table.table2 th{
	color: black; font-weight: bold;
	width:30%;
	word-wrap:break-word;
	font-family: 'FontAwesome', sans-serif; font-size: 10pt; 
}

table.table1 table.table2, table.table1{
    border-collapse:collapse; table-layout:fixed; 
}

  
		.note
		{
			width: 100%;
		}	

		.yellow 
		{	
			width: 100%;
  			transform: rotate(0deg);	
			position: relative;
		}	

		.yellow::after 
		{
			width: 100%;
  			background-image: url("http://madchefkitchen.com/wp-content/uploads/2015/10/backg.jpg");
			background-size: 50%;
			
			background-position: center;
			opacity: 0.01;
    filter: alpha(opacity=.10); /* For IE8 and earlier */
			position: absolute;
			z-index: -1;   
			
  content: "";
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
		}
</style>
</head>

<body>
	<table class="table1">
		<tr>
			<th colspan="1" style="width:0%"></th>
				<td colspan="1" >
					<div class="note yellow" align="center"  style="width:150%; margin-left:-25%;">
						<table class="table2" align="center" style="width:100%; margin-left:-0%;">
							<tr>
								
							</tr>
						</table>
					</div>
				</td>
				
				<td colspan="1" style="width:0%"></td>
		</tr>
		
		<tr>
			<th  valign="top" style="width:33.3%">
				<div class="note yellow" style="width:100%">
					<table class="table2" style="width:100%">
						<tr>
						
						</tr>
					</table>
				</div>
			</th>
			
			<td  valign="top" style="width:33.3%">
				<div class="note yellow" align="center" style="width:100%">
					<table class="table2" align="center" style="width:100%">
						<tr>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>
