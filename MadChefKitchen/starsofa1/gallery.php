<?php
/**
 */
?>
<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>
	<!-- CSS CODE FOR THE STRUCTURE OF THE FORM AND CALENDAR OF EVENTS -->

	<style type ="text/css">
 		
		h1
		{
			font-size:30px;
			font-family:'Lato',sans-serif;
			color:black;
			text-align:left;
			margin-bottom: -10%;
			background-color: white;
			position: relative;
			z-index: 1;
		}
		
		#topcontent 
		{
 	   		position: relative;
    			margin-top:0%;
    			left: -0%;
			width:100%;
  		}
		
 		#leftcontent 
		{
 	   		position: relative;
  	  		left:-0%;
  			width:33%;
    		margin-top:-0%;
  		}

 	 	#centerleftcontent 
		{
    			position: relative;
    			left:35%;
    			width:33%;
    			margin-top:-42.5%;
  		}

 		#centerrightcontent 
		{
    			position: relative;
    			left:30%;
    			width:25%;
    			top:60px;
  		}

  		#rightcontent 
		{
 	   		position: relative;
    			left:70%;
    			width:33%;
    			margin-top:-42.5%;
  		}

	</style>
</head>
  
<body>
	<div id="topcontent">

		<div id="leftcontent">
			<h1> Dessert </h1>
			<?php echo do_shortcode("[flgallery id=6 /]"); ?>
		</div>

		<div id="centerleftcontent">
			<h1> Dinner </h1>
			<?php echo do_shortcode("[flgallery id=5 /]"); ?>
		</div>

		<div id="rightcontent">
			<h1> Small Bites </h1>
			<?php echo do_shortcode("[flgallery id=7 /]"); ?>
		</div>
	</div>	
	
	<div id="topcontent" style="margin-top:0%">

		<div id="leftcontent" style="margin-top:0%">
			<h1> Lunch </h1>
			<?php echo do_shortcode("[flgallery id=4 /]"); ?>
		</div>

		<div id="centerleftcontent" style="margin-top:=0%">
			<h1> Brunch </h1>
			<?php echo do_shortcode("[flgallery id=8 /]"); ?>
		</div>
		
		<div id="rightcontent" style="margin-top:-42%">
			<h1> Breakfast </h1>
			<?php echo do_shortcode("[flgallery id=2 /]"); ?>
		</div>
	</div>	
	
	<div id="topcontent" style="margin-top:0%">

		<div id="leftcontent" style="margin-top:0%">
			<h1> Cooking Classes </h1>
			<?php echo do_shortcode("[flgallery id=9 /]"); ?>
		</div>

		<div id="centerleftcontent" style="margin-top:-42%">
			<h1> Professional Demos </h1>
			<?php echo do_shortcode("[flgallery id=10 /]"); ?>
		</div>

		<div id="rightcontent" style="margin-top:-42%">
			<h1> Chef Favorites </h1>
			<?php echo do_shortcode("[flgallery id=11 /]"); ?>
		</div>
	</div>	
	
</body>
</html>


