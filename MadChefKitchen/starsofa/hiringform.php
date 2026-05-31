<?php
/**
	Template Name: Hireform
*/

	global $SMTheme;
	get_header(); 
?>

	<?php
		get_template_part('Mobile_Detect.php');
		$detect = new Mobile_Detect();
		$fm = "form'";
		// CHECKING FOR ANY MOBILE DEVICE.
		if ($detect->isMobile())
		{
			get_template_part('Hiring');
		}
		else
		{
			get_template_part('Hiring');
		}
	?>

	<?php get_footer(); ?>