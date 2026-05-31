<!DOCTYPE html>
<html>
	<head>
		<title>CD Assembly</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Custom styles for this template -->
		<link href="sticky-footer-navbar.css" rel="stylesheet">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		
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
		<div class="container">
			<div id="nav">
				<nav class="navbar navbar-default navbar-static-top">
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<tr>
								<th>
									<br>
									<?php
										echo '<h1>';
										echo "Charge Daddy". "<br>";
										echo "Assembly Instructions";
										echo '</h1>';
									?>
									<select class="form-control" name="Database" onchange="window.location=this.value">
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
								</th>
							</tr>					
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</body>
</html>
