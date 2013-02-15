<?php
/**
 * The template for displaying image attachments.
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

get_header();
?>

		<div id="primary" class="content-area image-attachment">
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

				<nav id="image-navigation" class="site-navigation">
					<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'cazuela' ) ); ?></span>
					<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'cazuela' ) ); ?></span>
				</nav><!-- #image-navigation -->

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-inner">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
	
							<div class="entry-meta">
								<?php
									$metadata = wp_get_attachment_metadata();
									printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'cazuela' ),
										esc_attr( get_the_date( 'c' ) ),
										esc_html( get_the_date() ),
										wp_get_attachment_url(),
										$metadata['width'],
										$metadata['height'],
										get_permalink( $post->post_parent ),
										get_the_title( $post->post_parent )
									);
								?>
								<?php edit_post_link( __( 'Edit', 'cazuela' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
	
						<div class="entry-content">
	
							<div class="entry-attachment">
								<div class="attachment">
									<?php
										/**
										 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
										 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
										 */
										$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
										foreach ( $attachments as $k => $attachment ) {
											if ( $attachment->ID == $post->ID )
												break;
										}
										$k++;
										// If there is more than 1 attachment in a gallery
										if ( count( $attachments ) > 1 ) {
											if ( isset( $attachments[ $k ] ) )
												// get the URL of the next image attachment
												$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
											else
												// or get the URL of the first image attachment
												$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
										} else {
											// or, if there's only 1 image, get the URL of the image
											$next_attachment_url = wp_get_attachment_url();
										}
									?>
	
									<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
										$attachment_size = apply_filters( 'thsp_cazuela_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
										echo wp_get_attachment_image( $post->ID, $attachment_size );
									?></a>
								</div><!-- .attachment -->
	
								<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div><!-- .entry-caption -->
								<?php endif; ?>
							</div><!-- .entry-attachment -->
	
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<span>Pages:</span>', 'cazuela' ), 'after' => '</div>' ) ); ?>
	
						</div><!-- .entry-content -->
					</div><!-- .entry-inner -->
					
					<footer class="entry-meta">
						<div class="entry-bookmark">
							<?php
								$bookmark_text = __( 'Bookmark the <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>.', 'cazuela' );
								printf(
									$bookmark_text,
									get_permalink(),
									the_title_attribute( 'echo=0' )
								);
							?>
						</div><!-- .entry-bookmark -->
					
						<?php edit_post_link( __( 'Edit', 'cazuela' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php comments_template(); ?>

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
		</div><!-- #primary .content-area .image-attachment -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>