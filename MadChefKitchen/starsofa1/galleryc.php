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
			#leftcont 
			{
				position: relative; 
				left:0%;
				width:33%;
				text-align:center;
				margin-top:0px;
				margin-bottom:0px;
			}
			
			#centercont 
			{	
				position: relative;
				left:0%;
				text-align:center;
				width:33%;
				margin-top:0px;
				margin-bottom:0px;
			}

			#rightcont 
			{
				position: relative;
				left:0%;
				width:33%;
				margin-top:0px;
				text-align:center;
				margin-bottom:0px;
			}
	</style>
</head>
  
<body>
		<div id="topcontent">
			<?php echo do_shortcode("[huge_it_slider id='1']"); ?>
		</div>

		<div id="leftcontent">
			<?php echo photo_gallery(8); ?>
		</div>

		<div id="centerleftcontent">
			<?php echo photo_gallery(8);?>
		</div>

		<div id="centerrightcontent">
			<?php echo photo_gallery(8);?>
		</div>

		<div id="rightcontent">
			<?php echo photo_gallery(8);?>
		</div>
</body>
</html>