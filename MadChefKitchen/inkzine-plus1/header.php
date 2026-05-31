<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Inkzine
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php global $option_setting; ?>
	<?php if ($option_setting['favicon']) : ?>
	<link rel="shortcut icon" href="<?php echo $option_setting['favicon']['url']; ?>" />
	<?php endif; ?>
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	<div id="parallax-bg" data-stellar-background-ratio="1.3"></div>
	<div id="page" class="hfeed site">
		<?php get_template_part('tickr'); ?>

		<?php
			include 'Mobile_Detect.php';
			$detect = new Mobile_Detect();
			$desktop = TRUE;
			// CHECKING FOR ANY MOBILE DEVICE.
			if ($detect->isMobile())
			{
				$desktop = FALSE;
			}
			else{}

			// ASSIGNING THE URL OF THE CURRENT, HOME, AND REGISTRATION PAGES
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";				
			$madchef = "http://madchefkitchen.com/";
			$regf = "http://madchefkitchen.com/registration/";
		?>

		<h1 class="logo">
			<a href="<?php bloginfo('home'); ?>/">
			<?php
			if ($actual_link == $madchef)
			{
			?>
				<!-- PLACING THE LOGO IN THE LEFT-TOP CORNER FOR DESKTOP -->
				<?php 	
				if( $desktop == TRUE) 
				{
				?>
					<!-- <?php get_template_part('menu') ?> -->
					<img class="displayed" src="http://madchefkitchen.com/wp-content/uploads/2015/09/mcklogo.png"  width="175" height="61" alt="
					<?php bloginfo('name'); ?>" /></a>
				<?php 
				} 
				else 
				{
				?> 
					<?php get_template_part('menu') ?>
					<!-- PLACING THE LOGO IN THE LEFT-TOP CORNER FOR OTHER DEVICES -->
					<img class="displayed1" src="http://madchefkitchen.com/wp-content/uploads/2015/09/logo.gif"  width="125" height="30" alt="
					<?php bloginfo('name'); ?>" /></a>
				<?php 
				}
				?>
				
			<?php
			} 
			else
			{
			?>
				<!-- PLACING THE LOGO IN THE LEFT-TOP CORNER FOR DESKTOP -->
				<?php 	
				if( $desktop == TRUE) 
				{
				?>	<?php get_template_part('menu') ?>
					<img class="displayed1" src="http://madchefkitchen.com/wp-content/uploads/2015/09/logo.gif"  width="175" height="61" alt="
				<?php 
				} 
				else 
				{
				?> 
					<?php get_template_part('menu') ?>
					<!-- PLACING THE LOGO IN THE LEFT-TOP CORNER FOR OTHER DEVICES -->
					<img class="displayed1" src="http://madchefkitchen.com/wp-content/uploads/2015/09/logo.gif"  width="125" height="30" alt="
				<?php 
				}
				?>
				<?php bloginfo('name'); ?>" /></a>

			<?php
			}
			?>
		</h1>

		<!-- xxx -->

		<?php 	
		if( $desktop == TRUE) 
		{
		?>
			<div id="top-bar">
				<div class="container">
		   			 <div id="primary-nav-wrapper" class="col-md-12 container">
						<nav id="primary-navigation" class="primary-navigation" role="navigation">
							 <h1 class="menu-toggle"><?php _e( 'Menu', 'inkzine' ); ?></h1>
							<div class="screen-reader-text skip-link"><a href="#content"><?php _e( 'Skip to content', 'inkzine' ); ?></a>
							</div> <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?> 
						</nav> <!-- #site-navigation --> 						

					   <!-- </div>
						<div id="fixed-search1"> <?php get_template_part('searchform', 'top') ?>
					   </div> -->	
				</div>
			</div><!--#top-bar-->					
		<?php 
		} 
		else 
		{
		?> 
			<div id="top-bar1">
				<div class="container">
		   			<div id="primary-nav-wrapper" class="col-md-12 container">
					        <nav id="primary-navigation" class="primary-navigation" role="navigation">
							<h1 class="menu-toggle"><?php _e( 'Menu', 'inkzine' ); ?></h1>
							<div class="screen-reader-text skip-link"><a href="#content"><?php _e( 'Skip to content', 'inkzine' ); ?></a>
							</div> <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
						</nav> --> <!-- #site-navigation
					</div>
						<div id="fixed-search"> <?php get_template_part('searchform', 'top') ?>
					</div>	
				</div>
			</div><!--#top-bar-->		
		<?php 
		}
		?>



		<header id="masthead" class="site-header row container" role="banner">
			<div class="site-branding col-md-12">
				<?php global $option_setting;
			 	if (isset($option_setting['logo']['url'])) : ?>
					<?php 
					if( ($option_setting['logo']['url']) ) : ?>
						<h1 class="site-title logo-container">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>
							" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							
							<body>
								<h1>This is a heading</h1>	
								<img src="w3css.gif" width="10" height="140">
								<p>Because the image has a z-index of -1, it will be placed behind the text.</p>
								<?php
								echo "<img class='main_logo' src='".$option_setting['logo']['url']."' 
								title='".esc_attr(get_bloginfo( 'name','display' ) )."'></a>
							</body>
						</h1>";	
					else : ?>
						<!-- TITLE OF PAGES - ASSIGNING THE TITLE IF THE PAGE IS HOME -->
						
						<?php
						if ($actual_link == $madchef)
						{
						?>
							<?php
							if ($desktop == TRUE)
							{
							?>
								<!-- <div id= "title-top">
									<h1 class="bar-entry-title"><?php bloginfo( 'name' ); ?>
									</h1>
								</div>	-->
									<!-- <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="
									<?php echo esc_attr( get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									</h1> -->
								<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
								<?php echo do_shortcode("[huge_it_slider id='2']"); ?>

							<?php
							} 
							else
							{
							?>
								<h1 class="site-title1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="
									<?php echo esc_attr( get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</h1>
								<h2 class="site-description1"><?php bloginfo( 'description' ); ?></h2>	
							<?php
							}
							?>
						<?php
						}
						?>
					<?php	
					endif;
				endif;
				?>
			</div>

			<?php if ($option_setting['enable-social-icons'] ) : ?>
				<?php get_template_part('social'); ?>
			<?php endif; ?>
	
		</header><!-- #masthead -->
	
		<?php 
		if ($desktop == TRUE)
		{
			get_template_part('slider'); 
		}
		else
		{
			get_template_part('slider1');  
		}
		?>

		<?php get_template_part('carousel');?>
	
		<div id="content" class="site-content row">
			<div class="container col-md-12"> 
			</div>