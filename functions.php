<?php
/**
 * Cazuela functions and definitions
 *
 * ========
 * Contents
 * ========
 *
 * - Content width
 * - Theme setup
 *   -- Template tags
 *   -- Extras
 *   -- Theme textdomain
 *   -- Add theme support
 *   -- Add custom image sizes
 *   -- Register nav menus
 *   -- Add editor style
 * - Register sidebars
 * - Register scripts and styles
 * - Dynamic CSS for links color
 * - Custom header
 * - Post metaboxes
 * - Customizer Boilerplate (https://github.com/slobodan/WordPress-Theme-Customizer-Boilerplate)
 * - Theme Documentation (removed for now)
 * - Customizer Boilerplate hooks
 *   -- Path
 *   -- Menu link text
 *   -- Options array
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */


/**
 * Set default content width based on the theme's design and stylesheet.
 * Used in two-column layout
 *
 * @since Cazuela 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 620; /* pixels */
}


/**
 * Change content width, based on layout
 *
 * @uses	thsp_get_current_layout()			Defined in /inc/extras.php
 * @since	Cazuela 1.0
 */
function thsp_content_width() {
	$thsp_current_layout = thsp_get_current_layout();
	global $content_width;
	
	if ( 'layout-c' == $thsp_current_layout ) {
		// One column layout
		$content_width = 960; /* pixels */
	} elseif ( in_array( $thsp_current_layout, array( 'layout-cps', 'layout-psc', 'layout-pcs' ) ) ) {
		// Three column layouts
		$content_width = 520; /* pixels */		
	}
}
add_action( 'template_redirect', 'thsp_content_width' );



if ( !function_exists( 'thsp_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since	Cazuela 1.0
 */
function thsp_theme_setup() {
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Theme hooks
	 */
	require( get_template_directory() . '/inc/hooks.php' );

	/**
	 * Inline theme documentation
	 */
	require( get_template_directory() . '/inc/documentation.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'cazuela', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 *
	 * @since Cazuela 1.0
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable Custom Backgrounds
	 *
	 * @since Cazuela 1.0
	 */
	$custom_background_args = array(
		'default-color' => '#fff'
	);
	add_theme_support( 'custom-background', $custom_background_args );

	/**
	 * Add support for Post Formats
	 *
	 * @since Cazuela 1.0
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'link',
		'gallery',
		'status',
		'quote',
		'chat',
		'image',
		'video',
		'audio'
	) );

	/**
	 * Enable support for Post Thumbnails
	 *
	 * @since Cazuela 1.0
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Thumbnails
	 *
	 * @since Cazuela 1.0
	 */
	add_image_size( 'lead-image', 660, 9999, false );
	add_image_size( 'masonry-image', 240, 9999, false );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 *
	 * @since Cazuela 1.0
	 */
	register_nav_menus( array(
		'main'		=> __( 'Main Menu', 'cazuela' ),
		'footer'	=> __( 'Footer Menu', 'cazuela' )
	) );

	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style
	 */
	add_editor_style();
}
endif; // thsp_setup
add_action( 'after_setup_theme', 'thsp_theme_setup' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @uses	thsp_get_footer_sidebars	Defined in inc/extras.php
 * @since	Cazuela 1.0
 */
function thsp_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'cazuela' ),
		'id' => 'primary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'cazuela' ),
		'id' => 'secondary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'cazuela' ),
		'id' => 'footer-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Homepage Widget Area', 'cazuela' ),
		'description' => __( 'This widget area is used in "Widgetized Homepage" page template', 'cazuela' ),
		'id' => 'homepage-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="homepage-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Before Header', 'cazuela' ),
		'id' => 'before-header-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'After Header', 'cazuela' ),
		'id' => 'after-header-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Before Content', 'cazuela' ),
		'id' => 'before-content-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'After Content', 'cazuela' ),
		'id' => 'after-content-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Before Footer', 'cazuela' ),
		'id' => 'before-footer-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'After Footer', 'cazuela' ),
		'id' => 'after-footer-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'thsp_widgets_init' );



/**
 * Enqueue scripts and styles
 *
 * @since Cazuela 1.0
 */
