<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

$thsp_current_layout = thsp_get_current_layout();

/*
 * Check if primary sidebar is required
 * The only layout that doesn't need primary sidebar is 'layout-c' (Content only)
 */
if( $thsp_current_layout['default_layout'] != 'layout-c' ) { ?>
<div id="secondary" class="widget-area" role="complementary">
	<?php if ( ! dynamic_sidebar( 'primary-sidebar' ) ) : ?>

		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>

		<aside id="archives" class="widget">
			<h1 class="widget-title"><?php _e( 'Archives', 'cazuela' ); ?></h1>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

	<?php endif; // end sidebar widget area ?>
</div><!-- #secondary .widget-area -->
<?php } ?>

<?php
/*
 * Check if currently set layout requires secondary sidebar
 */
$secondary_sidebar_layouts = array(	'layout-cps', 'layout-pcs', 'layout-psc' );
if( in_array( $thsp_current_layout['default_layout'], $secondary_sidebar_layouts ) ) { ?>
<div id="tertiary" class="widget-area" role="complementary">
	<?php if ( ! dynamic_sidebar( 'secondary-sidebar' ) ) : ?>

		<aside id="meta" class="widget">
			<h1 class="widget-title"><?php _e( 'Meta', 'cazuela' ); ?></h1>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>

	<?php endif; // end sidebar widget area ?>
</div><!-- #tertiary .widget-area -->
<?php }