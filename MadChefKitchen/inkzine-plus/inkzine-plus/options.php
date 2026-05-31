<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'inkzine'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'inkzine'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../config/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../config/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'inkzine'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'inkzine'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'inkzine'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'inkzine') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'inkzine'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            	$this->sections[] = array(
                'title'     => __('Basic Settings', 'inkzine'),
                'icon'      => 'el-icon-puzzle',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                	array(
                        'id'        => 'logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Logo', 'inkzine'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Enabling Logo will Disable the default title and description.', 'inkzine'),
                        'subtitle'  => __('Upload any Image. It will not be resized Automatically.', 'inkzine'),
                        'default'   => '',
                    ),
                    array(
                        'id'        => 'favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Favicon', 'inkzine'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Recommended: Upload a 32px by 32px .ico image. Other Sizes and Formats are also acceptable.', 'inkzine'),
                        'subtitle'  => __('Add a Favicon for your site.', 'inkzine'),
                        'default'   => '',
                    ),
                     array(
                        'id'        => 'site-layout',
                        'type'      => 'button_set',
                        'title'     => __('Site Layout', 'inkzine'),
                        'subtitle'  => __('Choose Between Full Width and Boxed Layout.', 'inkzine'),
                        'desc'      => __('Default is Full Width. Boxed Layout will give a maximum fixed with of 1200px. Your theme will be responsive in both the cases.', 'inkzine'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            'full' => 'Full Width', 
                            'boxed' => 'Boxed'
                        ), 
                        'default'   => 'full'
                     ),
                     array(
                        'id'        => 'responsive-menu',
                        'type'      => 'button_set',
                        'title'     => __('Responsive Navigation', 'inkzine'),
                        'subtitle'  => __('Choose Between Default and Advanced Responsive Navigation.', 'inkzine'),
                        'desc'      => __('Advanced will convert Nav Menu into a Select Based system, with support for submenus.', 'inkzine'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            'advanced' => 'Advanced', 
                            'old' => 'Default'
                        ), 
                        'default'   => 'advanced'
                     ),
                    ),
                    
                  );
             
            //LAYOUT SETTINGS
            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('Layout Settings', 'inkzine'),
                'fields'    => array(
	                array(
	                        'id'        => 'footermenu-enable',
	                        'type'      => 'switch',
	                        'title'     => __('Enable Footer Social Icons', 'inkzine'),
	                        'subtitle'  => __('This Enables a Social Icons in Footer. Enabled by Default.', 'inkzine'),
	                        'default' => true,
	                ),
	                array(
	                        'id'        => 'sidebar-warning',
	                        'type'      => 'info',
	                        'notice'    => true,
	                        'style'     => 'warning',
	                        'title'     => __('Understanding Sidebars', 'inkzine'),
	                        'desc'      => __('This theme Supports 1 Sidebar, which you can choose to entirely remove or place it on right or left side of the site. If you want separate sidebars for Individual Pages, or all Pages, then please use the <a href="http://wordpress.org/plugins/simple-page-sidebars/">Simple Sidebars Plugin</a>. There is no Sidebar for Homepage.', 'inkzine')
	                    ), 
                    array(
                        'id'        => 'sidebar-layout',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => __('Home Layout', 'inkzine'),
                        'subtitle'  => __('Select main content and sidebar alignment. Sidebars not supported on the Home Page. Choose between 1, 2 or 3 column layout.', 'inkzine'),
                        'options'   => array(
                            '1' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                            '2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            '3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                        ),
                        'default'   => '3'
                    ),
                    array(
                        'id'        => 'footer-notice',
                        'type'      => 'editor',
                        'title'     => __('Footer Text', 'inkzine'),
                        'subtitle'  => __('Enter your Custom Message or Copyright Notice in Left Footer Area.', 'inkzine'),
                        'desc'  => __('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'inkzine'),
                        'default'   => '',
                    ),
                 ),
              );       


			  //FONTS
			  
			  $this->sections[] = array(
                'title'     => __('Fonts', 'inkzine'),
                'icon'      => 'el-icon-fontsize',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
              		array(
                            'id'       => 'body-font',
                            'type'     => 'typography',
                            'title'    => __( 'Body Font', 'inkzine' ),
                            'subtitle' => __( 'Specify the body font properties. Default: Lato', 'inkzine' ),
                            'font-size'=>false,
                            'line-height' =>false,
                            'font-style'=>false,
                            'google'   => true,
                            'text-align'=>false,
                            'font-weight'=>false,
                            'color'=>false,
                            'default'  => array(
                                'font-family' => 'Lato',
                            ),
                        ),
                    array(
                            'id'       => 'title-font',
                            'type'     => 'typography',
                            'title'    => __( 'Title Font', 'inkzine' ),
                            'subtitle' => __( 'Specify the font properties for Title areas of the site. Like Site Title, Post Title, Widget Titles, etc. Default: Armata', 'inkzine' ),
                            'font-size'=>false,
                            'line-height' =>false,
                            'font-style'=>false,
                            'google'   => true,
                            'text-align'=>false,
                            'font-weight' => false,
                            'color'=>false,
                            'default'  => array(
                                'font-family' => 'Armata',
                            ),
                        ),
                     array(
                            'id'       => 'footer-font',
                            'type'     => 'typography',
                            'title'    => __( 'Footer Font', 'inkzine' ),
                            'subtitle' => __( 'Specify the font properties for Footer area. Default: Maven Pro', 'inkzine' ),
                            'font-size'=>false,
                            'line-height' =>false,
                            'font-style'=>false,
                            'google'   => true,
                            'text-align'=>false,
                            'font-weight' => false,
                            'color'=>false,
                            'default'  => array(
                                'font-family' => 'Maven Pro',
                            ),
                        ),     
                ),
              );


            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('Slider', 'inkzine'),
                'icon'      => 'el-icon-picture',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                		array(
	                        'id'        => 'slider-enable',
	                        'type'      => 'sorter',
	                        'title'     => 'Enable Slider',
	                        'subtitle'      => 'Choose Pages where you want to display the Slider.',
	                        'compiler'  => 'true',
	                        'options'   => array(
	                            'disabled'  => array(
	                                'pages'    => 'Pages',
	                                'posts'        => 'Posts',
	                                'archives' => 'Archives',
	                                'staticpage'    => 'Static Front Page',
	                                'blog'      => 'Blog'
	                            ),
	                            'enabled'   => array(),
	                        ),
	                    ),
                        
	                	array(
	                        'id'        => 'slider-main',
	                        'type'      => 'slides',
	                        'title'     => __('Slides Options', 'inkzine'),
	                        'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'inkzine'),
	                        'desc'      => __('', 'inkzine'),
	                        'placeholder'   => array(
	                            'title'         => __('Slide Title', 'inkzine'),
	                            'url'           => __('URL you want to Link.', 'inkzine'),
	                        ),
	                    ),
	                     array(
	                        'id'        => 'slider-mode',
	                        'type'      => 'select',
	                        'title'     => __('Slider Mode', 'inkzine'),
	                        'desc'      => __('Select how the Slider switches from one Slide to Another.', 'inkzine'),
	                        //Must provide key => value pairs for select options
	                        'options'   => array(
	                            'fade' => 'Fade',
	                            'horizontal' => 'Slide',
	                        ),
	                        'default'   => 'fade'
                        ), 
                        array(
	                        'id'        => 'slider-randomstart',
	                        'type'      => 'switch',
	                        'title'     => __('Random Start', 'inkzine'),
	                        'subtitle'  => __('Start the slideshow from a Random Slide.', 'inkzine'),
	                        'default' => 0,
	                    ),
                        array(
	                        'id'            => 'slider-transition-speed',
	                        'type'          => 'slider',
	                        'title'         => __('Transition Duration', 'inkzine'),
	                        'desc'          => __('Set the Transition Speed at which Slider switch from One Slide to Another.', 'inkzine'),
	                        'default'       => 500,
	                        'min'           => 100,
	                        'step'          => 100,
	                        'max'           => 3000,
	                        'display_value' => 'text'
	                    ),
	                    array(
	                        'id'            => 'slider-pause',
	                        'type'          => 'slider',
	                        'title'         => __('Slide Duration', 'inkzine'),
	                        'desc'          => __('Set the time for which Each Slide should be displayed.', 'inkzine'),
	                        'default'       => 5000,
	                        'min'           => 500,
	                        'step'          => 250,
	                        'max'           => 15000,
	                        'display_value' => 'text'
	                    ),
	                    array(
	                        'id'        => 'slider-ease',
	                        'type'      => 'select',
	                        'title'     => __('Easing Effect', 'inkzine'),
	                        'subtitle'  => __('Select the type of animation effect you want.', 'inkzine'),
	                        'desc'      => __('This effect is more clearly visible if you have set the slider to Slide mode, instead of fade.', 'inkzine'),
	                        
	                        //Must provide key => value pairs for select options
	                        'options'   => array(
	                            'ease' => 'Ease', 
	                            'linear' => 'Linear', 
	                            'ease-out' => 'Ease Out',
	                            'ease-in' => 'Ease In',
	                            'ease-in-out' => 'Ease In Out',
	                        ),
	                        'default'   => 'ease'
	                    ),
	                    array(
	                        'id'        => 'slider-autoplay',
	                        'type'      => 'switch',
	                        'title'     => __('Autoplay', 'inkzine'),
	                        'subtitle'  => __('Enable Auto play to Transition Slides Automatically. If OFF, slides will change only when next or previous buttons are clicked.', 'inkzine'),
	                        'default' => 1,
	                    ), 
	                    array(
	                        'id'        => 'slider-pager',
	                        'type'      => 'switch',
	                        'title'     => __('Show Pager', 'inkzine'),
	                        'subtitle'  => __('Turning this off, will remove the Small rectangles on top right corner of the slides.', 'inkzine'),
	                        'default' => 1,
	                    ),  
	                    array(
	                        'id'        => 'slider-preload',
	                        'type'      => 'switch',
	                        'title'     => __('Preload Images', 'inkzine'),
	                        'subtitle'  => __('If ON, it will load all images before starting the slider. Otherwise, the slider will be visible when first image is loaded.', 'inkzine'),
	                        'default' => 0,
	                    ),	                    

                    ), 
             );
             
             
              // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('Ticker', 'inkzine'),
                'icon'      => 'el-icon-text-width',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                		array(
	                        'id'        => 'tickr-enable',
	                        'type'      => 'sorter',
	                        'title'     => 'Enable Ticker',
	                        'subtitle'      => 'Choose Pages where you want to display the Ticker.',
	                        'compiler'  => 'true',
	                        'options'   => array(
	                            'enabled'  => array(
	                                
	                            ),
	                            'disabled'   => array(
	                                'staticpage'    => 'Static Front Page',
	                                'blog'      => 'Blog',
	                                'pages'    => 'Pages',
	                                'posts'        => 'Posts',
	                                'archives' => 'Archives',
	                            ),
	                        ),
	                    ),
	                    array(
	                        'id'        => 'tickr-cat',
	                        'type'      => 'select',
	                        'multi'		=> true,
	                        'title'     =>  'Ticker Categories',
	                        'subtitle'      => 'Select One or Multiple Categories',
	                        'data' => 'categories',
	                    ),
	                    array(
	                        'id'            => 'tickr-count',
	                        'type'          => 'slider',
	                        'title'         => __('No. of Posts', 'times'),
	                        'desc'          => __('Select the No. of Items you want in Ticker.', 'times'),
	                        'default'       => 8,
	                        'min'           => 6,
	                        'step'          => 1,
	                        'max'           => 18,
	                        'display_value' => 'text'
	                    ),
	                    	                    

                    ), 
             );
             
             
             // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('Showcase', 'inkzine'),
                'icon'      => 'el-icon-youtube',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                		array(
	                        'id'        => 'showcase-enable',
	                        'type'      => 'sorter',
	                        'title'     => 'Enable Showcase',
	                        'subtitle'      => 'Choose Pages where you want to display the Showcase.',
	                        'compiler'  => 'true',
	                        'options'   => array(
	                            'enabled'  => array(
	                                
	                            ),
	                            'disabled'   => array(
	                                'staticpage'    => 'Static Front Page',
	                                'blog'      => 'Blog',
	                                'pages'    => 'Pages',
	                                'posts'        => 'Posts',
	                                'archives' => 'Archives',
	                            ),
	                        ),
	                    ),
	                    array(
	                        'id'        => 'sc1title',
	                        'type'      => 'text',
	                        'title'     => __('Showcase 1 Title', 'inkzine'),
						), 
						array(
	                        'id'            => 'sc1-count',
	                        'type'          => 'slider',
	                        'title'         => __('No. of Posts', 'times'),
	                        'desc'          => __('Select the No. of Items you want in this Showcase.', 'times'),
	                        'default'       => 4,
	                        'min'           => 3,
	                        'step'          => 1,
	                        'max'           => 10,
	                        'display_value' => 'text'
	                    ),
	                    array(
	                        'id'        => 'sc1cat',
	                        'type'      => 'select',
	                        'multi'		=> true,
	                        'title'     =>  'Showcase 1 Categories',
	                        'subtitle'      => 'Select One or Multiple Categories',
	                        'data' => 'categories',
	                    ),
	                    array(
	                        'id'        => 'sc2title',
	                        'type'      => 'text',
	                        'title'     => __('Showcase 2 Title', 'inkzine'),
						), 
						array(
	                        'id'            => 'sc2-count',
	                        'type'          => 'slider',
	                        'title'         => __('No. of Posts', 'times'),
	                        'desc'          => __('Select the No. of Items you want in this Showcase.', 'times'),
	                        'default'       => 4,
	                        'min'           => 3,
	                        'step'          => 1,
	                        'max'           => 10,
	                        'display_value' => 'text'
	                    ),
	                    array(
	                        'id'        => 'sc2cat',
	                        'type'      => 'select',
	                        'multi'		=> true,
	                        'title'     =>  'Showcase 1 Categories',
	                        'subtitle'      => 'Select One or Multiple Categories',
	                        'data' => 'categories',
	                    ),
	                    array(
	                        'id'        => 'sc3title',
	                        'type'      => 'text',
	                        'title'     => __('Showcase 3 Title', 'inkzine'),
						), 
						array(
	                        'id'            => 'sc3-count',
	                        'type'          => 'slider',
	                        'title'         => __('No. of Posts', 'times'),
	                        'desc'          => __('Select the No. of Items you want in this Showcase.', 'times'),
	                        'default'       => 4,
	                        'min'           => 3,
	                        'step'          => 1,
	                        'max'           => 10,
	                        'display_value' => 'text'
	                    ),
	                    array(
	                        'id'        => 'sc3cat',
	                        'type'      => 'select',
	                        'multi'		=> true,
	                        'title'     =>  'Showcase 1 Categories',
	                        'subtitle'      => 'Select One or Multiple Categories',
	                        'data' => 'categories',
	                    ),
                    ), 
             );
			 
			 $this->sections[] = array(
                'title'     => __('Carousel', 'inkzine'),
                'icon'      => 'el-icon-forward',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                		array(
	                        'id'        => 'carousel-enable',
	                        'type'      => 'sorter',
	                        'title'     => 'Enable Carousel',
	                        'subtitle'      => 'Choose Pages where you want to display the Carousel.',
	                        'compiler'  => 'true',
	                        'options'   => array(
	                            'disabled'  => array(
	                                'pages'    => 'Pages',
	                                'posts'        => 'Posts',
	                                'archives' => 'Archives',
	                                'staticpage'    => 'Static Front Page',
	                                'blog'      => 'Blog'
	                            ),
	                            'enabled'   => array(),
	                        ),
	                    ),
	                    array(
	                        'id'            => 'carousel-count',
	                        'type'          => 'slider',
	                        'title'         => __('No. of Posts', 'inkzine'),
	                        'desc'          => __('Set the Transition Speed at which Slider switch from One Slide to Another.', 'inkzine'),
	                        'default'       => 6,
	                        'min'           => 3,
	                        'step'          => 1,
	                        'max'           => 20,
	                        'display_value' => 'text'
	                    ),
	                	array(
	                        'id'        => 'carousel-cats',
	                        'type'      => 'select',
	                        'data'      => 'categories',
	                        'multi'     => true,
	                        'title'     => __('Categories', 'inkzine'),
	                        'subtitle'  => __('Select all the Categories from which the Posts should be Fetched.', 'inkzine'),
	                    ),

                    ), 
             );
			 
			 // STYLING SECTION
            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => __('Styling Options', 'inkzine'),
                'fields'    => array(
                    
                    array(
                        'id'        => 'pattern',
                        'type'      => 'media',
                        'desc'      => __('Leave it Blank to use the Default Pattern.', 'inkzine'),
                        'title'     => __('Ticker, Footer & Post Title Background', 'inkzine'),
                        'subtitle'  => __('Select a Pattern Image(Repeatable) for Background.', 'inkzine'),
                        
                    ),
                    
                    
                ),
            ); 
            
            
			 
             $this->sections[] = array(
                'title'     => __('Social Icons', 'inkzine'),
                'icon'      => 'el-icon-facebook',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                		array(
	                        'id'        => 'enable-social-icons',
	                        'type'      => 'checkbox',
	                        'title'     => __('Enable Social Icons', 'inkzine'),
	                        'subtitle'  => __('This will enable social icons in the top menu bar. If you want a full width menu, then you need to disable the social icons.', 'inkzine'),
	                        //'options' => array('on', 'off'),
	                        'default'   => false,
                        ),
	                	 array(
	                        'id'        => 'facebook',
	                        'type'      => 'text',
	                        'title'     => __('Facebook', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://facebook.com/#/',
                        ),
                        array(
	                        'id'        => 'twitter',
	                        'type'      => 'text',
	                        'title'     => __('Twitter', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://twitter.com/#/',
                        ),
                        array(
	                        'id'        => 'google',
	                        'type'      => 'text',
	                        'title'     => __('Google+', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://plus.google.com/#/',
                        ),
                        array(
	                        'id'        => 'rss-feed',
	                        'type'      => 'text',
	                        'title'     => __('RSS Feed', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://feeds.feedburner.com/#/',
                        ),
                        array(
	                        'id'        => 'instagram',
	                        'type'      => 'text',
	                        'title'     => __('Instagram', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://instagram.com/#/',
                        ),
                        array(
	                        'id'        => 'flickr',
	                        'type'      => 'text',
	                        'title'     => __('Flickr', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://flickr.com/#/',
                        ),
                        array(
	                        'id'        => 'dribbble',
	                        'type'      => 'text',
	                        'title'     => __('Dribbble', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://dribbble.com/#/',
                        ),
                        array(
	                        'id'        => 'foursquare',
	                        'type'      => 'text',
	                        'title'     => __('FourSquare', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://foursquare.com/#/',
                        ),
                        array(
	                        'id'        => 'linkedin',
	                        'type'      => 'text',
	                        'title'     => __('LinkedIn', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => 'http://linkedin.com/#/',
                        ),
                        array(
	                        'id'        => 'pinterest',
	                        'type'      => 'text',
	                        'title'     => __('Pinterest', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => '',
                        ),
                        array(
	                        'id'        => 'tumblr',
	                        'type'      => 'text',
	                        'title'     => __('Tumblr', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => '',
                        ),
                        array(
	                        'id'        => 'vimeo',
	                        'type'      => 'text',
	                        'title'     => __('Vimeo', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => '',
                        ),
                        array(
	                        'id'        => 'vine',
	                        'type'      => 'text',
	                        'title'     => __('Vine', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => '',
                        ),
                        array(
	                        'id'        => 'vk',
	                        'type'      => 'text',
	                        'title'     => __('VK.com', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => '',
                        ),
                        array(
	                        'id'        => 'yelp',
	                        'type'      => 'text',
	                        'title'     => __('Yelp', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => '',
                        ),
                        array(
	                        'id'        => 'youtube',
	                        'type'      => 'text',
	                        'title'     => __('YouTube', 'inkzine'),
	                        'subtitle'  => __('Enter Complete URL including http://', 'inkzine'),
	                        'validate'  => 'url',
	                        'default'   => '',
                        ),

                    ), 
             );

             $this->sections[] = array(
                'title'     => __('Custom Codes', 'inkzine'),
                'icon'      => 'el-icon-broom',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                		array(
                        'id'        => 'custom-css',
                        'type'      => 'ace_editor',
                        'title'     => __('CSS Code', 'inkzine'),
                        'subtitle'  => __('Paste your CSS code here.', 'inkzine'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'default'   => ""
                    ),
                     array(
	                        'id'        => 'custom-js',
	                        'type'      => 'ace_editor',
	                        'title'     => __('JavaScript Code', 'inkzine'),
	                        'subtitle'  => __('Paste your JavaScript code here.', 'inkzine'),
	                        'mode'      => 'javascript',
	                        'theme'     => 'chrome',
	                        'desc'      => 'This Javascript will be rendered in the Head of the Site. Do not include starting and closing script tags.(&lt;script&gt; and &lt;/script&gt;)',
	                        'default'   => ""
	                    ),
	                    array(
	                        'id'        => 'analytics',
	                        'type'      => 'ace_editor',
	                        'title'     => __('Analytics Code', 'inkzine'),
	                        'subtitle'  => __('Paste your Stats tracking code here. Google Analytics, Stats Counter, etc.', 'inkzine'),
	                        'mode'      => 'javascript',
	                        'theme'     => 'chrome',
	                        'desc'      => 'This Javascript will be rendered in the Footer of the Site. Do not include starting and closing script tags.(&lt;script&gt; and &lt;/script&gt;)',
	                        'default'   => ""
	                    ),

                    ),
                    
             );

            $this->sections[] = array(
                'title'     => __('Import / Export', 'inkzine'),
                'desc'      => __('Import and Export your InkZine Pro settings from file, text or URL.', 'inkzine'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'inkzine'),
                'desc'      => __('', 'inkzine'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'inkzine'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'inkzine')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'inkzine'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'inkzine')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'inkzine');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'inkzine_setting',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => 'InkZine Theme Options',     // Name that appears at the top of your panel
                'display_version'   => 'by Rohitink.com',  // Version that appears at the top of your panel
                'menu_type'         => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'inkzine'),
                'page_title'        => __('InkZine Theme Options', 'inkzine'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                   // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => 'option_setting',        // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                   // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => 'theme_options',         // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => false,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/rohitink/',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/inkhivethemes/',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/rohitinked',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Welcome to InkZine Plus Theme Options. <a href="http://demo.inkhive.com/inkzine-plus/">View InkZine Plus Demo</a> | <a href="http://inkzine.com/contact-us/">Theme Support</a> ','inkzine'));
            } else {
                $this->args['intro_text'] = __('<p>Upgrade to pro</p>', 'inkzine');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>To report bugs, send us an email.</p>', 'inkzine');
        }
    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
