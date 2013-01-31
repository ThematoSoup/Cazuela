<?php
/**
 * @package Cazuela
 * @since Cazuela 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( 'post', 'header' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
