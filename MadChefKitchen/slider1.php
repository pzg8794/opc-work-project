<?php global $option_setting;
$display_slider = false;
$enabled = $option_setting['slider-enable']['enabled'];

	if (((isset($enabled['blog']) ) && is_home() ) 
	|| ((isset($enabled['staticpage'])) && is_front_page())
	|| ((isset($enabled['posts'])) && is_single())
	|| ((isset($enabled['archives'])) && is_archive())
	|| ((isset($enabled['pages'])) && is_page()))
	{
		$display_slider = true;
	}

	
if ($display_slider && isset($option_setting['slider-main'])) :
	if ( count($option_setting['slider-main']) > 0 ) : ?>

	<div id="slider-wrapper" class="container">
      
    <ul class="bxslider">
    	<?php
			  		foreach ( $option_setting['slider-main'] as $slider ) {
							echo "<div class='xslide'><a href='".esc_url($slider['url'])."'><img src='".$slider['image']."' title='".$slider['title']."<br>".$slider['description']."'></a></div>";   
					}
	           ?>
	     </ul>   
		</div>
	    
	<?php endif;
endif; ?>