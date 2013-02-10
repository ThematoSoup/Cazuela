<?php
/**
 * Cazuela functions and definitions
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
if ( !isset( $content_width ) )
	$content_width = 620; /* pixels */


/**
 * Change content width, based on layout
 */
function thsp_content_width() {

	$thsp_current_layout = thsp_get_current_layout();
	global $content_width;
	
	if ( 'layout-c' == $thsp_current_layout ) {
		$content_width = 960; /* pixels */
	} elseif ( in_array( $thsp_current_layout, array( 'layout-cps', 'layout-psc', 'layout-pcs' ) ) ) {
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
 * @since Cazuela 1.0
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
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Cazuela, use a find and replace
	 * to change 'thsp_cazuela' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'thsp_cazuela', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 *
	 * @since Cazuela 1.0
	 */
	add_theme_support( 'automatic-feed-links' );

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

	/**
	 * Enable Custom Backgrounds
	 *
	 * @since Cazuela 1.0
	 */
	add_theme_support( 'custom-background' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 *
	 * @since Cazuela 1.0
	 */
	register_nav_menus( array(
		'main'		=> __( 'Main Menu', 'thsp_cazuela' ),
		'footer'	=> __( 'Footer Menu', 'thsp_cazuela' ),
	) );

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
	 * Adds the Customize page to the WordPress admin area
	 */
	add_action( 'admin_menu', 'thsp_customizer_menu' );
	function thsp_customizer_menu() {
	
	    add_theme_page(
	    	'Customization',
	    	'Customization',
	    	'edit_theme_options',
	    	'customize.php'
	    );
	    
	}

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
		'name' => __( 'Primary Sidebar', 'thsp_cazuela' ),
		'id' => 'primary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'thsp_cazuela' ),
		'id' => 'secondary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'thsp_cazuela' ),
		'id' => 'footer-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Homepage Widget Area', 'thsp_cazuela' ),
		'description' => __( 'This widget area is used in "Widgetized Homepage" page template', 'thsp_cazuela' ),
		'id' => 'homepage-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="homepage-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Before Header', 'thsp_cazuela' ),
		'id' => 'before-header-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'After Header', 'thsp_cazuela' ),
		'id' => 'after-header-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Before Content', 'thsp_cazuela' ),
		'id' => 'before-content-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'After Content', 'thsp_cazuela' ),
		'id' => 'after-content-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Before Footer', 'thsp_cazuela' ),
		'id' => 'before-footer-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'After Footer', 'thsp_cazuela' ),
		'id' => 'after-footer-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

}
add_action( 'widgets_init', 'thsp_widgets_init' );


/**
 * Attach widget areas to theme action hooks
 *
 * @since Cazuela 1.0
 */
function thsp_before_header_sidebar() {
	dynamic_sidebar( 'before-header-sidebar' );
}
if ( is_active_sidebar( 'before-header-sidebar' ) ) {
	add_action( 'thsp_before_header', 'thsp_before_header_sidebar' );
}

function thsp_after_header_sidebar() {
	dynamic_sidebar( 'after-header-sidebar' );
}
if ( is_active_sidebar( 'after-header-sidebar' ) ) {
	add_action( 'thsp_after_header', 'thsp_after_header_sidebar' );
}

function thsp_attach_before_content_sidebar() {
	dynamic_sidebar( 'before-content-sidebar' );
}
if ( is_active_sidebar( 'before-content-sidebar' ) ) {
	add_action( 'thsp_before_content', 'thsp_attach_before_content_sidebar' );
}

function thsp_attach_after_content_sidebar() {
	dynamic_sidebar( 'after-content-sidebar' );
}
if ( is_active_sidebar( 'after-content-sidebar' ) ) {
	add_action( 'thsp_after_content', 'thsp_attach_after_content_sidebar' );
}

function thsp_attach_before_footer_sidebar() {
	dynamic_sidebar( 'before-footer-sidebar' );
}
if ( is_active_sidebar( 'before-footer-sidebar' ) ) {
	add_action( 'thsp_before_footer', 'thsp_attach_before_footer_sidebar' );
}

function thsp_attach_after_footer_sidebar() {
	dynamic_sidebar( 'after-footer-sidebar' );
}
if ( is_active_sidebar( 'after-footer-sidebar' ) ) {
	add_action( 'thsp_after_footer', 'thsp_attach_after_footer_sidebar' );
}

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
	
	$body_font_options = $theme_options_fields['thsp_typography_section']['fields']['body_font']['control_args']['choices_extended'];
	$heading_font_options = $theme_options_fields['thsp_typography_section']['fields']['heading_font']['control_args']['choices_extended'];

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

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_page_template( 'page-templates/template-masonry.php' ) ) {
		wp_enqueue_script(
			'jquery-masonry',
			get_template_directory_uri() . '/js/jquery.masonry.min.js',
			array( 'jquery' ),
			'v2.1.07'
		);
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script(
			'keyboard-image-navigation',
			get_template_directory_uri() . '/js/keyboard-image-navigation.js',
			array( 'jquery' ),
			'20120202'
		);
	}

	wp_enqueue_script(
		'cazuela',
		get_template_directory_uri() . '/js/cazuela.js',
		array( 'jquery' ),
		'20130210'
	);
	
}
add_action( 'wp_enqueue_scripts', 'thsp_theme_scripts' );


/**
 * Dynamically generated CSS (link color)
 *
 * @since Cazuela 1.0
 */
function thsp_dynamic_css() {

	$theme_options = thsp_cbp_get_options_values();
	$links_color = $theme_options['links_color']; ?>
	
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


/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );


/**
 * Add post meta box
 */
if ( is_admin() ) {
	 require( get_template_directory() . '/inc/post-meta-box.php' );
}


/**
 * Customizer options
 */	
require( get_template_directory() . '/inc/customizer-boilerplate/customizer.php' );


/**
 * Theme documentation page
 */	
if ( is_admin() ) {

	require( get_template_directory() . '/inc/documentation-page.php' );

}