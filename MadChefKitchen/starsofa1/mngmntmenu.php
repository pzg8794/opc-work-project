<?php
/**
	Template Name: testpage
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Form</title>

		<style type ="text/css">
			@import http://fonts.googleapis.com/css?family=Raleway;
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
h2 {
	font-size:16px;
	font-family:'Lato',sans-serif;
	color:#fff;
}
a {
	color:#fff;
	text-align:center;
}
.btn {
	padding:40px 30px 30px 30px;
	margin:0 1px 0 0;
	text-decoration:none;
	text-align:center;
	color:#7f8c8d;
	cursor:pointer;
	background:#2c3e50;
	border-bottom:10px solid #34495e;
	transition-property:border-bottom .6s linear 0s;
	-moz-transition:border-bottom .6s linear 0s;
	-webkit-transition:border-bottom .6s linear 0s;
	-o-transition:border-bottom .6s linear 0s;
	font-size:25px;
}
.btn.active {
	border-bottom:10px solid #2ecc71;
	color:#2ecc71;
}
.button-group-navigation li {
	display:inline-block;
	list-style:none;
	padding:0;
	margin:0;
	zoom:1;
	background:#7f8c8d;
}
.button-group-navigation li .btn {
	float:right;
	text-align: center;
	margin-left: 0px;
}

.button-group-navigation>.btn:first-child,.button-group-navigation li:first-child .btn {
	margin-left:0;
  -webkit-border-top-left-radius: 3px;
-webkit-border-bottom-left-radius: 3px;
-moz-border-radius-topleft: 3px;
-moz-border-radius-bottomleft: 3px;
border-top-left-radius: 3px;
border-bottom-left-radius: 3px;
}
.button-group-navigation>.btn:last-child,.button-group-navigation li:last-child>.btn {
	margin-right: 0;
  -webkit-border-top-right-radius: 3px;
-webkit-border-bottom-right-radius: 3px;
-moz-border-radius-topright: 3px;
-moz-border-radius-bottomright: 3px;
border-top-right-radius: 3px;
border-bottom-right-radius: 3px;
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
	
<link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
<h1> MadChefKitchen Administration Tasks 
<div class="button-group-navigation" target="_blank">
	<li><a class="btn" href="#"> SEARCH <br> <i class="icon ion-search">  </i></a></li>
	<li><a class="btn" href="http://madchefkitchen.com/signreg/classes-management/"> CLASSES <br> <i class="icon ion-ios-book"></i></a></li>
	<li><a class="btn" href="http://madchefkitchen.com/signreg/recipies/"> RECIPES <br> <i class="icon ion-ios-timer"></i></a></li>
	<li><a class="btn" href=" http://madchefkitchen.com/signreg/gallerymngmnt/"> GALLERY <br> <i class="icon ion-images"></i></a></li>
</div>
</h1>

	</body>
</html>