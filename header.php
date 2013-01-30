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
		<?php do_action( 'thsp_before_header' ); ?>

		<div class="inner clearfix">
	
			<hgroup>
				<?php $header_image = get_header_image();
				if ( ! empty( $header_image ) ) { ?>
					<a class="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
				<?php } else { // if ( ! empty( $header_image ) ) ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php } ?>
				
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
	
			<nav role="navigation" class="site-navigation main-navigation">
				<h1 class="assistive-text"><?php _e( 'Menu', 'thsp_cazuela' ); ?></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'thsp_cazuela' ); ?>"><?php _e( 'Skip to content', 'thsp_cazuela' ); ?></a></div>
	
				<?php
					wp_nav_menu( array( 
						'theme_location' => 'primary',
						'container' => ''
					) );
				?>
			</nav><!-- .site-navigation .main-navigation -->
		</div><!-- .inner -->
	</header><!-- #masthead .site-header -->

	<?php do_action( 'thsp_after_header' ); ?>

	<div id="main" class="site-main">
		<div class="inner clearfix">