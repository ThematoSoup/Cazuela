<?php


/**
 * Adds post layout meta box to post edit screen
 *
 * @since	Cazuela 1.0
 */
function thsp_layout_meta_box() {

	add_meta_box(
		'thsp-post-layout',
		'Post Options',
		'thsp_post_layout_meta_cb',
		'post',
		'normal',
		'high'
	);

	add_meta_box(
		'thsp-post-layout',
		'Page Options',
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

	wp_nonce_field( 'thsp_save_post_layout', 'thsp_layout_nonce' );
	
	// Layout switcher is not needed in Masonry template
	if ( 'page-templates/template-masonry.php' != get_post_meta( $post->ID, '_wp_page_template', true ) ) { ?>
		<fieldset class="clearfix">
			<h4><?php _e( 'Post/page layout', 'cazuela' ); ?></h4>
			<p><?php _e( 'You can override default layout set in theme settings', 'cazuela' ); ?></p>
			
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
	
	// Add fields that are specific to Authors template
	if ( 'page-templates/template-authors.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) { ?>
	
	<fieldset class="clearfix">
		<h4><?php _e( 'Author template settings', 'cazuela' ); ?></h4>
		
		<p class="meta-options">
			<div style="margin-bottom:0.25em"><?php _e( 'Order authors by:', 'cazuela' ); ?></div>
						
			<label for="_thsp_authors_query_orderby[display_name]">
				<input name="_thsp_authors_query_orderby" type="radio" id="_thsp_authors_query_orderby[display_name]" value="display_name" <?php checked( get_post_meta( $post->ID, '_thsp_authors_query_orderby', true ), 'display_name' ); ?> /> 
				<?php _e( 'Display name', 'cazuela' ); ?>
			</label>
			<br />
			
			<label for="_thsp_authors_query_orderby[post_count]">
				<input name="_thsp_authors_query_orderby" type="radio" id="_thsp_authors_query_orderby[post_count]" value="post_count" <?php checked( get_post_meta( $post->ID, '_thsp_authors_query_orderby', true ), 'post_count' ); ?> /> 
				<?php _e( 'Post count', 'cazuela' ); ?>
			</label>
			<br />
		</p>
		
		<p class="meta-options">
			<div style="margin-bottom:0.25em"><?php _e( 'Order:', 'cazuela' ); ?></div>
						
			<label for="_thsp_authors_query_order[ASC]">
				<input name="_thsp_authors_query_order" type="radio" id="_thsp_authors_query_order[ASC]" value="ASC" <?php checked( get_post_meta( $post->ID, '_thsp_authors_query_order', true ), 'ASC' ); ?> /> 
				<?php _e( 'Ascending', 'cazuela' ); ?>
			</label>
			<br />
			
			<label for="_thsp_authors_query_order[DESC]">
				<input name="_thsp_authors_query_order" type="radio" id="_thsp_authors_query_order[DESC]" value="DESC" <?php checked( get_post_meta( $post->ID, '_thsp_authors_query_order', true ), 'DESC' ); ?> /> 
				<?php _e( 'Descending', 'cazuela' ); ?>
			</label>
			<br />
		</p>

		<p class="meta-options">
			<div style="margin-bottom:0.25em"><label for="_thsp_authors_roles_to_include"><?php _e( 'User roles to include (Cmd/Ctrl + click to select multiple roles):', 'cazuela' ); ?></label></div>
						
			<select multiple name="_thsp_authors_roles_to_include[]" id="_thsp_authors_roles_to_include" class="widefat" style="height:6.75em;margin-bottom:1em;background:#fff">
			<?php
				global $wp_roles;

				foreach ( $wp_roles->roles as $role_key => $role_value ) {
					if ( get_post_meta( $post->ID, '_thsp_authors_roles_to_include', true ) && in_array( $role_key, get_post_meta( $post->ID, '_thsp_authors_roles_to_include', true ) ) ) {
						$role_selected = 'selected="selected"';
					} else {
						$role_selected = '';
					}
					?>
					<option id="_thsp_authors_roles_to_include[<?php echo $role_key; ?>]" value="<?php echo $role_key; ?>" <?php echo $role_selected; ?>><?php echo $role_value['name']; ?></option>
				<?php }
			?>			
			</select>
			<br />
			
			<div><?php _e( 'Please note that if you select only certain user roles, sorting you specified above will still work, but will be applied per role. For example, Administrator users would go first, sorted, then Editors and so on&hellip;', 'cazuela' ); ?></div>
		</p>
	</fieldset>

	<?php } // End fields specific to Authors template

	// Add fields that are specific to Masonry template
	if ( 'page-templates/template-masonry.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) { ?>
	
	<fieldset class="clearfix">
		<h4><?php _e( 'Masonry template settings', 'cazuela' ); ?></h4>
		
		<p class="meta-options">
			<div style="margin-bottom:0.25em"><label for="_thsp_masonry_categories_to_include"><?php _e( 'Categories to include (Cmd/Ctrl + click to select multiple categories):', 'cazuela' ); ?></label></div>
						
			<select multiple name="_thsp_masonry_categories_to_include[]" id="_thsp_masonry_categories_to_include" class="widefat" style="height:13.2em;margin-bottom:1em;background:#fff">
			<?php
				$masonry_categories = get_categories(); 

				foreach ( $masonry_categories as $masonry_category ) {
					if ( get_post_meta( $post->ID, '_thsp_masonry_categories_to_include', true ) && in_array( $masonry_category->term_id, get_post_meta( $post->ID, '_thsp_masonry_categories_to_include', true ) ) ) {
						$masonry_category_selected = 'selected="selected"';
					} else {
						$masonry_category_selected = '';
					}
					?>
					<option id="_thsp_masonry_categories_to_include[<?php echo $masonry_category->term_id; ?>]" value="<?php echo $masonry_category->term_id; ?>" <?php echo $masonry_category_selected; ?>><?php echo $masonry_category->name; ?></option>
				<?php }
			?>			
			</select>
		</p>

		<p class="meta-options">
			<div style="margin-bottom:0.25em"><label for="_thsp_authors_query_orderby[display_name]"><?php _e( 'Number of posts per page in this template:', 'cazuela' ); ?></label></div>
						
			<?php
				if ( get_post_meta( $post->ID, '_thsp_masonry_posts_per_page', true ) ) {
					$masonry_posts_per_page = get_post_meta( $post->ID, '_thsp_masonry_posts_per_page', true );
				} else {
					$masonry_posts_per_page = get_option( 'posts_per_page' );
				}
			?>
			<input name="_thsp_masonry_posts_per_page" type="number" min="-1" id="_thsp_masonry_posts_per_page" value="<?php echo $masonry_posts_per_page; ?>" <?php checked( get_post_meta( $post->ID, '_thsp_authors_query_orderby', true ), 'display_name' ); ?> class="small-text" /> 
			<br />
		</p>

		<div><?php _e( 'If you\'d like to show all posts set number of posts per page to -1', 'cazuela' ); ?></div>
	</fieldset>

	<?php } // End fields specific to Authors template
	
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
	
	// Post/page layout field
	if ( isset( $_POST['_thsp_post_layout'] ) ) {
		// Update the post layout meta field if it's not the same as theme setting
		if ( $_POST['_thsp_post_layout'] != $theme_options['default_layout'] ) {
			update_post_meta( $postid, '_thsp_post_layout', esc_attr( strip_tags( $_POST['_thsp_post_layout'] ) ) );
		// If meta field is the same as theme setting, delete meta field 
		} else {
			delete_post_meta( $postid, '_thsp_post_layout' );
		}
	}	

	// Orderby parameter for Authors template
	if ( isset( $_POST['_thsp_authors_query_orderby'] ) && in_array( $_POST['_thsp_authors_query_orderby'], array( 'display_name', 'post_count' ) ) ) {
		update_post_meta( $postid, '_thsp_authors_query_orderby', $_POST['_thsp_authors_query_orderby'] );	
	}	

	// Order parameter for Authors template
	if ( isset( $_POST['_thsp_authors_query_order'] ) && in_array( $_POST['_thsp_authors_query_order'], array( 'ASC', 'DESC' ) ) ) {
		update_post_meta( $postid, '_thsp_authors_query_order', $_POST['_thsp_authors_query_order'] );	
	}	

	// Roles to include parameter for Authors template
	if ( isset( $_POST['_thsp_authors_roles_to_include'] ) ) {
		global $wp_roles;

		// Roles are being stored as an array
		$thsp_included_roles = array();
		foreach ( $_POST['_thsp_authors_roles_to_include'] as $thsp_user_role ) {
			if ( in_array( $thsp_user_role, array_keys( $wp_roles->roles ) ) ) {
				$thsp_included_roles[] = $thsp_user_role;
			}
		}
		// Remove last comma
		update_post_meta( $postid, '_thsp_authors_roles_to_include', $thsp_included_roles );
	} else {
		delete_post_meta( $postid, '_thsp_authors_roles_to_include' );	
	}
	
	// Posts per page parameter for Masonry template
	if ( isset( $_POST['_thsp_masonry_posts_per_page'] ) && is_numeric( $_POST['_thsp_masonry_posts_per_page'] ) ) {
		update_post_meta( $postid, '_thsp_masonry_posts_per_page', $_POST['_thsp_masonry_posts_per_page'] );	
	}	

	// Categories to include parameter for Masonry template
	if ( isset( $_POST['_thsp_masonry_categories_to_include'] ) ) {
		// Categories are being stored as an array
		$masonry_included_categories = array();
		foreach ( $_POST['_thsp_masonry_categories_to_include'] as $masonry_included_category ) {
			if ( is_numeric( $masonry_included_category ) ) {
				$masonry_included_categories[] = $masonry_included_category;
			}
		}
		// Remove last comma
		update_post_meta( $postid, '_thsp_masonry_categories_to_include', $masonry_included_categories );
	} else {
		delete_post_meta( $postid, '_thsp_masonry_categories_to_include' );	
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