function thsp_theme_scripts() {
	/*
	 * Enqueue Google Fonts
	 *
	 * Check if fonts set in theme options require loading
	 * of Google scripts
	 */
	$theme_options = thsp_cbp_get_options_values();
	$theme_options_fields = thsp_cbp_get_fields();
	$body_font_value = $theme_options['body_font'];
	$heading_font_value = $theme_options['heading_font'];
	$body_font_options = $theme_options_fields['thsp_typography_section']['fields']['body_font']['control_args']['choices'];
	$heading_font_options = $theme_options_fields['thsp_typography_section']['fields']['heading_font']['control_args']['choices'];

	// Check if it's a Google Font
	if( isset( $body_font_options[$body_font_value]['google_font'] ) ) {
		wp_enqueue_style(
			'font_' . $body_font_value,
			'http://fonts.googleapis.com/css?family=' . $body_font_options[$body_font_value]['google_font']
		);
	}	
	// Check if it's a Google Font
	if( isset( $heading_font_options[$heading_font_value]['google_font'] ) ) {
		wp_enqueue_style(
			'font_' . $heading_font_value,
			'http://fonts.googleapis.com/css?family=' . $heading_font_options[$heading_font_value]['google_font']
		);
	}
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// Compact menu for layouts narrower than 600px
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Masonry script, for use in Masonry page template
	if ( is_page_template( 'page-templates/template-masonry.php' ) ) {
		wp_enqueue_script(
			'jquery-masonry',
			get_template_directory_uri() . '/js/jquery.masonry.min.js',
			array( 'jquery' ),
			'v2.1.07'
		);
	}

	// Flex slider scripts and styles, for use in widgetized homepage template
	if ( is_page_template( 'page-templates/template-homepage.php' ) ) {
		global $post;
		
		if ( 'slider' == get_post_meta( $post->ID, '_thsp_widgetized_homepage_aside', true ) ) {
			wp_enqueue_script(
				'flexslider',
				get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js',
				array( 'jquery' ),
				'v2.1'
			);
			wp_enqueue_style(
				'flexslider',
				get_template_directory_uri() . '/js/flexslider/flexslider.css'
			);
		}
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script(
			'keyboard-image-navigation',
			get_template_directory_uri() . '/js/keyboard-image-navigation.js',
			array( 'jquery' ),
			'20120202'
		);
	}

	// Theme specific scripts
	if ( is_page_template( 'page-templates/template-homepage.php' ) || is_page_template( 'page-templates/template-masonry.php' ) ) {
		wp_enqueue_script(
			'cazuela',
			get_template_directory_uri() . '/js/cazuela.js',
			array( 'jquery' ),
			'201302120'
		);
	}
}
add_action( 'wp_enqueue_scripts', 'thsp_theme_scripts' );


/**
 * Dynamically generated CSS (link color), based on theme options
 *
 * @since Cazuela 1.0
 */
function thsp_dynamic_css() {
	$theme_options = thsp_cbp_get_options_values();
	$links_color = $theme_options['links_color'];
	?>
	
	<style type="text/css">
		#main a,
		#main .entry-meta a,
		#main .page-links a,
		#after-header a,
		#homepage-widget-area a:visited {
			color: <?php echo $links_color; ?>
		}
	</style>
<?php }
add_action( 'wp_head', 'thsp_dynamic_css' );


// Implement the Custom Header feature
require( get_template_directory() . '/inc/custom-header.php' );

// Post/page meta box
if ( is_admin() ) {
	require( get_template_directory() . '/inc/post-meta-box.php' );
}

// Theme Customizer Boilerplate
require( get_template_directory() . '/inc/customizer-boilerplate/customizer.php' );



/*
 * ==================================
 * Theme Customizer Boilerplate edits
 * ==================================
 */


/**
 * Hooking into Theme Customizer Boilerplate to set name of DB entry
 * under which theme options are stored
 *
 * @link	https://github.com/slobodan/WordPress-Theme-Customizer-Boilerplate
 * @since	Cazuela 1.0
 */
add_filter( 'thsp_cbp_option', 'thsp_edit_cbp_option_name', 1 );
function thsp_edit_cbp_option_name() {
	
	return 'thsp_cazuela_options';
	
}


/**
 * Hooking into Theme Customizer Boilerplate to set Customizer location
 *
 * @link	https://github.com/slobodan/WordPress-Theme-Customizer-Boilerplate
 * @return	string		Theme Customizer Boilerplate location path
 * @since	Cazuela 1.0
 */
