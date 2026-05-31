<?php
/**
	Template Name: Hireform
*/

	global $SMTheme;
	get_header(); 

	get_template_part('Mobile_Detect.php');
	$detect = new Mobile_Detect();
	$fm = "form'";
	// CHECKING FOR ANY MOBILE DEVICE.
	if ($detect->isMobile())
	{
		get_template_part('HiringCell');
	}
	else
	{
		get_template_part('Hiring');
	}

	get_footer(); 
?>