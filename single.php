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
				// Before Content theme hook callback
				thsp_hook_before_content();
			?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php thsp_content_nav( 'nav-above' ); ?>

				<?php get_template_part( '/partials/content', 'single' ); ?>

				<?php thsp_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			<?php
				// After Content theme hook callback
				thsp_hook_after_content();
			?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>