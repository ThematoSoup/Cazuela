<?php
/**
 * Custom functions that act independently of the theme templates
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
 * @param	Array	$classes				Current body classes
 * @uses	thsp_get_theme_options()		Defined in /inc/get-options.php
 * @uses	thsp_get_theme_options_fields()	Defined in /inc/extras.php
 * @uses	thsp_get_current_layout()		Defined in /inc/extras.php
 * @return	Array	$classes				Updated body classes array
 * @since	Cazuela 1.0
 */
function thsp_body_classes( $classes ) {

	global $post;

	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Get current theme options
	$theme_options = thsp_get_theme_options();
	$thsp_body_classes = array();
	
	// Get layout classes and add them to body_class array
	$thsp_current_layout = thsp_get_current_layout();
	foreach ( $thsp_current_layout as $thsp_current_layout_value ) {
		$thsp_body_classes[] = $thsp_current_layout_value;
	}

	$thsp_body_classes[] = 'body-' . $theme_options['body_font'];
	$thsp_body_classes[] = 'heading-' . $theme_options['heading_font'];
	$thsp_body_classes[] = $theme_options['color_scheme'];
	
	// See if header gradient is needed
	if( $theme_options['header_gradient'] ) {
		$thsp_body_classes[] = 'header-gradient';
	}

	$classes = array_merge( $classes, $thsp_body_classes );

	return $classes;
	
}
add_filter( 'body_class', 'thsp_body_classes' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param	Array	$classes				Current body classes
 * @uses	thsp_get_theme_options()		Defined in /inc/get-options.php
 * @return	array	$current_layout			Layout options for current page
 * @since	Cazuela 1.0
 */
function thsp_get_current_layout() {

	global $post;

	// Get current theme options values
	$theme_options = thsp_get_theme_options();

	// Check if in single post/page view and if layout custom field value exists
	if ( is_page_template( 'page-templates/template-homepage.php' ) ) {
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

	return $current_layout;

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
 * @since Cazuela 1.1
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
		$title .= " $sep " . sprintf( __( 'Page %s', 'thsp_cazuela' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'thsp_wp_title', 10, 2 );