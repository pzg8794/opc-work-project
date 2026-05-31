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

		.quote-container 
		{
	 	 	margin-top: 0%;
			margin-bottom: 0px;
  			margin-left: -0%;
  			position: relative;
		}

		.note 
		{
  			color: black;
 	 		position: relative;
  			width: 100%;
  			margin: 0 auto;
 	 		padding: 10px;
  			font-family: "FontAwesome";
  			font-size: 16px;
			font-weight:bold;
 	 		box-shadow: 0 20px 20px 4px rgba(0,0,0,0.3);
		}

		.note .author 
		{
  			display: block;
 	 		margin: 0px 0 0 0;
  			text-align: right;
			color: brown;
		}	

		.yellow 
		{
  			-webkit-transform: rotate(6deg);
  			-moz-transform: rotate(6deg);
  			-o-transform: rotate(6deg);
 	 		-ms-transform: rotate(6deg);
  			transform: rotate(6deg);
			
  display: block;
  position: relative;
		}	

		.yellow::after {
			
  content: "";
  			background-image: url("http://madchefkitchen.com/wp-content/uploads/2015/10/backg.jpg");
  opacity: 0.3;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
  z-index: -1;   
}

		
		 #leftcont 
		{
			position: absolute;
			left:5%;
			width:33%;
			text-align:center;
			margin-top:5%;
			margin-bottom:0px;
			background:white;
		}
		#centercont 
		{	
			position: absolute;
			left:38%;
			text-align:center;
			width:33%;
			margin-top:5%;
			margin-bottom:0px;
			background:white;
		}

		#rightcont 
		{
			position: absolute;
			left:74%;
			width:33%;
			margin-top:5%;
			text-align:center;
			margin-bottom:0px;
			background:white;
		}
	</style>
</head>
  
<body>
		<div id="content">
			<div id="leftCont">
				<div class="quote-container">
					<i class="pin"></i>
					<blockquote class="note yellow">
						<a href="http://madchefkitchen.com/our-story/"><img src="http://madchefkitchen.com/wp-content/uploads/2015/10/chef.gif" border="0" alt="Our Story"/>
						<span style="font-family: 'Comic Sans MS', sans-serif; font-size: 15pt; color: #8B0000; font-weight: bold;"><br>Our Story<br></span></a>
						
							We can't solve problems by using the same kind of thinking we used when we created them.
						<a href="http://madchefkitchen.com/our-chefs/"/> <cite class="author" > Read More About Us </cite> </a>
					</blockquote>
				</div>
			</div>

			<div id="centerCont">
				<div class="quote-container">
					<i class="pin"></i>
					<blockquote class="note yellow">
						<a href="http://madchefkitchen.com/our-services/"><img src="http://madchefkitchen.com/wp-content/uploads/2015/10/services.gif" border="0" title="Click here for more gifs and graphics"/>
						<span style="font-family: 'Comic Sans MS', sans-serif; font-size: 15pt; font-weight: bold; color: #8B0000;"><br>Our Services <br></span></a>
							We can't solve problems by using the same kind of thinking we used when we created them.
							
						<a href="http://madchefkitchen.com/our-chefs/"/> <cite class="author" > See All We Have to Offer! </cite> </a>
					</blockquote>
				</div>
			</div>

			<div id="rightCont">
				<div class="quote-container">
					<i class="pin"></i>
					<blockquote class="note yellow">
						<a href="http://madchefkitchen.com/our-chefs/"><img src="http://madchefkitchen.com/wp-content/uploads/2015/10/chef1.gif" border="0" />
						<a href="http://madchefkitchen.com/our-chefs/"><img src="http://madchefkitchen.com/wp-content/uploads/2015/10/chef2.gif" border="0" />
						<span style="font-family: 'Comic Sans MS', sans-serif; font-size: 15pt; color: #8B0000; font-weight: bold;"><br>Our Chefs <br></span></a></a>
						<br/>
							We can't solve problems by using the same kind of thinking we used when we created them.
						<a href="http://madchefkitchen.com/our-chefs/"/> <cite class="author"> Learn About Our Chefs </cite> </a>
					</blockquote>
				</div>
			</div>
		</div>
</body>
</html>