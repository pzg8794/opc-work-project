<?php
/**
Template Name: templatepg
 */
?>

<?php

// ASSIGNING THE URL OF THE CURRENT, HOME, AND REGISTRATION PAGES
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";				
$madchef = "http://madchefkitchen.com/";
$regf = "http://madchefkitchen.com/registration/";
$title = "";

?>

<?php
get_header(); ?>


<?php if ($actual_link == "http://madchefkitchen.com/gallery/") { 

?>

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

<?php } else { ?>

<? } ?>

	</div>
	<?php while ( have_posts() ) : the_post(); ?>



<?php if ($actual_link == $madchef) { ?>

	<div id= "title-bar">
		<h1 class="bar-entry-title container"><?php the_title(); ?></h1>
	</div>	

<?php } else if ($actual_link == "http://madchefkitchen.com/gallery/") { ?>

	<div id= "title-bar2">	
		<h1 class="bar-entry-title container"><?php the_title(); ?></h1>
	</div>	

<?php } else { ?>

	<div id= "title-bar1">	
		<h1 class="bar-entry-title container"><?php the_title(); ?></h1>
	</div>	
<? } ?>
	
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

<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>

