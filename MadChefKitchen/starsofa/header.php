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


	<body <?php $class=$SMTheme->block_slider_css(); $class.=' '.$SMTheme->sidebars_type; body_class( $class ); ?> layout='<?php echo $SMTheme->layout; ?>'>
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

		<?php
			/**
 			* browser()
 			* Returns browser information in a string
 			* Compatible with Chrome, Internet Explorer, Firefox, Safari and Opera
 			* This settings are according to the superglobal SERVER
 			* @return string Name & Version
 			*/
		
			function browser()
			{
    				$user_agent = $_SERVER['HTTP_USER_AGENT'];
    				$browsers = array(
                        		'Chrome' => array('Chrome'		, 'Chrome/(.*)\s'	),
                        		'MSIE' 	 => array('Internet Explorer'	, 'MSIE\s([0-9\.]*)'	),
                        		'Firefox'=> array('Firefox'  		, 'Firefox/([0-9\.]*)'	),
                        		'Safari' => array('Safari'   		, 'Version/([0-9\.]*)'	),
                        		'Opera'  => array('Opera'    		, 'Version/([0-9\.]*)'	),
					'Trident'=> array('Trident'		, 'Version/([0-9\.]*)'	)
                        	);          
    			
				$browser_details = array();
        			foreach ($browsers as $browser => $browser_info)
				{
            				if (preg_match('@'.$browser.'@i', $user_agent))
					{
                				$browser_details['name'] = $browser_info[0];
                    				preg_match('@'.$browser_info[1].'@i', $user_agent, $version);
                				$browser_details['version'] = $version[1];
                    				break;
            				} 
					else 
					{
                				$browser_details['name']    = 'Unknown';
                				$browser_details['version'] = 'Unknown';
            				}
        			}
				//Version: '.$browser_details['version']
    				return $browser_details['name'];
			}     
			// Example of use
			//echo $_SERVER['HTTP_USER_AGENT'];
			//echo browser();
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

						<?php 
							if (browser() == "Chrome")
							{ 
						?>
								<div id="top-menu"> 
						<?php 	} 
							else
							{ 
						?>
								<div id="top-menu1"> 
						<?php 	} 
							
							wp_nav_menu(array( 
								'depth'=>0,
								'theme_location' => 'sec-menu',
								'menu_class'    => 'menus menu-topmenu',
								'fallback_cb'=>'block_sec_menu'
							));
						?>
					</div>	
					<!-- / Top Menu -->					
					
					<div class="clear"></div>					
					<!-- <?php smt_mobile_menu('sec-menu'); ?> --> 
					<?php smt_mobile_menu('main-menu'); ?>				
				</div>
			</div>	
			
			<!-- Slider -->					
			<?php
				// CHECKING FOR ANY MOBILE DEVICE.
				if ($actual_link == $madchef)
				{
					if ((is_front_page()&&$SMTheme->get( 'slider', 'homepage'))||(!is_front_page()&&$SMTheme->get( 'slider', 'innerpage'))) 
					{
						get_template_part( 'slider' );
					} 					
				}else{}
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