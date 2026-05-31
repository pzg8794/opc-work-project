<?php

?>
<!doctype html>
<html lang=en>

<head>
<title>Search page</title>
<meta charset=utf-8>

  <style type ="text/css">
    h3.red {
    color:red;
    font-size:105%;
    font-weight:bold;
    text-align:center;
    }

				h2
			{
				font-family	: "FontAwesome";
  				font-size	: 50px;
				font-weight	: bold;
  				color		: #990066;
  				text-align	: center;
				margin-left	: -0px;
    				text-shadow	: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
			} 
	
    h4{
    text-align: center;
    }

    h{
    position:absolute; bottom:230px; right:50px; color:navy; width:666px; text-align:center;
    margin:5px auto 0;
    }			@import http://fonts.googleapis.com/css?family=Raleway;
			/*----------------------------------------------
			CSS Settings For HTML Div ExactCenter
			------------------------------------------------*/
			@import url(http://fonts.googleapis.com/css?family=Lato:100);
body {
	background:#3498db;
}
h1 {
	font-size:30px;
	font-family:'Lato',sans-serif;
	color:#fff;
	
	text-align:center;
}
a {
	color:#fff;
	text-align:center;
}

		</style>

		<script type="text/javascript">	
	
	$(window).load(function(){
$('a.btn').click(function(){
    $( this ).toggleClass( "active" );
});
});
	
		</script>
		
</head>
  
<body>



		<form name="database" method="post" id="calendar" action="<?php echo $PHP_SELF;?>">
			<table width="100%">					
				<tr>	<!--  FIELD FOR THE USER TO ENTER THE DATE OF THE EVENT-->
		 			<td valign="top"> 		
						<!--Start of the view_users_page content. -->
						<h2> Search For Record(s) </h2>
						<h3 class="red"> Please Choose A Database To Search  <br>
						<select name="Database" onchange="window.location=this.value">
							<option value = '#'> Select Database From This List </option>
							<option value = 'chargedaddyForm.php'> Recipes </option>
							<option value = 'chargedaddyForm.php'> Classes </option>
							<option value = 'usersForm'> Students </option>
							<option value = 'chargedaddyForm.php'> Clients </option>
							<option value = 'usersForm'> Employees </option>
							<option value = 'usersForm'> All Databases </option>
						</select>
						</h3>
					</td>
				</tr>
				
				<tr>
				
				<td valign="top"> 
					<?php
						//$link = require('mysqli_connect.php'); //connect to the database
						//The script performs an INSERT query that adds a record to the users table.
						if($_SERVER['REQUEST_METHOD'] == 'POST') 
						{
							$errors  = array(); // Initialize an error array.

							//was the date entered?
							if (empty($_POST['Database']))
							{
								
							}
						}//End of the main Submit Conditional
					?>	
				</td>
				</tr>
			</table>
		</form> 
	</div>
</body>
</html>