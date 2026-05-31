<?php
/**
	Template Name: templatepg
 */
	global $SMTheme;
	get_header(); 
	
	// ASSIGNING THE URL OF THE CURRENT, HOME, AND REGISTRATION PAGES
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";				
	$madchef = "http://madchefkitchen.com/";
	$regf = "http://madchefkitchen.com/registration/";
	get_template_part('Mobile_Detect.php');
	$detect = new Mobile_Detect();
		
	// CHECKING FOR ANY MOBILE DEVICE.
	if ($detect->isMobile())
	{
		if ($actual_link == "http://madchefkitchen.com/gallery/") 
		{ 
			get_template_part('galleryCell');
		} 
		else if($actual_link == "http://madchefkitchen.com/goodwill/")
		{ 
?>
		<IFRAME src="http://thejvf.org/our-goal/" width="100%" height="110%" align="left"></IFRAME> 
<?php 
		} 
		else if($actual_link == "http://madchefkitchen.com/our-story/")
		{
			get_template_part('our-story');
		}
		else if($actual_link == "http://madchefkitchen.com/our-services/" || $actual_link == "http://madchefkitchen.com/explore/")
		{
			get_template_part('exploreCell');
		}
		else if ($actual_link == "http://madchefkitchen.com/explore/cooking-classes/")
		{
			get_template_part('cooking-classes');
		}
		else if ($actual_link == "http://madchefkitchen.com/contact-us/")
		{
			get_template_part('contact-formCell');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/")
		{
			get_template_part('SignRegCell');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/mngmntmenu/")
		{
			get_template_part('mngmntmenuCell');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/gallerymngmnt/")
		{
			get_template_part('gallerymngmnt');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/classes-management/")
		{
			get_template_part('classEventsCell'); 
		}
		else if($actual_link == "http://madchefkitchen.com/"|| $actual_link == "http://madchefkitchen.com/?redirect=false"|| $actual_link == "http://madchefkitchen.com/class-schedules/")
		{
			get_template_part('formcell');
		}
		else if($actual_link == "http://madchefkitchen.com/home-page/")
		{
			get_template_part('WelcomeCell');
		}
		else if ($actual_link == "http://madchefkitchen.com/hireus/")
		{
			get_template_part('HiringCell');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/catering/")
		{
			get_template_part('catering');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/private-chef-services/")
		{
			get_template_part('privatechef');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/the-personal-chef-services/")
		{
			get_template_part('personalchef');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/demonstrations/")
		{
			get_template_part('demonstrations');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/the-organized-kitchen-service/")
		{
			get_template_part('organizedkitchen');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/recipies/")
		{
			get_template_part('recipeEventsCell');
		}
		else if($actual_link == "http://madchefkitchen.com/chefblog/")
		{
			get_template_part('chefblog');
		}
		else if($actual_link == "http://madchefkitchen.com/our-sponsors/")
		{
			get_template_part('sponsors');
		}
		else if($actual_link == "http://madchefkitchen.com/our-chefs/")
		{
			get_template_part('our-chefs');
		}
		else if($actual_link == "http://madchefkitchen.com/testpage/")
		{
			get_template_part('testpage');
		}
		else if($actual_link == "http://madchefkitchen.com/goodwill/goodwill-community/")
		{
			get_template_part('givingback');
		}
		else if($actual_link == "http://madchefkitchen.com/recipe-2/")
		{
			get_template_part('recipesCell');	
		}
		
		get_template_part('smenucell');	
	}
	else
	{
		get_template_part('theloop');
		get_template_part('smenu');	
		
		if ($actual_link == "http://madchefkitchen.com/gallery/") 
		{ 
			get_template_part('gallery');
		} 
		else if($actual_link == "http://madchefkitchen.com/goodwill/")
		{ 
?>
			<IFRAME src="http://thejvf.org/our-goal/" width="100%" height="110%" align="left"></IFRAME> 
<?php 
	} 
		else if($actual_link == "http://madchefkitchen.com/our-story/")
		{
			get_template_part('our-story');
		}
		else if($actual_link == "http://madchefkitchen.com/our-services/" || $actual_link == "http://madchefkitchen.com/explore/")
		{
			get_template_part('explore');
		}
		
		else if ($actual_link == "http://madchefkitchen.com/explore/cooking-classes/")
		{
			get_template_part('cooking-classes');
		}
		else if ($actual_link == "http://madchefkitchen.com/contact-us/")
		{
			get_template_part('contact-form');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/")
		{
			get_template_part('SignReg');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/mngmntmenu/")
		{
			get_template_part('mngmntmenu');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/gallerymngmnt/")
		{
			get_template_part('gallerymngmnt');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/classes-management/")
		{
			get_template_part('classEvents'); 
		}
		else if($actual_link == "http://madchefkitchen.com/" || $actual_link == "http://madchefkitchen.com/class-schedules/")
		{
			get_template_part('form');
		}
		else if($actual_link == "http://madchefkitchen.com/home-page/")
		{
			get_template_part('Welcome');
		}
		else if ($actual_link == "http://madchefkitchen.com/hireus/")
		{
			get_template_part('Hiring');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/catering/")
		{
			get_template_part('catering');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/private-chef-services/")
		{
			get_template_part('privatechef');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/the-personal-chef-services/")
		{
			get_template_part('personalchef');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/demonstrations/")
		{
			get_template_part('demonstrations');
		}
		else if($actual_link == "http://madchefkitchen.com/explore/the-organized-kitchen-service/")
		{
			get_template_part('organizedkitchen');
		}
		else if($actual_link == "http://madchefkitchen.com/signreg/recipies/")
		{
			get_template_part('recipeEvents');
		}
		else if($actual_link == "http://madchefkitchen.com/chefblog/")
		{
			get_template_part('chefblog');
		}
		else if($actual_link == "http://madchefkitchen.com/our-sponsors/")
		{
			get_template_part('sponsors');
		}
		else if($actual_link == "http://madchefkitchen.com/our-chefs/")
		{
			get_template_part('our-chefs');
		}
		else if($actual_link == "http://madchefkitchen.com/goodwill/goodwill-community/")
		{
			get_template_part('givingback');
		}
		else if($actual_link == "http://madchefkitchen.com/testpage/")
		{
			get_template_part('testpage');
		}
		else if($actual_link == "http://madchefkitchen.com/testpage/usersform/")
		{
			get_template_part('usersForm');
		}
		else if($actual_link == "http://madchefkitchen.com/recipe-2/")
		{
			get_template_part('recipes');	
		}
	}	
	get_footer(); 
?>