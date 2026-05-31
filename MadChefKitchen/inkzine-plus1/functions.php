<?php
/**
 * Inkzine functions and definitions
 *
 * @package Inkzine
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/**
 * Initialize Options Panel
 */
	require_once get_template_directory() . '/redux/admin/admin-init.php';
	require_once get_template_directory() . '/options.php';
	global $option_setting;

if ( ! function_exists( 'inkzine_setup' ) ) :

function inkzine_setup() {

	load_theme_textdomain( 'inkzine', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size('homepage-banner',725,400,true);
	add_image_size('carousel-thumb',390,240,true);
	add_image_size('grid-thumb',390,300,true);

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'inkzine' )
	) );

	add_theme_support( 'custom-background', apply_filters( 'inkzine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'post-formats', array( 'image', 'video' ) );
}
endif; // inkzine_setup
add_action( 'after_setup_theme', 'inkzine_setup' );

function inkzine_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'inkzine' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'inkzine' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Center', 'inkzine' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'inkzine' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'inkzine_widgets_init' );

function inkzine_scripts() {

	global $option_setting;


	wp_enqueue_style( 'inkzine-fonts', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,300italic|Armata' );
	wp_enqueue_style( 'inkzine-basic-style', get_stylesheet_uri() );
	if ( (function_exists( 'of_get_option' )) && (of_get_option('sidebar-layout', true) != 1) ) {
		if (of_get_option('sidebar-layout', true) ==  'right') {
			wp_enqueue_style( 'inkzine-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
		}
		else {
			wp_enqueue_style( 'inkzine-layout', get_template_directory_uri()."/css/layouts/sidebar-content.css" );
		}	
	}
	else {
		wp_enqueue_style( 'inkzine-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
	}
		
	wp_enqueue_style( 'inkzine-bxslider-style', get_template_directory_uri()."/css/bxslider/jquery.bxslider.css" );
		
	wp_enqueue_style( 'inkzine-bootstrap-style', get_template_directory_uri()."/css/bootstrap/bootstrap.min.css", array('inkzine-layout') );
		
	wp_enqueue_style( 'inkzine-main-style', get_template_directory_uri()."/css/skins/main.css", array('inkzine-layout','inkzine-bootstrap-style') );
	
	wp_enqueue_script( 'inkzine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'inkzine-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
			
	wp_enqueue_script( 'inkzine-sliphover', get_template_directory_uri() . '/js/sliphover.js', array('jquery') );
				
	wp_enqueue_script( 'inkzine-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );
		
	wp_enqueue_script( 'inkzine-bxslider', get_template_directory_uri() . '/js/bxslider.min.js', array('jquery') );
	
	if ( $option_setting['responsive-menu'] == 'advanced' ) :
		wp_enqueue_script( 'inkzine-mm', get_template_directory_uri() . '/js/mm.js', array('jquery') );
	endif;
	
	wp_enqueue_script( 'inkzine-stellar', get_template_directory_uri() . '/js/stellar.js', array('jquery') );
	
	wp_enqueue_script( 'inkzine-custom', get_template_directory_uri() . '/js/custom.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'inkzine-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'inkzine_scripts' );

function inkzine_custom_head_codes() {
	global $option_setting;
 if ( (function_exists( 'of_get_option' )) && (of_get_option('headcode1', true) != 1) ) {
	echo of_get_option('headcode1', true);
 }
 if ( (function_exists( 'of_get_option' )) && (of_get_option('style2', true) != 1) ) {
	echo "<style>".of_get_option('style2', true)."</style>";
 }
 
 switch($option_setting['sidebar-layout']) {
		case 1:
			echo "<style>#primary,#primary-mono { width: 98%; } #secondary { display: none; }</style>";
			break;
		case 2:
			echo "<style>#primary { float: right; } #secondary { float: left; }</style>";
			break;	
	}
	
	//Set up Fonts
	if(isset($option_setting['title-font'])) :
		echo "<Style>body,#top-nav #site-navigation a, #slider-wrapper .slider-caption .slider-caption-title,#slider-wrapper .slider-caption .slider-caption-desc, .site-description, #primary-navigation a, .artmain .main-article p { font-family: '".$option_setting['body-font']['font-family']."' ;} </style> ";
		
		echo "<style>#masthead .site-title a, #home-title, #primary article.grid2 .out-thumb h1.entry-title a, #footer-sidebar h1.widget-title, #secondary h1.widget-title, #primary article.grid h1.entry-title, #primary-mono h1.entry-title, #comments h2.comments-title , .archive section#primary h1.page-title span, article h1, article h2, article h3,.header-title span { font-family: '".$option_setting['title-font']['font-family']."';}</style>";	
		
		echo "<style>#footer-sidebar, #footer-sidebar a, #colophon, #colophon a { font-family: '".$option_setting['footer-font']['font-family']."';}</style>";
	
	endif;
 
 if (isset($option_setting['site-layout'])) :
		if ($option_setting['site-layout'] == 'boxed') 
			echo "<style>#page { max-width: 1220px; margin: auto; box-shadow: 0 0 5px #8a8a8a; background: white }.bx-wrapper .bx-viewport { box-shadow: none; }#masonry { margin-left: 5px; }</style>";
	endif;
 	
 if ( $option_setting['responsive-menu'] == 'advanced' ) :
 	echo "<style>h1.menu-toggle { display: none !important; } .td_mobile_menu_wrap { padding: 15px }</style>";
 endif;	
 
 if ( $option_setting['pattern']['url'] ) :
 	echo "<style> #tickr-wrapper, #footer-sidebar, #title-bar { background: repeat url(".$option_setting['pattern']['url'].") } </style>";
 endif;
 
 echo "<style>".$option_setting['custom-css']."</style>";
 
 echo "<script>".$option_setting['custom-js']."</script>";
 
 //Check if Slider is Enabled and Load Script
?>		<script>
		jQuery(document).ready(function(){
			jQuery('.bxslider').bxSlider( {
						mode: '<?php echo $option_setting['slider-mode'] ?>',
						easing: '<?php echo $option_setting['slider-ease'] ?>',
						speed: <?php echo $option_setting['slider-transition-speed'] ?>,
						randomStart: <?php echo $option_setting['slider-randomstart'] ?>,
						captions: true,
						minSlides: 1,
						maxSlides: 1,
						slideWidth: 1145,
						adaptiveHeight: true,
						nextText: '<i class="fa fa-angle-right"></i>',
						prevText: '<i class="fa fa-angle-left"></i>',
						pager: <?php echo $option_setting['slider-pager'] ?>,
						auto: <?php echo $option_setting['slider-autoplay'] ?>,
						preloadImages: '<?php echo ($option_setting['slider-preload']) ? 'all' : 'visible'; ?>',
						pause: <?php echo $option_setting['slider-pause'] ?>,
						autoHover: true } );
						});
			</script>			
	<?php
	
	if (isset($option_setting['carousel-enable']['enabled'])) : ?>
		<script>
		jQuery(document).ready(function(){
					jQuery('.bxcarousel').bxSlider( {
					mode: 'horizontal',
					speed: 1000,
					captions: true,
					minSlides: 1,
					maxSlides: 3,
					moveSlides: 2,
					slideWidth: 377,
					slideMargin: 3,
					adaptiveHeight: false,
					auto: true,
					preloadImages: 'all',
					pause: 5000,
					autoHover: true } );
					});
			</script>		
					
	<?php endif; 
}	
add_action('wp_head', 'inkzine_custom_head_codes');

function inkzine_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_page_menu_args', 'inkzine_nav_menu_args' );

function inkzine_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates. Import Widgets
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/widgets/gallery.php';
require get_template_directory() . '/inc/widgets/video.php';
require get_template_directory() . '/inc/widgets/facebook.php';
require get_template_directory() . '/inc/widgets/comments.php';
require get_template_directory() . '/inc/tgm-activate.php';
/**
 * Custom Menu For Bootstrap
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
