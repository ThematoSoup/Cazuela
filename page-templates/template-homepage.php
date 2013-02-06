<?php
/**
 * Template Name: Widgetized Homepage
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php do_action( 'thsp_before_content' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

			<?php $thumb_post_class = has_post_thumbnail() ? 'has-thumbnail' : ''; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( $thumb_post_class ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div id="homepage-lead-image">
						<?php the_post_thumbnail( 'lead-image' ); ?>
					</div><!-- .entry-page-image -->
				<?php endif; ?>
					
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; // end of the loop. ?>

			<!-- Homepage widget area  -->
			<?php if ( is_active_sidebar( 'homepage-widget-area' ) ) : ?>
				<?php
					/* 
					 * Count widgets in footer widget area
					 * Used to set widget width based on total count
					 */
					$sidebars_widgets_count = wp_get_sidebars_widgets();
					$homepage_widgets_classes = isset( $sidebars_widgets_count['homepage-widget-area'] ) ? 'clearfix widget-count-' . count( $sidebars_widgets_count['homepage-widget-area'] ) : 'clearfix';
				?>
				
				<section id="homepage-widget-area" class="<?php echo $homepage_widgets_classes; ?>">
					<?php dynamic_sidebar( 'homepage-widget-area' ); ?>
				</section><!-- #footer-widgets -->
			<?php endif; ?>

			<?php do_action( 'thsp_after_content' ); ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>