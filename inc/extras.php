<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * ========
 * Contents
 * ========
 *
 * - Add Home link to wp_page_menu()
 * - Add parent class to menu items with children
 * - Add custom body classes for layout and typography options
 * - Get current layout
 * - Enhanced image navigation
 * - Custom wp_title, using filter hook
 * - Add Yoast breadcrumbs, if WordPress SEO is active and breadcrumbs enabled
 * - Categorized blog check
 * - Flush category transient
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Cazuela 1.0
 */
function thsp_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'thsp_page_menu_args' );


/**
 * Adds parent class to navigation menus
 *
 * @since Cazuela 1.0
 */
function thsp_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
		}
	}
	
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'thsp_menu_parent_class' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param	Array	$classes					Current body classes
 * @uses	thsp_cbp_get_options_values()		Defined in /customizer-boilerplate/helpers.php
 * @uses	thsp_get_current_layout()			Defined in /inc/extras.php
 * @return	Array	$classes					Updated body classes array
 * @since	Cazuela 1.0
 */
function thsp_body_classes( $classes ) {
	global $post;

	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Get current theme options
	$thsp_theme_options = thsp_cbp_get_options_values();
	$thsp_body_classes = array();
	
	// Get layout classes and add them to body_class array
	$thsp_current_layout = thsp_get_current_layout();
	foreach ( $thsp_current_layout as $thsp_current_layout_value ) {
		$thsp_body_classes[] = $thsp_current_layout_value;
	}
	
	// Color scheme class
	$thsp_current_color_scheme = thsp_get_current_color_scheme();
	$thsp_body_classes[] = $thsp_current_color_scheme;

	$thsp_body_classes[] = 'body-' . $thsp_theme_options['body_font'];
	$thsp_body_classes[] = 'heading-' . $thsp_theme_options['heading_font'];
	
	// See if header gradient is needed
	if( $thsp_theme_options['header_gradient'] ) {
		$thsp_body_classes[] = 'header-gradient';
	}

	$classes = array_merge( $classes, $thsp_body_classes );

	return $classes;
}
add_filter( 'body_class', 'thsp_body_classes' );


/**
 * Passes custom typography classes to Tiny MCE editor
 *
 * @param	$thsp_mceInit						array
 * @uses	thsp_cbp_get_options_values()		defined in /customizer-boilerplate/helpers.php
 * @return	$thsp_mceInit						array
 * @since	Cazuela 1.0
 */
function thsp_tiny_mce_classes( $thsp_mceInit ) {
	// Get theme options
	$thsp_theme_options = thsp_cbp_get_options_values();
	$thsp_mceInit['body_class'] .= ' body-' . $thsp_theme_options['body_font'] . ' heading-' . $thsp_theme_options['heading_font'];
	
	return $thsp_mceInit;
}
add_filter( 'tiny_mce_before_init', 'thsp_tiny_mce_classes' );
add_filter( 'teeny_mce_before_init', 'thsp_tiny_mce_classes' );


/**
 * Load Google Fonts to use in Tiny MCE
 *
 * @param	$mce_css							string
 * @uses	thsp_cbp_get_options_values()		defined in /customizer-boilerplate/helpers.php
 * @uses	thsp_cbp_get_fields()				defined in /customizer-boilerplate/helpers.php
 * @return	$mce_css							string
 * @since	Cazuela 1.0
 */
function thsp_mce_css( $mce_css ) {
	$theme_options = thsp_cbp_get_options_values();
	$theme_options_fields = thsp_cbp_get_fields();
	
	$body_font_value = $theme_options['body_font'];
	$heading_font_value = $theme_options['heading_font'];
	
	$body_font_options = $theme_options_fields['thsp_typography_section']['fields']['body_font']['control_args']['choices'];
	$heading_font_options = $theme_options_fields['thsp_typography_section']['fields']['heading_font']['control_args']['choices'];

	// Check protocol
	$protocol = is_ssl() ? 'https' : 'http';
	
	// Check if it's a Google Font
	if( isset( $body_font_options[$body_font_value]['google_font'] ) ) {
		// Commas must be HTML encoded
		$body_font_string = str_replace( ',', '&#44;', $body_font_options[$body_font_value]['google_font'] );
		$mce_css .= ', ' . $protocol . '://fonts.googleapis.com/css?family=' . $body_font_string;
	}	
	// Check if it's a Google Font
	if( isset( $heading_font_options[$heading_font_value]['google_font'] ) ) {
		// Commas must be HTML encoded
		$heading_font_string = str_replace( ',', '&#44;', $heading_font_options[$heading_font_value]['google_font'] );
		$mce_css .= ', ' . $protocol . '://fonts.googleapis.com/css?family=' . $heading_font_string;
	}
	
	return $mce_css;
}
add_filter( 'mce_css', 'thsp_mce_css' );


