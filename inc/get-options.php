<?php
/**
 * Get Theme Options
 *
 * - Get Theme Options Fields
 * - Get Theme Options Values
 * - Get Theme Options Defaults
 *
 * @package		Cazuela
 * @since		cazuela 1.0
 */


/**
 * Helper function that holds array of theme options fields.
 *
 * @return	array	$options	Array of setting fields
 * @since Cazuela 1.0
 */
function thsp_get_theme_options_fields() {

	$options = array(

		'colors' => array(
			'existing_section' => true,
			'fields' => array(
				'color_scheme' => array(
					'title'			=> __( 'Color scheme', 'cazuela' ),
					'description'	=> __( 'Select color scheme', 'cazuela' ),
					'type'			=> 'image-radios',
					'choices'		=> array(
						'scheme-black' => array(
							'title'			=> __( 'Black', 'cazuela' )
						),
						'scheme-white' => array(
							'title'			=> __( 'White', 'cazuela' )
						),
						'scheme-blue' => array(
							'title'			=> __( 'Blue', 'cazuela' )
						),
						'scheme-brown' => array(
							'title'			=> __( 'Brown', 'cazuela' ),
						),
						'scheme-candy-red' => array(
							'title'			=> __( 'Candy red', 'cazuela' )
						),
						'scheme-cobalt' => array(
							'title'			=> __( 'Cobalt', 'cazuela' )
						),
						'scheme-grey' => array(
							'title'			=> __( 'Grey', 'cazuela' )
						),
						'scheme-lime-green' => array(
							'title'			=> __( 'Lime green', 'cazuela' )
						),
						'scheme-orange' => array(
							'title'			=> __( 'Orange', 'cazuela' )
						),
						'scheme-plum-purple' => array(
							'title'			=> __( 'Plum purple', 'cazuela' )
						),
						'scheme-red' => array(
							'title'			=> __( 'Red', 'cazuela' )
						)
					),
					'since'			=> '1.0',
					'default'		=> 'scheme-black'
				),
				'header_gradient' => array(
					'title'			=> __( 'Header gradient', 'cazuela' ),
					'description'	=> __( 'Add subtle gradient to header', 'cazuela' ),
					'type'			=> 'checkbox',
					'since'			=> '1.0',
					'default'		=> false
				)
			)
		),
		
		// Section
		'thsp_layout_section' => array(
			'title' => __( 'Page layout', 'cazuela' ),
			'description' => __( 'Set default page layout', 'cazuela' ),
			// Fields in this section
			'fields' => array(
				'layout_type' => array(
					'title'			=> __( 'Layout Type', 'cazuela' ),
					'description'	=> __( 'Full-width or boxed', 'cazuela' ),
					'type'			=> 'image-radios',
					'choices'		=> array(
						'layout-full-width' => array(
							'title'			=> __( 'Full width', 'cazuela' )
						),
						'layout-boxed' => array(
							'title'			=> __( 'Boxed', 'cazuela' )
						)
					),
					'since'			=> '1.0',
					'default'		=> 'layout-full-width'
				),
				'default_layout' => array(
					'title'			=> __( 'Default Page Layout', 'cazuela' ),
					'description'	=> __( 'Select default theme layout', 'cazuela' ),
					'type'			=> 'image-radios',
					'choices'		=> array(
						'layout-c' => array(
							'title'			=> __( 'Content', 'cazuela' ),
							'description'	=> __( 'One column', 'cazuela' )
						),
						'layout-cp' => array(
							'title'			=> __( 'Content - Primary Sidebar', 'cazuela' ),
							'description'	=> __( 'Two columns', 'cazuela' )
						),
						'layout-pc' => array(
							'title'			=> __( 'Primary Sidebar - Content', 'cazuela' ),
							'description'	=> __( 'Two columns', 'cazuela' )
						),
						'layout-cps' => array(
							'title'			=> __( 'Content - Primary Sidebar - Secondary Sidebar', 'cazuela' ),
							'description'	=> __( 'Three columns', 'cazuela' )
						),
						'layout-psc' => array(
							'title'			=> __( 'Primary Sidebar - Secondary Sidebar - Content', 'cazuela' ),
							'description'	=> __( 'Three columns', 'cazuela' )
						),
						'layout-pcs' => array(
							'title'			=> __( 'Primary Sidebar - Content - Secondary Sidebar', 'cazuela' ),
							'description'	=> __( 'Three columns', 'cazuela' )
						)
					),
					'since'			=> '1.0',
					'default'		=> 'layout-cp'
				),
				
				'archives_layout' => array(
					'title'			=> __( 'Archives Layout', 'cazuela' ),
					'description'	=> __( 'Select archives layout', 'cazuela' ),
					'type'			=> 'select',
					'choices'		=> array(
						'archives-standard' => array(
							'title'			=> __( 'Standard', 'cazuela' ),
							'description'	=> __( 'Standard layout', 'cazuela' )
						),
						'archives-thumbs' => array(
							'title'			=> __( 'Post thumbnails on left side', 'cazuela' ),
							'description'	=> __( 'Only excerpts shown', 'cazuela' )
						),
						'archives-bricks' => array(
							'title'			=> __( 'Pinterest-ish', 'cazuela' ),
							'description'	=> __( 'No sidebar', 'cazuela' )
						)
					),
					'since'			=> '1.0',
					'default'		=> 'archives-thumbs'
				)
			)
		),
			
		'thsp_typography_section' => array(
			'title' => __( 'Fonts', 'cazuela' ),
			'description' => __( 'Select fonts', 'cazuela' ),
			'fields' => array(
				'body_font' => array(
					'title'			=> __( 'Body font', 'cazuela' ),
					'type'			=> 'select',
					'description'	=> __( 'Select body font', 'cazuela' ),
					'choices' => array(
						'arial' => array(
							'title'		=> 'Arial'
						),
						'helvetica' => array(
							'title'		=> 'Helvetica'
						),
						'open-sans' => array(
							'title'			=> 'Open Sans',
							'google_font'	=> 'Open+Sans:400italic,700italic,400,700'
						),
						'lato' => array(
							'title'			=> 'Lato',
							'google_font'	=> 'Lato:400,700,400italic,700italic'
						),
						'pt-sans' => array(
							'title'			=> 'PT Sans',
							'google_font'	=> 'PT+Sans:400,700,400italic,700italic'
						),
						'gudea' => array(
							'title'			=> 'Gudea',
							'google_font'	=> 'Gudea:400,700,400italic'
						),
						'lora' => array(
							'title'			=> 'Lora',
							'google_font'	=> 'Lora:400,700,400italic,700italic'
						),
						'istok-web' => array(
							'title'			=> 'Istok Web',
							'google_font'	=> 'Istok+Web:400,700,400italic,700italic'
						),
					),
					'since'			=> '1.0',
					'default'		=> 'open-sans',
				),
				
				'heading_font' => array(
					'title'			=> __( 'Heading font', 'cazuela' ),
					'type'			=> 'select',
					'description'	=> __( 'Select heading font', 'cazuela' ),
					'choices' => array(
						'georgia' => array(
							'title'			=> 'Georgia'
						),
						'open-sans' => array(
							'title'			=> 'Open Sans',
							'google_font'	=> 'Open+Sans:400italic,700italic,400,700'
						),
						'lato' => array(
							'title'			=> 'Lato',
							'google_font'	=> 'Lato:700,700italic'
						),
						'oswald' => array(
							'title'			=> 'Oswald',
							'google_font'	=> 'Oswald:700'
						),
						'bitter' => array(
							'title'			=> 'Bitter',
							'google_font'	=> 'Bitter:700'
						),
						'merriweather' => array(
							'title'			=> 'Merriweather',
							'google_font'	=> 'Merriweather:700'
						),
						'droid-serif' => array(
							'title'			=> 'Droid Serif',
							'google_font'	=> 'Droid+Serif:700'
						)     
					),
					'since'			=> '1.0',
					'default'		=> 'open-sans',
				)				
			)
			
		)
		
	);
	
	return $options;
	
}


