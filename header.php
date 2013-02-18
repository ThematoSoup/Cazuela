<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<?php
			// Before Header theme hook callback
			thsp_hook_before_header();
		?>

		<div class="inner clearfix">
	
			<hgroup>
				<?php
				// Get current theme options values
				$thsp_theme_options = thsp_cbp_get_options_values();
				if ( '' != $thsp_theme_options['logo_image'] ) {
					$logo_image = thsp_get_logo_image( $thsp_theme_options['logo_image'] ); ?>
					<a class="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo $logo_image[0]; ?>" width="<?php echo $logo_image[1]; ?>" height="<?php echo $logo_image[2]; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
				<?php } else { // if ( ! isset( $thsp_theme_options['logo_image'] ) ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php } ?>
				
				<?php if ( '' != get_bloginfo( 'description' ) ) { ?>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php } ?>
			</hgroup>

			<?php 
			// Header image
			$header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
			<?php endif; ?>
	
			<nav role="navigation" class="site-navigation main-navigation">
				<h1 class="assistive-text"><?php _e( '<span>&#9776;</span> Menu', 'cazuela' ); ?></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'cazuela' ); ?>"><?php _e( 'Skip to content', 'cazuela' ); ?></a></div>
	
				<?php
					wp_nav_menu( array( 
						'theme_location'	=> 'main',
						'container'			=> '',
						'fallback_cb'		=> 'wp_page_menu'
					) );
				?>
			</nav><!-- .site-navigation .main-navigation -->
		</div><!-- .inner -->
	</header><!-- #masthead .site-header -->

	<?php
		// After Header theme hook callback
		thsp_hook_after_header();
	?>

	<div id="main" class="site-main">
		<div class="inner clearfix">