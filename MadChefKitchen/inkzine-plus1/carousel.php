<?php global $option_setting;
$display_carousel = false;
if (isset($option_setting['carousel-enable']['enabled'])) :
$enabled = $option_setting['carousel-enable']['enabled'];

	if (((isset($enabled['blog']) ) && is_home() ) 
	|| ((isset($enabled['staticpage'])) && is_front_page())
	|| ((isset($enabled['posts'])) && is_single())
	|| ((isset($enabled['archives'])) && is_archive())
	|| ((isset($enabled['pages'])) && is_page()))
	{
		$display_carousel = true;
	}
	
if ($display_carousel) :
	if ( count($option_setting['carousel-count']) > 0 ) : ?>
	    <div id="carousel-wrapper" class="container">
	    <ul class="bxcarousel">
	    	<?php
	    		$args = array( 'posts_per_page' => $option_setting['carousel-count'], 'category' => implode(",",$option_setting['carousel-cats']) );
				$lastposts = get_posts( $args );
				foreach ( $lastposts as $post ) :
				  setup_postdata( $post ); ?>
				  	<li><a title="<?php the_title(); ?>" href='<?php the_permalink(); ?>'>
				  	<?php if (has_post_thumbnail()) : 
							$thumb_id = get_post_thumbnail_id();
							$thumb_url = wp_get_attachment_image_src($thumb_id,'carousel-thumb', true);
							echo "<img class='carousel-image' src='".$thumb_url[0]."' title='".get_the_title()."'>";	
						else :
							echo "<img class='carousel-image' src='".get_template_directory_uri()."/images/cthumb.jpg' title='".get_the_title()."'>";	
						endif; ?></a></li>
				<?php endforeach; 
				wp_reset_postdata(); 
			?>	           
	     </ul>   
		</div>
	    
	<?php endif;
endif;
endif;?>