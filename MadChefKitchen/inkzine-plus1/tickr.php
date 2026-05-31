<?php
global $option_setting;
$display_tickr = false;
$enabled = $option_setting['tickr-enable']['enabled'];

	if (((isset($enabled['blog']) ) && is_home() ) 
	|| ((isset($enabled['staticpage'])) && is_front_page())
	|| ((isset($enabled['posts'])) && is_single())
	|| ((isset($enabled['archives'])) && is_archive())
	|| ((isset($enabled['pages'])) && is_page()))
	{
		$display_tickr = true;
	}

	if ( $display_tickr )
		{ ?>
    <div id="tickr-wrapper" class="col-md-12 clearfix">
    <div id="tickr-bg">
    <div class="tickr-inner-wrapper container">
    <ul class="bxtickr">
    	<?php
    		$args = array( 'posts_per_page' => $option_setting['tickr-count'], 'category' => implode(",",$option_setting['tickr-cat']) );
			$lastposts = get_posts( $args );
			foreach ( $lastposts as $post ) :
			  setup_postdata( $post ); ?>
			  	<li><a title="<?php the_title(); ?>" href='<?php the_permalink(); ?>'>
			  	<?php the_title(); ?>
			  	</a></li>
			<?php endforeach; 
			wp_reset_postdata(); 
			?>			
     </ul>   
    </div>
    </div>
	</div>
    <?php } 
?>