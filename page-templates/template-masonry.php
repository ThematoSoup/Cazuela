<?php
/**
 * Template Name: Masonry
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

			<!-- Masonry posts -->
			<div id="masonry-container">
			<?php
				$masonry_args = array(
					'posts_per_page' => 48,
					'paged' => $paged
				);
				$masonry_query = new WP_Query( $masonry_args );
				
				if ( $masonry_query->have_posts() ) :
				
				thsp_content_nav( 'nav-above' );
				
				while ( $masonry_query->have_posts() ) :
				$masonry_query->the_post(); ?>

					<div class="masonry-post">
						<?php get_template_part( 'content', 'masonry' ); ?>
					</div><!-- .archive-post -->

				<?php endwhile;
				
				endif;
				
				wp_reset_postdata();
			?>
			</div><!-- #masonry-container -->
			<!-- End Masonry posts -->

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