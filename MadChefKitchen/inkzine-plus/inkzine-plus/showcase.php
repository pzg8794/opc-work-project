<?php
global $option_setting;
$display_showcase = false;
$enabled = $option_setting['showcase-enable']['enabled'];

	if (((isset($enabled['blog']) ) && is_home() ) 
	|| ((isset($enabled['staticpage'])) && is_front_page())
	|| ((isset($enabled['posts'])) && is_single())
	|| ((isset($enabled['archives'])) && is_archive())
	|| ((isset($enabled['pages'])) && is_page()))
	{
		$display_showcase = true;
	}

	if ( $display_showcase )
		{ ?>
	</div>
	<div id="showcase">
	<div class="container">
	<?php
			// WP_Query arguments
			$qa = array (
				'post_type'              => 'post',
				'posts_per_page'		 => $option_setting['sc1-count'],
				'offset'				 => 0,
				'ignore_sticky_posts'    => 1,
				'cat'				     => implode(",",$option_setting['sc1cat'])
	
			);
			
			// The Query
			$recent_articles = new WP_Query( $qa );
			if($recent_articles->have_posts()) : ?>
			<div class="showcase showcase-1 col-md-4 col-sm-4">
			<div class="sc-heading"><?php echo $option_setting['sc1title'] ?></div>
			<ul class="sc">
			<?php
				while($recent_articles->have_posts()) : 
				$recent_articles->the_post();
	         ?>
	         		 
			         <li class='sc-item'>
			         <?php if( has_post_thumbnail() ) : ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></div>
			         <?php 
			         else :
			         ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/nthumb.png"></a></div>
			         <?php
			         endif; ?>	
			         <div class='sc-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			         <div class='sc-date'><?php the_time('M j, Y'); ?></div>
			         </li>      
			      
			<?php
			      endwhile;
			   else: 
			?>
			
			      Oops, there are no posts.
			
			<?php
			   endif;
			?>
			</ul>
			</div>
			
			<?php
			//Second Showcase
	
			// WP_Query arguments
			$qa = array (
				'post_type'              => 'post',
				'posts_per_page'		 => $option_setting['sc2-count'],
				'offset'				 => 0,
				'ignore_sticky_posts'    => 1,
				'cat'				     => implode(",",$option_setting['sc2cat'])
	
			);
			
			// The Query
			$recent_articles = new WP_Query( $qa );
			if($recent_articles->have_posts()) : ?>
			<div class="showcase showcase-2 col-md-4 col-sm-4">
			<div class="sc-heading"><?php echo $option_setting['sc2title']?></div>
			<ul class="sc">
			<?php
				while($recent_articles->have_posts()) : 
				$recent_articles->the_post();
	         ?>
	         		 
			         <li class='sc-item'>
			         <?php if( has_post_thumbnail() ) : ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></div>
			         <?php 
			         else :
			         ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/nthumb.png"></a></div>
			         <?php
			         endif; ?>	
			         <div class='sc-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			         <div class='sc-date'><?php the_time('M j, Y'); ?></div>
			         </li>      
			      
			<?php
			      endwhile;
			   else: 
			?>
			
			      Oops, there are no posts.
			
			<?php
			   endif;
			?>
			</ul>
			</div>
			<?php
			
			//THIRD SHOWCASE
			
			// WP_Query arguments
			$qa = array (
				'post_type'              => 'post',
				'posts_per_page'		 => $option_setting['sc3-count'],
				'offset'				 => 0,
				'ignore_sticky_posts'    => 1,
				'cat'				     => implode(",",$option_setting['sc3cat'])
	
			);
			
			// The Query
			$recent_articles = new WP_Query( $qa );
			if($recent_articles->have_posts()) : ?>
			<div class="showcase showcase-3 col-md-4 col-sm-4">
			<div class="sc-heading"><?php echo $option_setting['sc3title']  ?></div>
			<ul class="sc">
			<?php
				while($recent_articles->have_posts()) : 
				$recent_articles->the_post();
	         ?>
	         		 
			         <li class='sc-item'>
			         <?php if( has_post_thumbnail() ) : ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></div>
			         <?php 
			         else :
			         ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/nthumb.png"></a></div>
			         <?php
			         endif; ?>	
			         <div class='sc-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			         <div class='sc-date'><?php the_time('M j, Y'); ?></div>
			         </li>      
			      
			<?php
			      endwhile;
			   else: 
			?>
			
			      Oops, there are no posts.
			
			<?php
			   endif;
			?>
			</ul>
			</div>
	</div>
	</div><!--#showcase-->
	<div class="container">
<?php } ?>	