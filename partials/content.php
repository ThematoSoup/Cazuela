<?php
/**
 * @package Cazuela
 * @since Cazuela 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( !is_search() ) : // No thumbnail in Search results page ?>
		<?php get_template_part( '/partials/post', 'lead' ); ?>
	<?php endif; ?>
	
	<div class="entry-inner">
		<?php get_template_part( '/partials/post', 'header' ); ?>
	
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'cazuela' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cazuela' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
	</div><!-- .entry-inner -->

	<?php get_template_part( '/partials/post', 'footer' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
