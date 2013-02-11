<?php

/**
 * Get Theme Customizer Fields
 *
 * @package		Theme_Customizer_Boilerplate
 * @copyright	Copyright (c) 2013, Slobodan Manic
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Slobodan Manic
 *
 * @since		Theme_Customizer_Boilerplate 1.0
 */


/**
 * Helper function that holds array of theme options.
 *
 * @return	array	$options	Array of theme options
 * @uses	thsp_get_theme_customizer_fields()	defined in customizer/helpers.php
 */
function thsp_cbp_get_fields() {

	/*
	 * Using helper function to get default required capability
	 */
	$required_capability = thsp_cbp_capability();
	
	$options = array(

		
		// Section ID
		'colors' => array(
		
			'existing_section' => true,
			'fields' => array(
				
				'color_scheme' => array(
					'setting_args' => array(
						'default' => 'scheme-black',
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Color scheme', 'thsp_cazuela' ),
						'type' => 'images-radio', // Images (radio replacement)
						'choices_extended' => array(
							'scheme-black' => array(
								'label' => __( 'Black', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-black.png'
							),
							'scheme-white' => array(
								'label' => __( 'White', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-white.png'
							),
							'scheme-blue' => array(
								'label' => __( 'Blue', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-blue.png'
							),
							'scheme-brown' => array(
								'label' => __( 'Brown', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-brown.png'
							),
							'scheme-candy-red' => array(
								'label' => __( 'Candy red', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-candy-red.png'
							),
							'scheme-cobalt' => array(
								'label' => __( 'Cobalt', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-cobalt.png'
							),
							'scheme-grey' => array(
								'label' => __( 'Grey', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-grey.png'
							),
							'scheme-lime-green' => array(
								'label' => __( 'Lime green', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-lime-green.png'
							),
							'scheme-orange' => array(
								'label' => __( 'Orange', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-orange.png'
							),
							'scheme-plum-purple' => array(
								'label' => __( 'Plum purple', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/scheme-plum-purple.png'
							),
							'scheme-red' => array(
								'label' => __( 'Red', 'thsp_cazuela' ),
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
						'capability' => $required_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Header gradient', 'thsp_cazuela' ),
						'type' => 'checkbox', // Checkbox field control
						'priority' => 2
					)
				),

				'links_color' => array(
					'setting_args' => array(
						'default' => '#1e559b',
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Links color', 'thsp_cazuela' ),
						'type' => 'color', // Color picker field control
						'priority' => 3
					)
				),

				'image_upload' => array(
					'setting_args' => array(
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Image upload', 'thsp_cazuela' ),
						'type' => 'image', // Color picker field control
						'priority' => 3
					)
				),

				'file_upload' => array(
					'setting_args' => array(
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'File upload', 'thsp_cazuela' ),
						'type' => 'upload', // File upload field control
						'priority' => 3
					)
				),
				
			) // End fields
		),
		
		// Section ID
		'nav' => array(
		
			'existing_section' => true,
			'fields' => array(
				
				'post_navigation_above' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Navigation above posts', 'thsp_cazuela' ),
						'type' => 'checkbox', // Checkbox field control
						'priority' => 20
					)
				),

				'post_navigation_below' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Navigation below posts', 'thsp_cazuela' ),
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
				'title' => __( 'Layout', 'thsp_cazuela' ),
				'description' => __( 'Set default page layout', 'thsp_cazuela' ),
				'priority' => 10
			),
			'fields' => array(
				
				'layout_type' => array(
					'setting_args' => array(
						'default' => 'layout-full-width',
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Layout type', 'thsp_cazuela' ),
						'type' => 'images-radio', // Image radio replacement
						'choices_extended' => array(
							'layout-full-width' => array(
								'label' => __( 'Full width', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-full-width.png'
							),
							'layout-boxed' => array(
								'label' => __( 'Boxed', 'thsp_cazuela' ),
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
						'capability' => $required_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Default layout', 'thsp_cazuela' ),
						'type' => 'images-radio', // Image radio replacement
						'choices_extended' => array(
							'layout-c' => array(
								'label' => __( 'Content', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-c.png'
							),
							'layout-cp' =>  array(
								'label' => __( 'Content - Primary Sidebar', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-cp.png'
							),
							'layout-pc' => array(
								'label' => __( 'Primary Sidebar - Content', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-pc.png'
							),
							'layout-cps' => array(
								'label' => __( 'Content - Primary Sidebar - Secondary Sidebar', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-cps.png'
							),
							'layout-psc' => array(
								'label' => __( 'Primary Sidebar - Secondary Sidebar - Content', 'thsp_cazuela' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/layout-psc.png'
							),
							'layout-pcs' => array(
								'label' => __( 'Primary Sidebar - Content - Secondary Sidebar', 'thsp_cazuela' ),
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
				'title' => __( 'Typography', 'thsp_cazuela' ),
				'description' => __( 'Select fonts', 'thsp_cazuela' ),
				'priority' => 20
			),
			'fields' => array(
				
				'body_font' => array(
					'setting_args' => array(
						'default' => 'open-sans',
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Body font', 'thsp_cazuela' ),
						'type' => 'select', // Select control
						'choices_extended' => array(
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
						/*
						'choices' => array(
							'arial' => 'Arial',
							'helvetica' => 'Helvetica',
							'open-sans' => 'Open Sans',
							'lato' => 'Lato',
							'pt-sans' => 'PT Sans',
							'gudea' => 'Gudea',
							'lora' => 'Lora',
							'istok-web' => 'Istok Web'
						),
						*/				
						'priority' => 1
					) // End control args
				),

				'heading_font' => array(
					'setting_args' => array(
						'default' => 'open-sans',
						'type' => 'option',
						'capability' => $required_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Heading font', 'thsp_cazuela' ),
						'type' => 'select', // Select control
						'choices_extended' => array(
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
	
	/* 
	 * 'thsp_customizer_options' filter hook will allow you to 
	 * add/remove some of these options from a child theme
	 */
	return apply_filters( 'thsp_cbp_options', $options );
	
}