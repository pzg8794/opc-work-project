<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

	echo '<h5>';
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
	echo '</h5>';
?>

<div id="header">
	<div id="reg-navigation">
	</div>
</div>
<div id="nav">
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="members-page.php" class="navbar-brand">
					<img src="tiburon.png"  height="150%" />
				</a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>		
				<span class="icon-bar"></span>							
				</button>				
			</div>
			
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="members-page.php">Home</a></li>
					<li><a href="search-member.php">Search</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Instructions <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="assembly-member.php">Assembly</a></li>                       
							
							<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Software</a>
								<ul class="dropdown-menu">
									<li><a href="#">HTML</a></li>
									<li><a href="#">CSS</a></li>
								</ul>
							</li>
							
							<li><a href="#">Others</a></li>
						</ul>
					</li>		
					<li><a href="resetpass.php">Reset Password</a></li>
					<li><a href="logout.php">Log out</a></li>
				</ul>					
			</div>
		</div>
	</nav>
	
	<script>
		(function($){
			$(document).ready(function(){
				$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
					event.preventDefault(); 
					event.stopPropagation(); 
					$(this).parent().siblings().removeClass('open');
					$(this).parent().toggleClass('open');
				});
			});
		})(jQuery);
	</script>
	
	<style type="text/css">
		.marginBottom-0 {
			margin-bottom:0;
		}

		.dropdown-submenu {
			position:relative;
		}
		
		.dropdown-submenu>.dropdown-menu {
			top:0;
			left:100%;
			margin-top:-6px;
			margin-left:-1px;
			-webkit-border-radius:0 6px 6px 6px;
			-moz-border-radius:0 6px 6px 6px;
			border-radius:0 6px 6px 6px;
		}
		
		.dropdown-submenu>a:after {
			display:block;
			content:" ";
			float:right;
			width:0;
			height:0;
			border-color:transparent;
			border-style:solid;
			border-width:5px 0 5px 5px;
			border-left-color:#cccccc;
			margin-top:5px;
			margin-right:-10px;
		}
		
		.dropdown-submenu:hover>a:after {
			border-left-color:#555;
		}
		
		.dropdown-submenu.pull-left {
			float:none;
		}
		
		.dropdown-submenu.pull-left>.dropdown-menu {
			left:-100%;
			margin-left:10px;
			-webkit-border-radius:6px 0 6px 6px;
			-moz-border-radius:6px 0 6px 6px;
			border-radius:6px 0 6px 6px;
		}
	</style>
</div>