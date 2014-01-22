<?php


/**
 * Customizer Directory
 *
 * @return	string	The directory in which Customizer Boilerplate is located, no trailing slash
 */
function thsp_cbp_directory_uri() {

	$thsp_cbp_directory_uri = get_template_directory_uri() . '/customizer-boilerplate';
	
	return apply_filters( 'thsp_cbp_directory_uri', $thsp_cbp_directory_uri );

}


/**
 * Capability Required to Save Theme Options
 *
 * @return	string	The capability to actually use
 */
function thsp_cbp_capability() {

	return apply_filters( 'thsp_cbp_capability', 'edit_theme_options' );

}


/**
 * Dashboard menu link text
 *
 * Hook into this to make the text translatable, for example you could
 * return this
 * __( 'Theme Customizer', 'my_theme_textdomain' )
 *
 * @return	string	Menu link text
 */
function thsp_cbp_menu_link_text() {

	return apply_filters( 'thsp_cbp_menu_link_text', 'Theme Customizer' );

}


/**
 * Name of DB entry under which options are stored if 'type' => 'option'
 * is used for Theme Customizer settings
 *
 * @return	string	DB entry
 */
function thsp_cbp_option() {

	return apply_filters( 'thsp_cbp_option', 'thsp_cbp_theme_options' );

}


/**
 * Get Option Values
 * 
 * Array that holds all of the options values
 * Option's default value is used if user hasn't specified a value
 *
 * @uses	thsp_get_theme_customizer_defaults()	defined in /customizer/options.php
 * @return	array									Current values for all options
 * @since	Theme_Customizer_Boilerplate 1.0
 */
function thsp_cbp_get_options_values() {

	// Get the option defaults
	$option_defaults = thsp_cbp_get_options_defaults();
	
	// Parse the stored options with the defaults
	$thsp_cbp_options = wp_parse_args( get_option( thsp_cbp_option(), array() ), $option_defaults );
	
	// Return the parsed array
	return $thsp_cbp_options;
	
}


/**
 * Get Option Defaults
 * 
 * Returns an array that holds default values for all options
 * 
 * @uses	thsp_get_theme_customizer_fields()	defined in /customizer/options.php
 * @return	array	$thsp_option_defaults		Default values for all options
 * @since	Theme_Customizer_Boilerplate 1.0
 */
function thsp_cbp_get_options_defaults() {

	// Get the array that holds all theme option fields
	$thsp_sections = thsp_cbp_get_fields();
	
	// Initialize the array to hold the default values for all theme options
	$thsp_option_defaults = array();
	
	// Loop through the option parameters array
	foreach ( $thsp_sections as $thsp_section ) {
	
		$thsp_section_fields = $thsp_section['fields'];
		
		foreach ( $thsp_section_fields as $thsp_field_key => $thsp_field_value ) {

			// Add an associative array key to the defaults array for each option in the parameters array
			if( isset( $thsp_field_value['setting_args']['default'] ) ) {
				$thsp_option_defaults[$thsp_field_key] = $thsp_field_value['setting_args']['default'];
			} else {
				$thsp_option_defaults[$thsp_field_key] = false;
			}
			
		}
		
	}
	
	// Return the defaults array
	return $thsp_option_defaults;
	
}