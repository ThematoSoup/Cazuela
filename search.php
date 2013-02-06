<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area">
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

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'thsp_cazuela' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php thsp_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php thsp_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

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
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>