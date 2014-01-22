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
	$thsp_cbp_capability = thsp_cbp_capability();
	
	$options = array(

		
		// Section ID
		'new_customizer_section' => array(
		
			/*
			 * We're checking if this is an existing section
			 * or a new one that needs to be registered
			 */
			'existing_section' => false,
			/*
			 * Section related arguments
			 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
			 */
			'args' => array(
				'title' => __( 'New Section Title', 'my_theme_textdomain' ),
				'description' => __( 'New section description', 'my_theme_textdomain' ),
				'priority' => 1
			),
			
			/* 
			 * This array contains all the fields that need to be
			 * added to this section
			 */
			'fields' => array(
				
				/*
				 * ==========
				 * ==========
				 * Text field
				 * ==========
				 * ==========
				 */
				// Field ID
				'new_text_field' => array(
					/*
					 * Setting related arguments
					 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
					 */
					'setting_args' => array(
						'default' => __( 'Default value', 'my_theme_textdomain' ),
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					/*
					 * Control related arguments
					 * Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
					 */
					'control_args' => array(
						'label' => __( 'New text field label', 'my_theme_textdomain' ),
						'type' => 'text', // Text field control
						'priority' => 1
					)
				),				

				/*
				 * ==============
				 * ==============
				 * Checkbox field
				 * ==============
				 * ==============
				 */
				'new_checkbox_field' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'New checkbox field label', 'my_theme_textdomain' ),
						'type' => 'checkbox', // Checkbox field control
						'priority' => 2
					)
				),				

				/*
				 * ===========
				 * ===========
				 * Radio field
				 * ===========
				 * ===========
				 */
				'new_radio_field' => array(
					'setting_args' => array(
						'default' => 'option-2',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'New radio control label', 'my_theme_textdomain' ),
						'type' => 'radio', // Radio control
						'choices' => array(
							'option-1' => array(
								'label' => __( 'Option 1', 'my_theme_textdomain' )
							),
							'option-2' => array(
								'label' => __( 'Option 2', 'my_theme_textdomain' )
							),
							'option-3' => array(
								'label' => __( 'Option 3', 'my_theme_textdomain' )
							)
						),					
						'priority' => 3
					)
				),

				/*
				 * ============
				 * ============
				 * Select field
				 * ============
				 * ============
				 */
				'new_select_field' => array(
					'setting_args' => array(
						'default' => 'option-3',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'New select field label', 'my_theme_textdomain' ),
						'type' => 'select', // Select control
						'choices' => array(
							'option-1' => array(
								'label' => __( 'Option 1', 'my_theme_textdomain' )
							),
							'option-2' => array(
								'label' => __( 'Option 2', 'my_theme_textdomain' )
							),
							'option-3' => array(
								'label' => __( 'Option 3', 'my_theme_textdomain' )
							)
						),					
						'priority' => 4
					)
				),

				/*
				 * ===========
				 * ===========
				 * File Upload
				 * ===========
				 * ===========
				 */
				'new_file_upload_field' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'File upload', 'my_theme_textdomain' ),
						'type' => 'upload', // File upload field control
						'priority' => 5
					)
				),

				/*
				 * ============
				 * ============
				 * Image Upload
				 * ============
				 * ============
				 */
				'new_image_upload_field' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Image upload', 'my_theme_textdomain' ),
						'type' => 'image', // Image upload field control
						'priority' => 6
					)
				),

				/*
				 * ==============
				 * ==============
				 * Textarea Field
				 * ==============
				 * ==============
				 */
				'new_textarea_field' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Textarea', 'my_theme_textdomain' ),
						'type' => 'textarea', // Textarea control
						'priority' => 7
					)
				),

				/*
				 * ============
				 * ============
				 * Number Field
				 * ============
				 * ============
				 */
				'new_number_field' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Number', 'my_theme_textdomain' ),
						'type' => 'number', // Textarea control
						'priority' => 8
					)
				),

				/*
				 * ========================
				 * ========================
				 * Image replacement radios
				 * ========================
				 * ========================
				 */
				'new_images_radio_field' => array(
					'setting_args' => array(
						'default' => 'option_1',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					), // End setting args			
					'control_args' => array(
						'label' => __( 'Layout type', 'my_theme_textdomain' ),
						'type' => 'images_radio', // Image radio replacement
						'choices' => array(
							'option_1' => array(
								'label' => __( 'Option 1', 'my_theme_textdomain' ),
								// Define source for each image
								'image_src' => get_template_directory_uri() . '/images/theme-options/option-1.png'
							),
							'option_2' => array(
								'label' => __( 'Option 2', 'my_theme_textdomain' ),
								'image_src' => get_template_directory_uri() . '/images/theme-options/option-2.png'
							)
						),					
						'priority' => 9
					) // End control args
				),

			),
			
		),

		/*
		 * Add fields to an existing Customizer section
		 */
		'colors' => array(
			'existing_section' => true,
			'fields' => array(

				/*
				 * ==============
				 * ==============
				 * Checkbox field
				 * ==============
				 * ==============
				 */
				'new_checkbox_field_colors' => array(
					'setting_args' => array(
						'default' => true,
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'New color field label', 'my_theme_textdomain' ),
						'type' => 'checkbox', // Checkbox field control
						'priority' => 1
					)
				)	
						
			)
		)

	);
	
	/* 
	 * 'thsp_cbp_options_array' filter hook will allow you to 
	 * add/remove some of these options from a child theme
	 */
	return apply_filters( 'thsp_cbp_options_array', $options );
	
}