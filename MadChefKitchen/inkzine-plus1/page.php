<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Inkzine
 */

get_header(); ?>

	</div>
	<?php while ( have_posts() ) : the_post(); ?>

<?php

// ASSIGNING THE URL OF THE CURRENT, HOME, AND REGISTRATION PAGES
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";				
$madchef = "http://madchefkitchen.com/";
$regf = "http://madchefkitchen.com/registration/";
$title = "";
?>

<?php 
if ($actual_link == $madchef) { ?>
	<div id= "title-bar">
		<h1 class="bar-entry-title container"><?php the_title(); ?></h1>
	</div>	
<?php 
} 
else 
{ ?>
	<div id= "title-bar1">
		<h1 class="bar-entry-title container"><?php the_title(); ?></h1>
	</div>	
<? 
} ?>	

<?php endwhile; ?>	
<div class="container col-md-12"><!-- restart previous section-->
	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>
			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_template_part('showcase'); ?>
<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>