/**
 * Gets current layout for page being displayed
 *
 * @uses	thsp_cbp_get_options_values()		defined in /customizer-boilerplate/helpers.php
 * @return	array	$current_layout				Layout options for current page
 * @since	Cazuela 1.0
 */
function thsp_get_current_layout() {
	global $post;

	// Get current theme options values
	$theme_options = thsp_cbp_get_options_values();

	// Check if in single post/page view and if layout custom field value exists
	if ( is_page_template( 'page-templates/template-homepage.php' ) || is_page_template( 'page-templates/template-masonry.php' ) ) {
		$current_layout['default_layout'] = 'layout-c';
	} elseif ( is_singular() && get_post_meta( $post->ID, '_thsp_post_layout', true ) ) {
		$current_layout['default_layout'] = get_post_meta( $post->ID, '_thsp_post_layout', true );
	} else {
		$current_layout['default_layout'] = $theme_options['default_layout'];
	}

	if( is_singular() && get_post_meta( $post->ID, '_post_layout_type', true ) ) {
		$current_layout['default_layout'] = get_post_meta( $post->ID, '_post_layout_type', true );
	} else {
		$current_layout['layout_type'] = $theme_options['layout_type'];
	}

	/*
	 * Returns an array with two values that can be changed using
	 * 'thsp_current_layout' filter hook:
	 * $current_layout['default-layout']	- determines number and placement of sidebars
	 * $current_layout['layout_type']		- boxed or full width
	 */
	return apply_filters( 'thsp_current_layout', $current_layout );
}

/**
 * Gets current layout for page being displayed
 *
 * @uses	thsp_cbp_get_options_values()		defined in /customizer-boilerplate/helpers.php
 * @return	string	$current_color_scheme		Color scheme for current page
 * @since	Cazuela 1.0
 */
function thsp_get_current_color_scheme() {
	global $post;

	// Get current theme options values
	$theme_options = thsp_cbp_get_options_values();

	// Check if in single post/page view and if layout custom field value exists
	if ( is_singular() && get_post_meta( $post->ID, '_thsp_post_color_scheme', true ) ) {
		$current_color_scheme = get_post_meta( $post->ID, '_thsp_post_color_scheme', true );
	} else {
		$current_color_scheme = $theme_options['color_scheme'];
	}

	return apply_filters( 'thsp_current_color_scheme', $current_color_scheme );
}


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Cazuela 1.0
 */
function thsp_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'thsp_enhanced_image_navigation', 10, 2 );


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since Cazuela 1.0
 */
function thsp_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'cazuela' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'thsp_wp_title', 10, 2 );


/**
 * Adds Yoast breadcrumbs to 'thsp_after_header' hook
 *
 * @since Cazuela 1.0
 */
function thsp_display_yoast_breadcrumbs() {
	/*
	 * Add breadcrumbs
	 * WordPress SEO plugin must be installed and breadcrumbs must be enabled
	 */
	yoast_breadcrumb( '<div id="yoast-breadcrumbs">', '</div>' );
}
if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() && ! is_home() ) {
	add_action( 'thsp_after_header', 'thsp_display_yoast_breadcrumbs', 99 );
}


/**
 * Retrieves the attachment ID from the file URL
 * Used to get attachment object for logo image added through Theme Customizer
 *
 * @link	http://philipnewcomer.net/2012/11/get-the-attachment-id-from-an-image-url-in-wordpress/
 * @since Cazuela 1.0
 */
function thsp_get_logo_image( $attachment_url ) {
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
	
	$attachment_array = wp_get_attachment_image_src( $attachment_id, 'full' );
	
	return $attachment_array; 
}


/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two or three per row
 *
 * @uses	wp_get_sidebars_widgets()		http://codex.wordpress.org/Function_Reference/wp_get_sidebars_widgets
 * @since	Cazuela 1.0
 */
function thsp_count_widgets( $sidebar_id ) {
	/* 
	 * Count widgets in footer widget area
	 * Used to set widget width based on total count
	 */
	$sidebars_widgets_count = wp_get_sidebars_widgets();
	$sidebar_classes = isset( $sidebars_widgets_count[ $sidebar_id ] ) ? 'clearfix dynamic-widget-width widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] ) : 'clearfix';
	
	return $sidebar_classes;
}


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Cazuela 1.0
 */
function thsp_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so thsp_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so thsp_categorized_blog should return false
		return false;
	}
}


/**
 * Flush out the transients used in thsp_categorized_blog
 *
 * @since Cazuela 1.0
 */
function thsp_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'thsp_category_transient_flusher' );
add_action( 'save_post', 'thsp_category_transient_flusher' );