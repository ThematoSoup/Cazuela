<?php
	// Add post thumbnail, if it exists
	if ( ! is_single() && has_post_thumbnail() ) {
		echo '<div class="entry-lead">';
			echo '<a href="' . get_permalink() . '">';
			the_post_thumbnail( 'lead-image' );
			echo '</a>';
		echo '</div><!-- .entry-lead -->';
	}
?>

<header class="entry-header">
	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'thsp_cazuela' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

	<?php if ( 'post' == get_post_type() ) : ?>
	<div class="entry-meta">
		<?php thsp_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php endif; ?>
</header><!-- .entry-header -->