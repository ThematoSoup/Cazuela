<?php
/**
 * The Template for displaying all single posts.
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

				<?php thsp_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php thsp_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

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

<?php get_sidebar(); ?>
<?php get_footer(); ?>