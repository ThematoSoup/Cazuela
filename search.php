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
				// Before Content theme hook callback
				thsp_hook_before_content();
			?>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'cazuela' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php thsp_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( '/partials/content', 'search' ); ?>

				<?php endwhile; ?>

				<?php thsp_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( '/partials/no-results', 'search' ); ?>

			<?php endif; ?>

			<?php
				// After Content theme hook callback
				thsp_hook_after_content();
			?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>