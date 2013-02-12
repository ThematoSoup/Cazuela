<?php
/**
 * Template part for displaying post lead image in archives.
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */

// Add post thumbnail, if it exists
if ( ! is_single() && has_post_thumbnail() ) {
	echo '<div class="entry-lead">';
		echo '<a href="' . get_permalink() . '">';
		the_post_thumbnail( 'lead-image' );
		echo '</a>';
	echo '</div><!-- .entry-lead -->';
}