<?php
	//if one database row (record) matches the input: start the session,
	// fetch the record and insert the three values in a array
	
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
	
	$url = 'header.php';
	
	if(empty($_SESSION['user_id'])){
		//exit(); 
	}
	else {
		
		if(( $_SESSION['user_level'])== 1)
		$url = 'mainbar.php';
		else
		$url = 'member-nav.php';
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="stylesheet" type="text/css" href="asmstyle.css">
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
	</head>
	
	<body>
		<div class="container">
			<?php include($url); ?>
			<?php include('nav2.php'); ?>
			<div id='content'>
				<!--Start of the view_users_page content. -->
				<h2>
					<a id="12vpower">Linkage Assembly</a>
				</h2>				
				<h4>
					<br>					
					<tr>
						<p>
							<td>Drill out servo arms</td>
						</p>
						<td>
							<img src="images/drill.png">
						</td>
					</tr>					
					<tr>
						<p>
							<td>Cut and Bend servo linkages</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>					
					<tr>
						<p>
							<td>Attach a return spring from the slide latch arm to the #2 stud</td>
						</p>
						<td>
							<img src="images/pph.png">
						</td>
					</tr>					
					<tr>
						<p>
							<td>Attach the servo linkage and control arm to the servo, positioning the linkage end just in-board of the compartment edge</td>
						</p>
						<td>
							<img src="images/link1.png">
						</td>
					</tr>				
					<tr>
						<p>
							<td>Mount a plastic channel clip on top of the compartment to retain the linkage it its ideal channel</td>
						</p>
						<td>
							<img src="images/clip.png">
						</td>
					</tr>					
					<tr>
						<p>
							<td>Confirm that the opposite linkage end does not catch on the slide latch arm when the quad door frame is opened for manual access</td>
						</p>
						<td>
							<img src="images/link2.png">
						</td>
					</tr>				
					</br>
				</h4>				
			</div>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>