/**
 * Get Theme Options Values
 * 
 * Array that holds all of the defined values for theme options. If the user 
 * has not specified a value for a given Theme option, then the option's 
 * default value is used instead.
 *
 * @uses	thsp_get_theme_option_defaults()	defined in /inc/theme-options/get-options.php
 * @return	array								Current values for all theme options
 * @since Cazuela 1.0
 */
function thsp_get_theme_options() {

	// Get the option defaults
	$option_defaults = thsp_get_theme_option_defaults();
	
	// Parse the stored options with the defaults
	$thsp_cazuela_options = wp_parse_args( get_option( 'thsp_cazuela_options', array() ), $option_defaults );
	
	// Return the parsed array
	return $thsp_cazuela_options;
	
}


/**
 * Get Theme Options Defaults
 * 
 * Returns an array that holds default values for all theme options.
 * 
 * @uses	thsp_get_theme_options_fields()		defined in /inc/theme-options/get-options.php
 * @return	array	$thsp_option_defaults		array of option defaults
 * @since Cazuela 1.0
 */
function thsp_get_theme_option_defaults() {

	// Get the array that holds all theme option fields
	$thsp_sections = thsp_get_theme_options_fields();
	
	// Initialize the array to hold the default values for all theme options
	$thsp_option_defaults = array();
	
	// Loop through the option parameters array
	foreach ( $thsp_sections as $thsp_section ) {
	
		$thsp_section_fields = $thsp_section['fields'];
		
		foreach ( $thsp_section_fields as $thsp_field_key => $thsp_field_value ) {

			// Add an associative array key to the defaults array for each option in the parameters array
			if( isset( $thsp_field_value['default'] ) ) {
				$thsp_option_defaults[$thsp_field_key] = $thsp_field_value['default'];
			} else {
				$thsp_option_defaults[$thsp_field_key] = false;
			}
			
		}
		
		
	}
	
	// Return the defaults array
	return $thsp_option_defaults;
	
}