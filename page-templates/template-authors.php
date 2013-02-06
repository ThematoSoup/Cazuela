<?php
/**
 * Template Name: Authors
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php do_action( 'thsp_before_content' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php get_template_part( 'post', 'lead' ); ?>
				
					<div class="entry-inner">
						<?php get_template_part( 'post', 'header' ); ?>
					
						<div class="entry-content">
							<?php the_content(); ?>
							
							<!-- Authors template code -->
							<ul id="authors-list">
							<?php
								$authors_args = array(
									'orderby'	=> 'display_name'
								);
															
								// Query for users ordered by display name
								$authors_query = new WP_User_Query(
									apply_filters( 'thsp_cazuela_authors_args', $authors_args )
								);
							
								// Get the results from the query
								$authors = $authors_query->get_results();
								foreach ( $authors as $author ) { ?>
							
								<li class="clearfix">
									<div class="author-avatar">
										<?php echo get_avatar( $author->ID, 96 ); ?>
										<ul class="author-links">
										</ul>
									</div><!-- .author-avatar -->
									<div class="author-text">
										<h2><?php echo get_the_author_meta( 'display_name', $author->ID ); ?></h2>
										<div><?php echo get_the_author_meta( 'description', $author->ID ); ?></div>
										
										<!-- Latest posts by author -->
										<?php
											$args = array (
												'posts_per_page'	=> 3,
												'author'			=> $author->ID
											);
											$posts_by_author = new WP_Query( $args );
											if ( $posts_by_author->have_posts() ) : ?>
												<h3><?php _e( 'Latest posts', 'thsp_cazuela' ); ?></h3>
												<ul class="latest-by-author">
													<?php while ( $posts_by_author->have_posts() ) : $posts_by_author->the_post(); ?>
													<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'thsp_cazuela' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
													<?php endwhile; ?>
												</ul><!-- .latest-by-author -->
											<?php
											endif;
											wp_reset_postdata();
										?>
										<!-- End latest posts by author -->											
									</div><!-- .author-text -->
								</li>
								
								<?php }
							?>
							</ul><!-- #authors-list -->
							<!-- End authors template code -->
							
							
							<?php edit_post_link( __( 'Edit', 'thsp_cazuela' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-content -->
					</div><!-- .entry-inner -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php do_action( 'thsp_after_content' ); ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>