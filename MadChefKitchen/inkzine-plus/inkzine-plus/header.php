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
	<div id="top-bar">
	<div class="container">
		   <div id="primary-nav-wrapper" class="col-md-12 container">
				<nav id="primary-navigation" class="primary-navigation" role="navigation">
					
						<h1 class="menu-toggle"><?php _e( 'Menu', 'inkzine' ); ?></h1>
						<div class="screen-reader-text skip-link"><a href="#content"><?php _e( 'Skip to content', 'inkzine' ); ?></a></div>
			
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					
				</nav><!-- #site-navigation -->
		</div>
		<div id="fixed-search">
			<?php get_template_part('searchform', 'top') ?>
		</div>	
	</div>
	</div><!--#top-bar-->
	<header id="masthead" class="site-header row container" role="banner">
		<div class="site-branding col-md-12">
		<?php global $option_setting;
			 if (isset($option_setting['logo']['url'])) : ?>
					<?php if( ($option_setting['logo']['url']) ) : ?>
				<h1 class="site-title logo-container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php
				echo "<img class='main_logo' src='".$option_setting['logo']['url']."' title='".esc_attr(get_bloginfo( 'name','display' ) )."'></a></h1>";	
			else : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> 
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php	
			endif;
		endif;
		?>
		
		</div>
		<?php if ($option_setting['enable-social-icons'] ) : ?>
			<?php get_template_part('social'); ?>
		<?php endif; ?>
	</header><!-- #masthead -->
	
	<?php get_template_part('slider'); 	?>
	<?php get_template_part('carousel'); 	?>
	
	<div id="content" class="site-content row">
		<div class="container col-md-12"> 
