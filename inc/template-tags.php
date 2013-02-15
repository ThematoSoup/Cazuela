<?php
/**
 * Custom template tags for Cazuela theme.
 *
 * ========
 * Contents
 * ========
 *
 * - Content navigation
 * - Comment callback
 * - Posted on
 * - Display an author in Authors page template
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

if ( ! function_exists( 'thsp_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Cazuela 1.0
 */
function thsp_content_nav( $nav_id ) {

	global $wp_query, $post;

	// Get current theme options
	$theme_options = thsp_cbp_get_options_values();
	
	// Check if navigation needs to be shown, based on theme options
	if ( ( 'nav-above' == $nav_id && $theme_options['post_navigation_above'] ) || ( 'nav-below' == $nav_id && $theme_options['post_navigation_below'] ) ) {

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'cazuela' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'cazuela' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'cazuela' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php
		// Add WP Pagenavi support
		if ( function_exists( 'wp_pagenavi' ) ) {
			wp_pagenavi();
		} else {
		?>
			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cazuela' ) ); ?></div>
			<?php endif; ?>
	
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cazuela' ) ); ?></div>
			<?php endif; ?>
		<?php } // end WP Pagenavi check ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
	
	} // End check if navigation needs to be shown
	
}
endif; // thsp_content_nav


if ( ! function_exists( 'thsp_comment_cb' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Cazuela 1.0
 */
function thsp_comment_cb( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'cazuela' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'cazuela' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<?php echo get_avatar( $comment, 64 ); ?>
		
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			
			<header>
				<?php printf( __( '%s <span class="says">says:</span>', 'cazuela' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</header>
			
			<div class="comment-content"><?php comment_text(); ?></div>

			<footer>
				<div class="comment-author vcard">
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'cazuela' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'cazuela' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'cazuela' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for thsp_comment_cb()


/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Cazuela 1.0
 */
if ( ! function_exists( 'thsp_posted_on' ) ) :
function thsp_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'cazuela' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'cazuela' ), get_the_author() ) ),
		get_the_author()
	);
}
endif; // ends check for thsp_posted_on()


/**
 * Template tag that displays an author in Authors page template
 *
 * @param	$author			Author object
 * @since 	Cazuela 1.0
 */
function thsp_display_an_author( $author ) { ?>
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
					<h3><?php _e( 'Latest posts', 'cazuela' ); ?></h3>
					<ul class="latest-by-author">
						<?php while ( $posts_by_author->have_posts() ) : $posts_by_author->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'cazuela' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
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