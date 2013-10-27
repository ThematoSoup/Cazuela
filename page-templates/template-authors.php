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

			<?php
				// Before Content theme hook callback
				thsp_hook_before_content();
			?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php get_template_part( '/partials/post', 'lead' ); ?>
				
					<div class="entry-inner">
						<?php get_template_part( '/partials/post', 'header' ); ?>
					
						<div class="entry-content">
							<?php the_content(); ?>
							
							<!-- Authors template code -->
							<?php
								$orderby_value = get_post_meta( $post->ID, '_thsp_authors_query_orderby', true ) ? get_post_meta( $post->ID, '_thsp_authors_query_orderby', true ) : 'display_name';
								$order_value = get_post_meta( $post->ID, '_thsp_authors_query_order', true ) ? get_post_meta( $post->ID, '_thsp_authors_query_order', true ) : 'ASC';
							?>
							
							<ul class="authors-list">
							<?php
								if ( get_post_meta( $post->ID, '_thsp_authors_roles_to_include', true ) ) {
									// Initiate the array
									$displayed_authors = array();
									foreach ( get_post_meta( $post->ID, '_thsp_authors_roles_to_include', true ) as $included_role ) {
										// User query
										$authors_query = new WP_User_Query( array(
											'orderby'	=> $orderby_value,
											'order'		=> $order_value,
											'role'		=> $included_role
										) );
									
										// Get the results from the query
										$role_authors = $authors_query->get_results();
										
										// Add authors from this role to all displayed authors array
										$displayed_authors = array_merge( $displayed_authors, $role_authors );
									}
								} else {
									// User query
									$authors_query = new WP_User_Query( array(
										'orderby'	=> $orderby_value,
										'order'		=> $order_value,
									) );
								
									// Get the results from the query
									$displayed_authors = $authors_query->get_results();
								}
															
								// Display authors
								foreach ( $displayed_authors as $displayed_author ) {
									// Template tag, defined in /inc/template-tags.php
									thsp_display_an_author( $displayed_author );
								}
							?>
							</ul><!-- #authors-list -->
							<!-- End authors template code -->
							
							
							<?php edit_post_link( __( 'Edit', 'cazuela' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-content -->
					</div><!-- .entry-inner -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php
				// After Content theme hook callback
				thsp_hook_after_content();
			?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>