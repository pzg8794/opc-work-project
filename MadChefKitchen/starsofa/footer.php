<?php global $SMTheme; ?>
  
</div> <!-- / #main_content -->
</div> <!-- / .container -->
</div> <!-- / #content -->

<?php	
	if ($SMTheme->get( 'social', 'showsocial')) {
		$SMTheme->block_social();
	}
?>

<div id='footer'>
	<div class="shadow"> 
		<div class='container clearfix'>
			<?php 
				if ($SMTheme->get("layout","footerwidgets")) 
				{ 
			?>
					<div class='footer-widgets-container'><div class='footer-widgets'>
						<div class='widgetf'>
							<?php 
								if ( !function_exists("dynamic_sidebar") || !dynamic_sidebar("footer_1") ) 
								{
									;
								} 
							?>
						</div>
				
						<div class='widgetf'>
							<?php 
								if ( !function_exists("dynamic_sidebar") || !dynamic_sidebar("footer_2") ) 
								{
									;
								} 
							?>
						</div>
				
						<div class='widgetf widgetf_last'>
							<?php 
								if ( !function_exists("dynamic_sidebar") || !dynamic_sidebar("footer_3") ) 
								{
									;
								} 
							?>
						</div>
					</div>
				</div>
			<?php 
				} 
			?>		
		</div>
	</div>	
	
	<div class='footer_txt'>		
		<div class="shadow"></div>
			<div class='container'>

				<div class='top_text'>
					<?php
                    				if ($SMTheme->get( "layout","footertext" )) 
						{
                        				echo $SMTheme->get( "layout","footertext" );
                    				} 
						else 
						{ 
                        				?>Copyright &copy; <?php echo date("Y"); ?>  <a href="<?php echo home_url(); ?>"><?php bloginfo("name"); ?></a><?php
							echo (get_bloginfo('description'))?' - '.get_bloginfo('description'):'';
                    				}
                			?>
				</div>	<?php /* */ ?>

				<div class='smthemes'>Designed by <a href='#' target='_blank'>Piter Garcia</a>, thanks to: 
					<a href='#' target='_blank'> Dave Matthews</a></div>
				</div>

			</div>	<?php wp_footer(); ?>
		</div> <!-- / #footer -->
	</div> <!-- / #all -->
	
	<?php
		echo $SMTheme->get( "integration","footercode" );
	?>
</body>
</html>