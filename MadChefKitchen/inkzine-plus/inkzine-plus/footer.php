<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Inkzine
 */
?>


	<footer id="colophon" class="site-footer row" role="contentinfo">
	<div class="container">
		<div class="site-info col-md-7">
				<?php
					global $option_setting;
				 	echo $option_setting['footer-notice']; 
				 	?>			 		
		</div><!-- .site-info -->
		<?php if ( $option_setting['footermenu-enable'] ) : ?>
			<div id="social-icons" class="col-md-5">
			    <?php if ( $option_setting['facebook'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['facebook'] ) ?>" title="Facebook" ><i class="social-icon fa fa-facebook-square"></i></a>
	             <?php } ?>
	            <?php if ( $option_setting['twitter'] ) { ?>
				 <a href="<?php echo esc_url("http://twitter.com/".$option_setting['twitter'] ) ?>" title="Twitter" ><i class="social-icon fa fa-twitter-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['google'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['google'] ) ?>" title="Google Plus" ><i class="social-icon fa fa-google-plus-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['rss-feed'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['rss-feed'] ) ?>" title="RSS Feeds" ><i class="social-icon fa fa-rss-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['pinterest'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['pinterest'] ) ?>" title="Pinterest" ><i class="social-icon fa fa-pinterest-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['instagram'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['instagram'] ) ?>" title="Instagram" ><i class="social-icon fa fa-instagram"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['linkedin'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['linkedin'] ) ?>" title="LinkedIn" ><i class="social-icon fa fa-linkedin-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['youtube'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['youtube'] ) ?>" title="YouTube" ><i class="social-icon fa fa-youtube-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['flickr'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['flickr'] ) ?>" title="YouTube" ><i class="social-icon fa fa-flickr-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['vimeo'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['vimeo'] ) ?>" title="YouTube" ><i class="social-icon fa fa-vimeo-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['foursquare'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['foursquare'] ) ?>" title="YouTube" ><i class="social-icon fa fa-foursquare"></i></a>
				 <?php if ( $option_setting['tumblr'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['tumblr'] ) ?>" title="YouTube" ><i class="social-icon fa fa-tumblr-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['yelp'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['yelp'] ) ?>" title="YouTube" ><i class="social-icon fa fa-yelp"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['vk'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['vk'] ) ?>" title="YouTube" ><i class="social-icon fa fa-vk-square"></i></a>
	             <?php } ?>
	             <?php if ( $option_setting['dribbble'] ) { ?>
				 <a href="<?php echo esc_url($option_setting['dribbble'] ) ?>" title="YouTube" ><i class="social-icon fa fa-dribbble-square"></i></a>
	             <?php } ?>
	             <?php } ?>
         
	</div>
	<?php endif; ?>
	</div>   
	</footer><!-- #colophon -->
	</div>	
	</div><!-- #footer-sidebar -->
	
	
</div><!-- #content -->
</div><!-- #page -->
<?php echo "<script>".$option_setting['analytics']."</script>"; ?>
<?php wp_footer(); ?>
</body>
</html>