add_filter( 'thsp_cbp_directory_uri', 'thsp_edit_cbp_directory_uri', 1 );
function thsp_edit_cbp_directory_uri() {	
	return get_template_directory_uri() . '/inc/customizer-boilerplate';	
}


/**
 * Hooking into Theme Customizer Boilerplate to set Menu link text
 * https://github.com/slobodan/WordPress-Theme-Customizer-Boilerplate
 *
 * @link	https://github.com/slobodan/WordPress-Theme-Customizer-Boilerplate
 * @return	string			Menu link text
 * @since	Cazuela 1.0
 */
add_filter( 'thsp_cbp_menu_link_text', 'thsp_customizer_menu_link_text', 1 );
function thsp_customizer_menu_link_text() {
	return __( 'Theme Customizer', 'cazuela' );
}


/**
 * Options array for Theme Customizer Boilerplate
 *
 * @link	https://github.com/slobodan/WordPress-Theme-Customizer-Boilerplate
 * @return	array		Theme options
 * @since	Cazuela 1.0
 */
add_filter( 'thsp_cbp_options_array', 'thsp_theme_options_array', 1 );
function thsp_theme_options_array() {
	// Using helper function to get default required capability
	$thsp_cbp_capability = thsp_cbp_capability();

	$options = array(

		// Section ID
		'colors' => array(
		
			'existing_section' => true,
			'fields' => array(
				
				'color_scheme' => array(
					'setting_args' => array(
						'default' => 'scheme-black',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Color scheme', 'cazuela' ),
						'type' => 'images_radio', // Images (radio replacement)
						'choices' => array(
							'scheme-black' => array(
								'label' => __( 'Black', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-black.png'
							),
							'scheme-white' => array(
								'label' => __( 'White', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-white.png'
							),
							'scheme-blue' => array(
								'label' => __( 'Blue', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-blue.png'
							),
							'scheme-brown' => array(
								'label' => __( 'Brown', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-brown.png'
							),
							'scheme-candy-red' => array(
								'label' => __( 'Candy red', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-candy-red.png'
							),
							'scheme-cobalt' => array(
								'label' => __( 'Cobalt', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-cobalt.png'
							),
							'scheme-grey' => array(
								'label' => __( 'Grey', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-grey.png'
							),
							'scheme-lime-green' => array(
								'label' => __( 'Lime green', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-lime-green.png'
							),
							'scheme-orange' => array(
								'label' => __( 'Orange', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-orange.png'
							),
							'scheme-plum-purple' => array(
								'label' => __( 'Plum purple', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-plum-purple.png'
							),
							'scheme-red' => array(
								'label' => __( 'Red', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-red.png'
							)
						),					
						'priority' => 1
					) // End control args
				),

				'header_gradient' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Header gradient', 'cazuela' ),
						'type' => 'checkbox', // Checkbox field control
						'priority' => 2
					)
				),

				'links_color' => array(
					'setting_args' => array(
						'default' => '#1e559b',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Links color', 'cazuela' ),
						'type' => 'color', // Color picker field control
						'priority' => 3
					)
				)
				
			) // End fields
		),

		// Section ID
		'title_tagline' => array(
		
			'existing_section' => true,
			'fields' => array(
				
				'logo_image' => array(
					'setting_args' => array(
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo', 'cazuela' ),
						'type' => 'image', // Image upload field control
						'priority' => 20
					)
				)
				
			) // End fields
		), // End section
		
		// Section ID
		'nav' => array(
		
			'existing_section' => true,
			'fields' => array(
				
				'post_navigation_above' => array(
					'setting_args' => array(
						'default' => false,
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Navigation above posts', 'cazuela' ),
						'type' => 'checkbox', // Checkbox field control
						'priority' => 20
					)
				),

				'post_navigation_below' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Navigation below posts', 'cazuela' ),
						'type' => 'checkbox', // Checkbox field control
						'priority' => 21
					)
				),
				
			) // End fields
		), // End section

		// Section ID
		'thsp_layout_section' => array(

			'existing_section' => false,
			'args' => array(
				'title' => __( 'Layout', 'cazuela' ),
				'description' => __( 'Set default page layout', 'cazuela' ),
				'priority' => 10
			),
			'fields' => array(
				
				'layout_type' => array(
					'setting_args' => array(
						'default' => 'layout-full-width',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Layout type', 'cazuela' ),
						'type' => 'images_radio', // Image radio replacement
						'choices' => array(
							'layout-full-width' => array(
								'label' => __( 'Full width', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-full-width.png'
							),
							'layout-boxed' => array(
								'label' => __( 'Boxed', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-boxed.png'
							)
						),					
						'priority' => 1
					) // End control args
				),

				'default_layout' => array(
					'setting_args' => array(
						'default' => 'layout-cp',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Default layout', 'cazuela' ),
						'type' => 'images_radio', // Image radio replacement
						'choices' => array(
							'layout-c' => array(
								'label' => __( 'Content', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-c.png'
							),
							'layout-cp' =>  array(
								'label' => __( 'Content - Primary Sidebar', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-cp.png'
							),
							'layout-pc' => array(
								'label' => __( 'Primary Sidebar - Content', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-pc.png'
							),
							'layout-cps' => array(
								'label' => __( 'Content - Primary Sidebar - Secondary Sidebar', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-cps.png'
							),
							'layout-psc' => array(
								'label' => __( 'Primary Sidebar - Secondary Sidebar - Content', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-psc.png'
							),
							'layout-pcs' => array(
								'label' => __( 'Primary Sidebar - Content - Secondary Sidebar', 'cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-pcs.png'
							)
						),					
						'priority' => 2
					) // End control args
				),

			) // End fields
		),
		
		// Section ID
		'thsp_typography_section' => array(

			'existing_section' => false,
			'args' => array(
				'title' => __( 'Typography', 'cazuela' ),
				'description' => __( 'Select fonts', 'cazuela' ),
				'priority' => 20
			),
			'fields' => array(
				
				'body_font' => array(
					'setting_args' => array(
						'default' => 'open-sans',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Body font', 'cazuela' ),
						'type' => 'select', // Select control
						'choices' => array(
							'arial' => array(
								'label' => 'Arial'
							),
							'helvetica' => array(
								'label' => 'Helvetica'
							),
							'open-sans' => array(
								'label' => 'Open Sans',
								'google_font' => 'Open+Sans:400italic,700italic,400,700'
							),
							'lato' => array(
								'label' => 'Lato',
								'google_font' => 'Lato:400,700,400italic,700italic'
							),
							'pt-sans' => array(
								'label' => 'PT Sans',
								'google_font' => 'PT+Sans:400,700,400italic,700italic'
							),
							'gudea' => array(
								'label' => 'Gudea',
								'google_font' => 'Gudea:400,700,400italic'
							),
							'lora' => array(
								'label' => 'Lora',
								'google_font' => 'Lora:400,700,400italic,700italic'
							),
							'istok-web' => array(
								'label' => 'Istok Web',
								'google_font' => 'Istok+Web:400,700,400italic,700italic'
							)
						),
						'priority' => 1
					) // End control args
				),

				'heading_font' => array(
					'setting_args' => array(
						'default' => 'open-sans',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Heading font', 'cazuela' ),
						'type' => 'select', // Select control
						'choices' => array(
							'georgia' => array(
								'label' => 'Georgia'
							),
							'open-sans' => array(
								'label' => 'Open Sans',
								'google_font' => 'Open+Sans:400italic,700italic,400,700'
							),
							'lato' => array(
								'label' => 'Lato',
								'google_font' => 'Lato:700,700italic'
							),
							'oswald' => array(
								'label' => 'Oswald',
								'google_font' => 'Oswald:700'
							),
							'bitter' => array(
								'label' => 'Bitter',
								'google_font' => 'Bitter:700'
							),
							'merriweather' => array(
								'label' => 'Merriweather',
								'google_font' => 'Merriweather:700'
							),
							'droid-serif' => array(
								'label' => 'Droid Serif',
								'google_font' => 'Droid+Serif:700'
							)     
						),					
						'priority' => 2
					) // End control args
				),

			) // End fields
		)
	
	);

	return $options;
}


/**
 * Built-in controls to remove from Theme Customizer
 *
 * @link	https://github.com/slobodan/WordPress-Theme-Customizer-Boilerplate
 * @return	array	Built-in controls that need to be removed from Theme Customizer
 * @since Cazuela 1.0
 */
add_filter( 'tshp_cbp_remove_controls', 'thsp_theme_options_remove_controls', 1 );
function thsp_theme_options_remove_controls() {
	$thsp_cbp_remove_controls = array( 'header_textcolor' );
	
	return $thsp_cbp_remove_controls;
}