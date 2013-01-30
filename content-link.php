<?php
/**
 * @package Cazuela
 * @since Cazuela 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( has_post_thumbnail() ) {
			echo '<div class="hentry-lead">';
				the_post_thumbnail( 'lead-image' );
			echo '</div><!-- .hentry-lead -->';
		}
	?>
	
	<div class="hentry-inner">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'thsp_cazuela' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'thsp_cazuela' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</div><!-- .hentry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
