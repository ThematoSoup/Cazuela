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

			<?php
				/*
				 * Prevents adding empty #before-content div
				 */
				if ( has_action( 'thsp_before_content' ) ) { ?>
				<div id="before-content" class="clearfix">
					<?php do_action( 'thsp_before_content' ); ?>
				</div><!-- #before-content -->
				<?php }
			?>

			<?php while ( have_posts() ) : the_post(); ?>

			<?php $thumb_post_class = has_post_thumbnail() ? 'has-thumbnail clearfix' : 'clearfix'; ?>
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
					 * Count widgets in homepage widget area
					 * Used to set widget width based on total count
					 * Defined in /inc/extras.php
					 */
					$homepage_widgets_count = thsp_count_widgets( 'homepage-widget-area' );
				?>
				
				<section id="homepage-widget-area" class="<?php echo $homepage_widgets_count; ?>">
					<?php dynamic_sidebar( 'homepage-widget-area' ); ?>
				</section><!-- #footer-widgets -->
			<?php endif; ?>

			<?php
				/*
				 * Prevents adding empty #after-content div
				 */
				if ( has_action( 'thsp_after_content' ) ) { ?>
				<div id="after-content" class="clearfix">
					<?php do_action( 'thsp_after_content' ); ?>
				</div><!-- #after-content -->
				<?php }
			?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>