<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses thsp_header_style()
 * @uses thsp_admin_header_style()
 * @uses thsp_admin_header_image()
 *
 * @package Cazuela
 */
function thsp_custom_header_setup() {

	$args = array(
		'default-image'          => '',
		'width'                  => 1000,
		'flex-height'            => true,
		'flex-width'	         => true,
		'wp-head-callback'       => 'thsp_header_style',
		'admin-head-callback'    => 'thsp_admin_header_style',
		'admin-preview-callback' => 'thsp_admin_header_image',
	);

	$args = apply_filters( 'thsp_custom_header_args', $args );

	add_theme_support( 'custom-header', $args );
	
}
add_action( 'after_setup_theme', 'thsp_custom_header_setup' );


/*
 * Styles the header text displayed on the blog.
 *
 * @since Twenty Twelve 1.0
 */
function thsp_header_style() {

	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		#masthead hgroup {
			margin: 0;
		}
	<?php endif; ?>
	</style>
	<?php
	
}


if ( ! function_exists( 'thsp_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see thsp_custom_header_setup().
 *
 * @since Cazuela 1.0
 */
function thsp_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	</style>
<?php
}
endif; // thsp_admin_header_style


if ( ! function_exists( 'thsp_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see thsp_custom_header_setup().
 *
 * @since Cazuela 1.0
 */
function thsp_admin_header_image() { ?>

	<div id="headimg">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
	
<?php }
endif; // thsp_admin_header_image