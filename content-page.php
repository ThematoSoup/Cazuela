<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( 'post', 'lead' ); ?>

	<div class="entry-inner">
		<?php get_template_part( 'post', 'header' ); ?>
	
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<span>Pages:</span>', 'thsp_cazuela' ), 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'thsp_cazuela' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
