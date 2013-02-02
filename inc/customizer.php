<?php
/**
 * Theme Customizer
 *
 * @package		Cazuela
 * @since		Cazuela 1.0
 */


/**
 * Adds Customizer Sections, Settings and Controls
 *
 * - Customizer Textarea Control (Custom)
 * - Customizer Number Control (Custom)
 * - Add Customizer Sections
 * - Add Customizer Controls
 *  -- Add Textarea Control
 *  -- Add Number Control
 *
 * @uses	thsp_get_theme_options_sections()	Defined in helpers.php
 * @uses	thsp_settings_page_capability()		Defined in helpers.php
 * @uses	thsp_get_theme_options_fields()		Defined in get-options.php
 *
 * @link	$wp_customize->add_section			http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
 * @link	$wp_customize->add_setting			http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
 * @link	$wp_customize->add_control			http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
 */
add_action( 'customize_register', 'thsp_customize_register' );
function thsp_customize_register( $wp_customize ) {

	// Renaming "Header Image" section to "Logo"
	$wp_customize->add_section( 'header_image', array(
	     'title'          => __( 'Logo' ),
	     'theme_supports' => 'custom-header',
	     'priority'       => 60,
	) );

	/**
	 * Creates Customizer control for textarea field
	 *
	 * @link	http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
	 * @since	TS_Theme_Settings 1.0
	 */
	class Customizer_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}

	/**
	 * Creates Customizer control for radio replacement images fields
	 */
	class Customizer_Images_Control extends WP_Customize_Control {
		public $type = 'image-radios';
		
		public function render_content() {
			if ( empty( $this->choices ) )
				return;
	
			$name = '_customize-image-radios-' . $this->id;
			?>
			
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php
			foreach ( $this->choices as $value => $label ) {
				?>
				<input id="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
				
				<label for="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>">
					<img src="<?php echo get_template_directory_uri() . '/inc/images/' . $value . '.png' ?>" alt="<?php echo $label; ?>" />
				</label>
				<?php
			} // end foreach
		}
		
		public function enqueue() {
			wp_enqueue_style(
				'thsp_customizer_style',
				get_template_directory_uri() . '/inc/customizer-controls.css'
			);
		}
	}

	/**
	 * Creates Customizer control for input[type=number] field
	 */
	class Customizer_Number_Control extends WP_Customize_Control {
		public $type = 'number';
		
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
			</label>
		<?php
		}
	}

	/**
	 * Adds Customizer sections
	 */
	$thsp_sections = thsp_get_theme_options_fields();
	foreach( $thsp_sections as $thsp_section_key => $thsp_section_value ) {
		
		/*
		 * In case we're adding a field to an existing section
		 * no need to add it again
		 */
		if( !isset( $thsp_section_value['existing_section'] ) ) {
			$wp_customize->add_section(
				$thsp_section_key,
				array(
					'title'          => $thsp_section_value['title'],
					'priority'       => 5
				)
			);
		}

		// Now go through each section's fields
		foreach( $thsp_section_value['fields'] as $thsp_field_key => $thsp_field_value ) {
	
			// Make sure option should not be hidden in customizer
			if( !isset( $thsp_field_value['customizer_hide'] ) ) {
			
				$setting_args = array(
					'capability'	=> 'edit_theme_options',
					'type'			=> 'option',
					'transport'		=> 'refresh'
				);
				
				// Check for default value
				if( isset( $thsp_field_value['default'] ) ) {
					$setting_args['default'] = $thsp_field_value['default'];
				}
	
				/**
				 * Adds Customizer settings
				 */
				$wp_customize->add_setting(
					"thsp_cazuela_options[$thsp_field_key]",
					$setting_args
				);		
				
				$control_args = array(
					'label'		=> $thsp_field_value['title'],
					'section'	=> $thsp_section_key,
					'settings'	=> "thsp_cazuela_options[$thsp_field_key]",
					'type'		=> $thsp_field_value['type']
				);
				
				// Check if priority has been specified
				if( isset( $thsp_field_value['priority'] ) ) {
					$control_args['priority'] = $thsp_field_value['priority'];
				}
				
				// Check if there's an array of possible values, add it to $args array
				if( isset( $thsp_field_value['choices'] ) ) {
					$given_options = array();
					foreach( $thsp_field_value['choices'] as $given_option_key => $given_option_value ) {
						$given_options[$given_option_key] = $given_option_value['title'];
					}
					$control_args['choices'] = $given_options;
				}
			
				// Check if it's a textarea control (custom)
				if( 'textarea' == $thsp_field_value['type'] ) {
		
					/**
					 * Adds Customizer textarea control
					 */
					$wp_customize->add_control(
						new Customizer_Textarea_Control(
							$wp_customize,
							"thsp_cazuela_options[$thsp_field_key]",
							$control_args
						)
					);		
				
				// Check if it's a number control
				} elseif( 'number' == $thsp_field_value['type'] ) {
		
					/**
					 * Adds Customizer input[type=number] control
					 */
					$wp_customize->add_control(
						new Customizer_Number_Control(
							$wp_customize,
							"thsp_cazuela_options[$thsp_field_key]",
							$control_args
						)
					);		
		
				// Check if it's color picker
				} elseif( 'color' == $thsp_field_value['type'] ) {

					/**
					 * Adds Colorpicker control
					 */
					$wp_customize->add_control(
						new WP_Customize_Color_Control(
							$wp_customize,
							"thsp_cazuela_options[$thsp_field_key]",
							$control_args
						)
					);		

				// Check if it's images replacement radio
				} elseif( 'image-radios' == $thsp_field_value['type'] ) {

					/**
					 * Adds Customizer images replacement radio control
					 */
					$wp_customize->add_control(
						new Customizer_Images_Control(
							$wp_customize,
							"thsp_cazuela_options[$thsp_field_key]",
							$control_args
						)
					);		
	
				// All other controls
				} else {
				
					/**
					 * Adds Customizer built-in control
					 */
					$wp_customize->add_control(
						"thsp_cazuela_options[$thsp_field_key]",
						$control_args
					);
				
				} // end check control type
				
			} // end if
			
		} // end foreach

	} // end foreach
	
	/*
	 * Remove controls that are not needed
	 * Header text color
	 */	
	$wp_customize->remove_control( 'header_textcolor' );	

}