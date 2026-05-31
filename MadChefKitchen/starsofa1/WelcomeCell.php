<?php 
/**
 */
 
?>
<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>
	<!-- CSS CODE FOR THE STRUCTURE OF THE  -->
	<style type ="text/css">

		@import url(http://fonts.googleapis.com/css?family=Satisfy);

		.quote-container 
		{
	 	 	margin-top: -35%;
			margin-bottom: 0px;
  			margin-left: -10%;
  			position: absolute;
		}

		.note 
		{
  			color: #333;
 	 		position: relative;
  			width: 30%;
  			margin: 0 auto;
 	 		padding: 5px;
  			font-family: Satisfy;
  			font-size: 12px;
 	 		box-shadow: 0 20px 20px 4px rgba(0,0,0,0.3);
		}

		.note .author 
		{
  			display: block;
 	 		margin: 10px 0 0 0;
  			text-align: right;
		}	

		.yellow 
		{
  			background: #eae672;
  			-webkit-transform: rotate(6deg);
  			-moz-transform: rotate(6deg);
  			-o-transform: rotate(6deg);
 	 		-ms-transform: rotate(6deg);
  			transform: rotate(6deg);
		}	

		.pin 
		{
  			background-color: #aaa;
  			display: block;
  			height: 16px;
  			width: 3px;
  			position: relative;
  			left: 15%;
  			top: 35px;
 	 		z-index: 1;
		}
	
		.pin:after 
		{
  			background-color: #A31;
  			background-image: radial-gradient(25% 25%, circle, hsla(0,0%,100%,.3), hsla(0,0%,0%,.3));
  			border-radius: 50%;
  			box-shadow: inset 0 0 0 1px hsla(0,0%,0%,.1),
        	      	inset 3px 3px 3px hsla(0,0%,100%,.2),
 	             	inset -3px -3px 3px hsla(0,0%,0%,.2),
        	     	23px 20px 3px hsla(0,0%,0%,.15);
  			content: '';
 	 		height: 12px;
  			left: -5px;
  			position: absolute;
 	 		top: -10px;
  			width: 12px;
		}	

		.pin:before 
		{
	 		background-color: hsla(0,0%,0%,0.1);
  			box-shadow: 0 0 .25em hsla(0,0%,0%,.1);
  			content: '';
	
 		 	height: 12px;
  			width: 2px;
 	 		left: 0;
  			position: absolute;
  			top: 8px;

	  		transform: rotate(57.5deg);
  			-moz-transform: rotate(57.5deg);
  			-webkit-transform: rotate(57.5deg);
  			-o-transform: rotate(57.5deg);
  			-ms-transform: rotate(57.5deg);
	
  			transform-origin: 50% 100%;
  			-moz-transform-origin: 50% 100%;
 	 		-webkit-transform-origin: 50% 100%;
  			-ms-transform-origin: 50% 100%;
  			-o-transform-origin: 50% 100%;
		}
		
		 #leftcont 
		{
			position: absolute;
			left:0%;
			width:33%;
			text-align:center;
			margin-top:6%;
			margin-bottom:0px;
			background:white;
		}
		#centercont 
		{	
			position: absolute;
			left:30%;
			text-align:center;
			width:33%;
			margin-top:6%;
			margin-bottom:0px;
			background:white;
		}

		#rightcont 
		{
			position: absolute;
			left:60%;
			width:33%;
			margin-top:6%;
			text-align:center;
			margin-bottom:0px;
			background:white;
		}
	</style>
</head>
  
<body>
			<div id="leftCont">
				<div class="quote-container">
					<i class="pin"></i>
					<blockquote class="note yellow">
						<a href="http://madchefkitchen.com/our-story/"><img src="http://madchefkitchen.com/wp-content/uploads/2015/10/chef.gif" height="42" width="42" border="0" alt="Our Story"/>
						<span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Our Story<br></span></strong></span></a>
						
							We can't solve problems by using the same kind of thinking we used when we created them.
						<cite class="author"> <a href="http://madchefkitchen.com/our-chefs/"/> Read More About Us </a></cite>
					</blockquote>
				</div>
			</div>

			<div id="centerCont">
				<div class="quote-container">
					<i class="pin"></i>
					<blockquote class="note yellow">
						<a href="http://madchefkitchen.com/our-services/"><img src="http://madchefkitchen.com/wp-content/uploads/2015/10/services.gif" height="42" width="42" border="0" title="Click here for more gifs and graphics"/>
						<span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Our Services <br></span></strong></span></a>
							We can't solve problems by using the same kind of thinking we used when we created them.
							
						<cite class="author"> <a href="http://madchefkitchen.com/our-chefs/"/> See All We Have to Offer! </a></cite>
					</blockquote>
				</div>
			</div>

			<div id="rightCont">
				<div class="quote-container">
					<i class="pin"></i>
					<blockquote class="note yellow">
						<a href="http://madchefkitchen.com/our-chefs/"><img src="http://madchefkitchen.com/wp-content/uploads/2015/10/chef1.gif"  height="42" width="42" border="0" />
						<a href="http://madchefkitchen.com/our-chefs/"><img src="http://madchefkitchen.com/wp-content/uploads/2015/10/chef2.gif"  height="42" width="42" border="0" />
						<span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Our Chefs <br></span></strong></span></a></a>
						<br/>
							We can't solve problems by using the same kind of thinking we used when we created them.
						<cite class="author"> <a href="http://madchefkitchen.com/our-chefs/"/>Learn About Our Chefs </a></cite>
					</blockquote>
				</div>
			</div>
</body>
</html>