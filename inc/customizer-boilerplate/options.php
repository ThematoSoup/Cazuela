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
						'type' => 'select', // Select control
						'choices' => array(
							'scheme-black' => __( 'Black', 'thsp_cazuela' ),
							'scheme-white' => __( 'White', 'thsp_cazuela' ),
							'scheme-blue' => __( 'Blue', 'thsp_cazuela' ),
							'scheme-brown' => __( 'Brown', 'thsp_cazuela' ),
							'scheme-candy-red' => __( 'Candy red', 'thsp_cazuela' ),
							'scheme-cobalt' => __( 'Cobalt', 'thsp_cazuela' ),
							'scheme-grey' => __( 'Grey', 'thsp_cazuela' ),
							'scheme-lime-green' => __( 'Lime green', 'thsp_cazuela' ),
							'scheme-orange' => __( 'Orange', 'thsp_cazuela' ),
							'scheme-plum-purple' => __( 'Plum purple', 'thsp_cazuela' ),
							'scheme-red' => __( 'Red', 'thsp_cazuela' )
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
						'type' => 'select', // Select control
						'choices' => array(
							'layout-full-width' => __( 'Full width', 'thsp_cazuela' ),
							'layout-boxed' => __( 'Boxed', 'thsp_cazuela' )
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
						'type' => 'select', // Select control
						'choices' => array(
							'layout-c' => __( 'Content', 'thsp_cazuela' ),
							'layout-cp' =>  __( 'Content - Primary Sidebar', 'thsp_cazuela' ),
							'layout-pc' => __( 'Primary Sidebar - Content', 'thsp_cazuela' ),
							'layout-cps' => __( 'Content - Primary Sidebar - Secondary Sidebar', 'thsp_cazuela' ),
							'layout-psc' => __( 'Primary Sidebar - Secondary Sidebar - Content', 'thsp_cazuela' ),
							'layout-pcs' => __( 'Primary Sidebar - Content - Secondary Sidebar', 'thsp_cazuela' )
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