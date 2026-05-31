<?php
	global $SMTheme;
	
	
	if ( isset($_POST['ajaxpage'])&&$_POST['ajaxpage']=='1' ) {
		ob_start();
		get_template_part('theloop');
		get_template_part('navigation');
		$return['content']=ob_get_contents();
		ob_end_clean();
		header('Content-type: application/json');
		echo json_encode($return);
		die();
	}
	$SMTheme->get_layout();
	
	

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width" />
	
		<title><?php wp_title( false ); ?></title>
		<?php	$SMTheme->seo(); ?>
		<?php  wp_head(); ?>
	
		<style type="text/css">
			<?php echo $SMTheme->get( 'integration','css' )?>
		</style>
	
		<?php echo $SMTheme->get( 'integration','headcode' ); ?>
		<script>
			jQuery(window).bind('scroll',function(e){
				parallaxScroll();
			});

			function parallaxScroll(){
				var scrolled = jQuery(window).scrollTop();
				jQuery('.triangle-1').css('top',(0+(scrolled*.55))+'px');
				jQuery('.triangle-2').css('top',(0+(scrolled*.11))+'px');
				jQuery('.triangle-3').css('top',(0+(scrolled*.88))+'px');
			}
		</script>	
		
		
	</head>


	<body 
		<?php $class=$SMTheme->block_slider_css(); $class.=' '.$SMTheme->sidebars_type; body_class( $class ); ?> layout='<?php echo $SMTheme->layout; ?>'>
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
			$gallery = "http://madchefkitchen.com/gallery/";
			$regf = "http://madchefkitchen.com/registration/";
		?>

		<div id='scrollUp'><img src='<?php echo get_template_directory_uri().'/images/smt/arrow-up.png';?>' alt='Up' title='Scroll window up' /></div>		
		<div id='all'>
			<div id='header'>
				<div id="top-header">	
					<div class='container clearfix'>
						<!-- Logo -->
						<div id="logo">
							<?php $SMTheme->block_logo();?>								
						</div>
						<!-- Logo -->
										
						<!-- Top Menu -->

						<div id="top-menu1"> 
						<?php 	
						
						if( $desktop == TRUE)
						{
							wp_nav_menu(array( 
								'depth'=>0,
								'theme_location' => 'sec-menu',
								'menu_class'    => 'menus menu-topmenu',
								'fallback_cb'=>'block_sec_menu'
							));
						}
						?>
						</div>
					</div>	
					<!-- / Top Menu -->					
					
					<div class="clear"></div>					
					<!-- <?php smt_mobile_menu('sec-menu'); ?> --> 
					<?php 
						//if( $desktop == TRUE)
						//{
					?>	
					<?php smt_mobile_menu('main-menu'); 
						//}
					?>				
				</div>
			</div>	
			
			<!-- Slider -->					
			<?php
				// CHECKING FOR ANY MOBILE DEVICE.
				if ($actual_link == $madchef || $actual_link == "http://madchefkitchen.com/?redirect=false")
				{
					if ((is_front_page()&&$SMTheme->get( 'slider', 'homepage'))||(!is_front_page()&&$SMTheme->get( 'slider', 'innerpage'))) 
					{
						get_template_part( 'slider' );
					} 					
				}
				else if ($actual_link == $gallery)
				{
					//echo do_shortcode("[huge_it_slider id='1']");
				}
			?>
			
			<!-- / Slider -->		
			<div id='main-menu-container'>			
				<div class='container clearfix'>
					<?php 
						if( $desktop == FALSE)
						{ 
					?>		
							<!-- Main Menu -->
							<div id='main-menu'>
								<?php 
									wp_nav_menu(array(
										'depth'=>0,
										'theme_location'=>'main-menu',
										'menu_class'=>'menus menu-primary',
										'fallback_cb'=>'block_main_menu'
									)); 
								?>
							</div>
							<!-- / Main Menu -->
					<?php 
						} 
					?> 

					<!-- Search -->
					<div class="headersearch" title="">
						<?php get_search_form();?>						
					</div>
					<!-- / Search -->
				</div>			
			</div>
		</div>

		<div id='content'>
			<div id='triangles'>
				<div class='triangle-1'></div>
				<div class='triangle-2'></div>
				<div class='triangle-3'></div>
			</div> 
				
			<div class='container clearfix'>
				<?php get_sidebar(); ?> 
				<div id="main_content">