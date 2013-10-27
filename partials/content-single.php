<?php
/**
 * @package Cazuela
 * @since Cazuela 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( '/partials/post', 'lead' ); ?>

	<div class="entry-inner">
		<?php get_template_part( '/partials/post', 'header' ); ?>
	
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<span>Pages:</span>', 'cazuela' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	</div><!-- .entry-inner -->

	<?php get_template_part( '/partials/post', 'footer' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->



