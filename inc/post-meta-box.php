<?php


/**
 * Adds post layout meta box to post edit screen
 *
 * @since	Cazuela 1.0
 */
function thsp_layout_meta_box() {

	add_meta_box(
		'thsp-post-layout',
		'Post Layout',
		'thsp_post_layout_meta_cb',
		'post',
		'normal',
		'high'
	);

	add_meta_box(
		'thsp-post-layout',
		'Page Layout',
		'thsp_post_layout_meta_cb',
		'page',
		'normal',
		'high'
	);
	
}
add_action( 'add_meta_boxes', 'thsp_layout_meta_box' );


/**
 * Post layout meta box calllback
 *
 * @uses	thsp_get_theme_options()			Defined in /inc/get-options.php
 * @uses	thsp_get_theme_customizer_fields()		Defined in /inc/get-options.php
 * @since	Cazuela 1.0
 */
function thsp_post_layout_meta_cb( $post ) {

	if( get_post_meta( $post->ID, '_thsp_post_layout', true ) ) {
		$current_layout = get_post_meta( $post->ID, '_thsp_post_layout', true );
	} else {
		// Get current theme options and all option fields
		$theme_options = thsp_cbp_get_options_values();
		$current_layout = $theme_options['default_layout'];
	}

	wp_nonce_field( 'thsp_save_post_layout', 'thsp_layout_nonce' ); ?>
	
	<fieldset class="clearfix">
		<p>You can override default layout set in theme settings</p>
		
		<?php
		$thsp_theme_options_fields = thsp_cbp_get_fields();
		$layout_options = $thsp_theme_options_fields['thsp_layout_section']['fields']['default_layout']['control_args']['choices'];
		foreach( $layout_options as $layout_option_key => $layout_option_value ) { ?>
	
			<input id="_thsp_post_layout_<?php echo esc_attr( $layout_option_key ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $layout_option_key ); ?>" name="_thsp_post_layout" <?php checked( $layout_option_key, $current_layout ); ?> />
			
			<label for="_thsp_post_layout_<?php echo esc_attr( $layout_option_key ); ?>">
				<img src="<?php echo $layout_option_value['image_src']; ?>" alt="<?php echo $layout_option_value['label']; ?>" width="60" height="40" />
			</label>
			
		<?php } // end foreach ?>
	</fieldset>
	<?php
	
}


/**
 * Saves post layout meta box
 *
 * @uses	thsp_cbp_get_options_values()
 * @since	Cazuela 1.0
 */
function thsp_save_post_layout( $postid ) {

	// Do nothing if an autosave
	if( wp_is_post_revision( $postid) || wp_is_post_autosave( $postid ) )
		return;
		
	// Check nonce field
	if( !isset( $_POST['thsp_layout_nonce'] ) || !wp_verify_nonce( $_POST['thsp_layout_nonce'], 'thsp_save_post_layout' ) )
		return;
		
	// Check user's capability
	if( !current_user_can( 'edit_posts' ) )
		return;
		
	// Get current theme options and all option fields
	$theme_options = thsp_cbp_get_options_values();
	if( isset( $_POST['_thsp_post_layout'] ) ) {
	
		// Update the meta field if it's not the same as theme setting
		if( $_POST['_thsp_post_layout'] != $theme_options['default_layout'] ) {
			update_post_meta( $postid, '_thsp_post_layout', esc_attr( strip_tags( $_POST['_thsp_post_layout'] ) ) );
		// If meta field is the same as theme setting, delete meta field 
		} else {
			delete_post_meta( $postid, '_thsp_post_layout' );
		}
		
	}
	
}
add_action( 'save_post', 'thsp_save_post_layout' );


/**
 * Adds CSS to post layout meta box
 *
 * @since	Cazuela 1.0
 */
function thsp_meta_box_style() {

	wp_enqueue_style(
		'thsp_meta_box_style',
		thsp_cbp_directory_uri() . '/customizer-controls.css'
	);

}
add_action( 'admin_print_styles-post-new.php', 'thsp_meta_box_style', 11 );
add_action( 'admin_print_styles-post.php', 'thsp_meta_box_style', 11 );