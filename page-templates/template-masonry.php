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
				// Before Content theme hook callback
				thsp_hook_before_content();
			?>

			<!-- Masonry posts -->
			<?php
				$temp_query = $wp_query;
				
				// Get number of posts per page
				if ( get_post_meta( $post->ID, '_thsp_masonry_posts_per_page', true ) ) {
					$masonry_posts_per_page = get_post_meta( $post->ID, '_thsp_masonry_posts_per_page', true );
				} else {
					$masonry_posts_per_page = get_option( 'posts_per_page' );
				}
				
				$masonry_args = array(
					'posts_per_page' => $masonry_posts_per_page,
					'post_type' => 'post',
					'paged' => $paged
				);
				
				// Get categories and add parameter if custom field is not empty
				if ( get_post_meta( $post->ID, '_thsp_masonry_categories_to_include', true ) ) {
					$masonry_args['category__in'] = get_post_meta( $post->ID, '_thsp_masonry_categories_to_include', true );
				}
				
				$wp_query = new WP_Query( $masonry_args );
				
				if ( $wp_query->have_posts() ) :
			?>

			<div id="masonry-container">
				
				<?php
				while ( $wp_query->have_posts() ) :
				$wp_query->the_post(); ?>

					<div class="masonry-post">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<a class="masonry-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'cazuela' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
								<?php
								// Add post thumbnail, if it exists
								if ( ! is_single() && has_post_thumbnail() ) {
									echo '<div class="entry-lead">';
										the_post_thumbnail( 'masonry-image' );
									echo '</div><!-- .entry-lead -->';
								}
								?>
								
								<div class="entry-inner">
									<header class="entry-header">
										<h1 class="entry-title"><?php the_title(); ?></h1>
									</header><!-- .entry-header -->		
									
									<div class="entry-content">
										<?php the_excerpt(); ?>
									</div><!-- .entry-content -->
								</div><!-- .entry-inner -->
							</a>
						</article><!-- #post-<?php the_ID(); ?> -->
					</div><!-- .masonry-post -->

				<?php endwhile;				
			?>
			</div><!-- #masonry-container -->

			<?php
				endif;
				thsp_content_nav( 'nav-below' );			
				wp_reset_postdata();
				$wp_query = $temp_query;
			?>
			<!-- End Masonry posts -->

			<?php
				// After Content theme hook callback
				thsp_hook_after_content();
			?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>