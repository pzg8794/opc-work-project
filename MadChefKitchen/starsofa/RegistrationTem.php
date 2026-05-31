<?php 
/**
Template Name: registrationTem
 */
	global $SMTheme;
	get_header(); 
	get_template_part('theloop'); 
?>


<?php
	get_template_part('Mobile_Detect.php');
	$detect = new Mobile_Detect();
	$desktop = "'form'";
	// CHECKING FOR ANY MOBILE DEVICE.
	if ($detect->isMobile())
	{
?>
		<div id="content">
			<div id="LeftCont">
				<a href="http://madchefkitchen.com"><img class="size-medium wp-image-1154" src="http://madchefkitchen.com/wp-content/uploads/2014/09/hireachef-e1440732475302-130x130.jpeg" alt="Hire a Chef" width="80" height="80" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 5pt; color: #ff0000;"><br>Hire a Chef</span></strong></span>

				<a href="http://madchefkitchen.com"><img class="size-medium wp-image-1036" src="http://madchefkitchen.com/wp-content/uploads/2014/09/gallery-134x130.jpg" alt="Photo Gallery" width="80" height="80" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 5pt; color: #ff0000;"><br>Photo Gallery</span></strong></span>
			</div>

			<div id="CenterCont">
				<a href="http://madchefkitchen.com/class-schedules/"><img class="size-medium wp-image-1015" src="http://madchefkitchen.com/wp-content/uploads/2014/09/class-schedule-224x130.jpg" alt="Class Schedules" width="80" height="80" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 5pt; color: #ff0000;">Class Schedules</span></strong></span>

				<a href="http://madchefkitchen.com"><img class="size-medium wp-image-1034" src="http://madchefkitchen.com/wp-content/uploads/2014/09/blogdaily-153x130.jpg" alt="Blog Daily" width="80" height="80" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 5pt; color: #ff0000;"><br>Blog Daily</span></strong></span>
			</div>

			<div id="RightCont">
				<a href="http://madchefkitchen.com"><img class="size-full wp-image-1153" src="http://madchefkitchen.com/wp-content/uploads/2015/08/20150619_181518-e1442449008750.jpg" alt="Sandwich Shop" width="80" height="80" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 5pt; color: #ff0000;">Sandwich Shop</span></strong></span>

				<a href="http://madchefkitchen.com/mckstore/"><img class="size-thumbnail wp-image-425" src="http://madchefkitchen.com/wp-content/uploads/2014/08/20140427_1451001-150x150.jpg" alt="Online Shop" width="80" height=" 80" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 5pt; color: #ff0000;"><br>Online Shop</span></strong></span>
			</div>
		</div>

<?php	}
	else
	{
?>
		<div id="content">
			<div id="LeftCont">
				<a href="http://madchefkitchen.com/hireus/"><img class="size-medium wp-image-1154" src="http://madchefkitchen.com/wp-content/uploads/2014/09/hireachef-e1440732475302-130x130.jpeg" alt="Hire a Chef" width="130" height="130" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Hire a Chef<br></span></strong></span>

				<a href="http://madchefkitchen.com"><img class="size-medium wp-image-1036" src="http://madchefkitchen.com/wp-content/uploads/2014/09/gallery-134x130.jpg" alt="Photo Gallery" width="134" height="130" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Photo Gallery<br></span></strong></span>
			</div>

			<div id="CenterCont">
				<a href="http://madchefkitchen.com/class-schedules/"><img class="size-medium wp-image-1015" src="http://madchefkitchen.com/wp-content/uploads/2014/09/class-schedule-224x130.jpg" alt="Class Schedules" width="224" height="130" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Class Schedules<br></span></strong></span>

				<a href="http://madchefkitchen.com"><img class="size-medium wp-image-1034" src="http://madchefkitchen.com/wp-content/uploads/2014/09/blogdaily-153x130.jpg" alt="Blog Daily" width="153" height="130" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Blog Daily<br></span></strong></span>
			</div>

			<div id="RightCont">
				<a href="http://madchefkitchen.com"><img class="size-full wp-image-1153" src="http://madchefkitchen.com/wp-content/uploads/2015/08/20150619_181518-e1442449008750.jpg" alt="Sandwich Shop" width="228" height="129" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Sandwich Shop<br></span></strong></span>

				<a href="http://madchefkitchen.com/mckstore/"><img class="size-thumbnail wp-image-425" src="http://madchefkitchen.com/wp-content/uploads/2014/08/20140427_1451001-150x150.jpg" alt="Online Shop" width="130" height="130" /></a> <span style="font-family: 'Comic Sans MS', sans-serif;"><strong><span style="font-size: 15pt; color: #ff0000;"><br>Online Shop<br></span></strong></span>
			</div>
		</div>
<?php
	}
?>





			

			<?php get_footer(); ?>