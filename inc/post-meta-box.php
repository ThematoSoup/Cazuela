<?php


/**
 * Adds post layout meta box to post edit screen
 *
 * @since	Cazuela 1.0
 */
function thsp_layout_meta_box() {

	add_meta_box(
		'thsp-post-layout',
		__( 'Post Options', 'cazuela' ),
		'thsp_post_layout_meta_cb',
		'post',
		'normal',
		'high'
	);

	add_meta_box(
		'thsp-post-layout',
		__( 'Page Options', 'cazuela' ),
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
 * @uses	thsp_get_theme_options()				Defined in /inc/get-options.php
 * @uses	thsp_get_theme_customizer_fields()		Defined in /inc/get-options.php
 * @since	Cazuela 1.0
 */
function thsp_post_layout_meta_cb( $post ) {

	// Get current theme options and all option fields
	$theme_options = thsp_cbp_get_options_values();
	$thsp_theme_options_fields = thsp_cbp_get_fields();

	if( get_post_meta( $post->ID, '_thsp_post_layout', true ) ) {
		$current_layout = get_post_meta( $post->ID, '_thsp_post_layout', true );
	} else {
		$current_layout = $theme_options['default_layout'];
	}

	if( get_post_meta( $post->ID, '_thsp_post_color_scheme', true ) ) {
		$current_color_scheme = get_post_meta( $post->ID, '_thsp_post_color_scheme', true );
	} else {
		$current_color_scheme = $theme_options['color_scheme'];
	}

	wp_nonce_field( 'thsp_save_post_layout', 'thsp_layout_nonce' );
	
	// Layout switcher is not needed in Masonry template
	if ( 'page-templates/template-masonry.php' != get_post_meta( $post->ID, '_wp_page_template', true ) && 'page-templates/template-homepage.php' != get_post_meta( $post->ID, '_wp_page_template', true ) ) { ?>
		<fieldset class="clearfix">
			<h4><?php _e( 'Post/page layout', 'cazuela' ); ?></h4>
			<p><?php _e( 'You can override default layout set in theme settings', 'cazuela' ); ?></p>
			
			<?php
			$layout_options = $thsp_theme_options_fields['thsp_layout_section']['fields']['default_layout']['control_args']['choices'];
			foreach( $layout_options as $layout_option_key => $layout_option_value ) { ?>
		
				<input id="_thsp_post_layout_<?php echo esc_attr( $layout_option_key ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $layout_option_key ); ?>" name="_thsp_post_layout" <?php checked( $layout_option_key, $current_layout ); ?> />
				
				<label for="_thsp_post_layout_<?php echo esc_attr( $layout_option_key ); ?>">
					<img src="<?php echo $layout_option_value['image_src']; ?>" alt="<?php echo $layout_option_value['label']; ?>" width="60" height="40" />
				</label>
				
			<?php } // end foreach ?>
		</fieldset>
		<?php
	} ?>

	<fieldset class="clearfix">
		<h4><?php _e( 'Post/page color scheme', 'cazuela' ); ?></h4>
		<p><?php _e( 'You can override default color scheme set in theme settings', 'cazuela' ); ?></p>
		
		<?php
		$color_scheme_options = $thsp_theme_options_fields['colors']['fields']['color_scheme']['control_args']['choices'];
		foreach( $color_scheme_options as $color_scheme_option_key => $color_scheme_option_value ) { ?>
	
			<input id="_thsp_post_color_scheme_<?php echo esc_attr( $color_scheme_option_key ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $color_scheme_option_key ); ?>" name="_thsp_post_color_scheme" <?php checked( $color_scheme_option_key, $current_color_scheme ); ?> />
			
			<label for="_thsp_post_color_scheme_<?php echo esc_attr( $color_scheme_option_key ); ?>">
				<img src="<?php echo $color_scheme_option_value['image_src']; ?>" alt="<?php echo $color_scheme_option_value['label']; ?>" width="24" height="24" />
			</label>
			
		<?php } // end foreach ?>
	</fieldset>
	
	<?php
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

	<?php } // End fields specific to Masonry template

	// Add fields that are specific to widgetized homepage template
	if ( 'page-templates/template-homepage.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
		
	$homepage_aside_value = get_post_meta( $post->ID, '_thsp_widgetized_homepage_aside', true ) ? get_post_meta( $post->ID, '_thsp_widgetized_homepage_aside', true ) : 'featured_image';
	?>
	
	<fieldset class="clearfix">
		<h4><?php _e( 'Widgetized homepage template settings', 'cazuela' ); ?></h4>
		
		<p class="meta-options">
			<div style="margin-bottom:0.25em"><?php _e( 'Widgetized homepage aside:', 'cazuela' ); ?></div>
						
			<label for="_thsp_widgetized_homepage_aside[featured_image]">
				<input name="_thsp_widgetized_homepage_aside" type="radio" id="_thsp_widgetized_homepage_aside[featured_image]" value="featured_image" <?php checked( $homepage_aside_value, 'featured_image' ); ?> /> 
				<?php _e( 'Featured image', 'cazuela' ); ?>
			</label>
			<br />
			
			<label for="_thsp_widgetized_homepage_aside[slider]">
				<input name="_thsp_widgetized_homepage_aside" type="radio" id="_thsp_widgetized_homepage_aside[slider]" value="slider" <?php checked( $homepage_aside_value, 'slider' ); ?> /> 
				<?php _e( 'Slider (all attachments from this page)', 'cazuela' ); ?>
			</label>
			<br />

			<label for="_thsp_widgetized_homepage_aside[none]">
				<input name="_thsp_widgetized_homepage_aside" type="radio" id="_thsp_widgetized_homepage_aside[none]" value="none" <?php checked( $homepage_aside_value, 'none' ); ?> /> 
				<?php _e( 'None (full-width text)', 'cazuela' ); ?>
			</label>
		</p>

		<p class="meta-options">
			<div style="margin-bottom:0.25em"><?php _e( 'Captions:', 'cazuela' ); ?></div>
						
			<label for="_thsp_widgetized_homepage_captions">
				<input name="_thsp_widgetized_homepage_captions" type="checkbox" id="_thsp_widgetized_homepage_captions" value="1" <?php checked( get_post_meta( $post->ID, '_thsp_widgetized_homepage_captions', true ), 1 ); ?> /> 
				<?php _e( 'Show slider images captions?', 'cazuela' ); ?>
			</label>
			<br />

			<div style="margin-top:1em"><?php _e( 'Captions option is only applied if you select attachments slider for widgetized homepage aside. You can set title and description for each image in Media Library.', 'cazuela' ); ?></div>
		</p>
	</fieldset>

	<?php } // End fields specific to widgetized homepage template
	
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

	// Color scheme field
	if ( isset( $_POST['_thsp_post_color_scheme'] ) ) {
		// Update the post layout meta field if it's not the same as theme setting
		if ( $_POST['_thsp_post_color_scheme'] != $theme_options['color_scheme'] ) {
			update_post_meta( $postid, '_thsp_post_color_scheme', esc_attr( strip_tags( $_POST['_thsp_post_color_scheme'] ) ) );
		// If meta field is the same as theme setting, delete meta field 
		} else {
			delete_post_meta( $postid, '_thsp_post_color_scheme' );
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

	// Aside value for Widgetized Homepage template
	if ( isset( $_POST['_thsp_widgetized_homepage_aside'] ) && in_array( $_POST['_thsp_widgetized_homepage_aside'], array( 'featured_image', 'slider', 'none' ) ) ) {
		update_post_meta( $postid, '_thsp_widgetized_homepage_aside', $_POST['_thsp_widgetized_homepage_aside'] );	
	}	

	// Captions value for Widgetized Homepage template
	if ( isset( $_POST['_thsp_widgetized_homepage_captions'] ) && 1 == $_POST['_thsp_widgetized_homepage_captions'] ) {
		update_post_meta( $postid, '_thsp_widgetized_homepage_captions', 1 );	
	} else {
		delete_post_meta( $postid, '_thsp_widgetized_homepage_captions', 1 );	
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


/**
 * Admin notices related to meta box issues
 *
 * @since	Cazuela 1.0
 */
function thsp_meta_box_admin_notice() {
	global $pagenow;
	global $post;
	
	if ( 'post.php' == $pagenow && 'page-templates/template-homepage.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
		/**
		 * If slider was selected as widgetized homepage aside, 
		 * check if there are any attachments
		 */
		if( 'slider' == get_post_meta( $post->ID, '_thsp_widgetized_homepage_aside', true ) ) {
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => 1,
				'post_status' =>'any',
				'post_parent' => $post->ID
			); 
			$attachments = get_posts($args);
			if ( ! $attachments ) { ?>
				<div class="error">
					<p><?php _e( 'You chose attachments slider as aside for this page, please make sure the page has some attachments.', 'cazuela' ); ?></p>
				</div>
			<?php }			
		} 

		/**
		 * If slider was selected as widgetized homepage aside, 
		 * check if there are any attachments
		 */
		if( 'featured_image' == get_post_meta( $post->ID, '_thsp_widgetized_homepage_aside', true ) ) {
			if ( ! has_post_thumbnail( $post->ID ) ) { ?>
				<div class="error">
					<p><?php _e( 'You chose featured image as aside for this page, please make sure featured image is set.', 'cazuela' ); ?></p>
				</div>
			<?php }			
		} 
	}
}
add_action( 'admin_notices', 'thsp_meta_box_admin_notice' );
