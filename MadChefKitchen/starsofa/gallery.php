<?php
/**
Template Name: gallery
 */
?>


<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>

		<?php
			get_header(); 
			echo do_shortcode("[huge_it_slider id='1']");
			get_template_part('theloop'); 
		?>


</head>
  
<body>
	<div id="topcontent">
	

		<div id="leftcontent">
			<?php echo photo_gallery(10); ?>
		</div>

		<div id="centerleftcontent">
			<?php echo photo_gallery(10); ?>
		</div>

		<div id="centerrightcontent">
			<?php echo photo_gallery(10); ?>
		</div>

		<div id="rightcontent">
			<?php echo photo_gallery(10); ?>
		</div>

	</div>	
	
</body>

	<?php get_footer(); ?>
</html>


