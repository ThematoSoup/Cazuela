<?php
/**
 * Template Name: Widgetized Homepage
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

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<?php 
				// Check if featured image or slider needs to be shown
				if ( has_post_thumbnail() && 'featured_image' == get_post_meta( $post->ID, '_thsp_widgetized_homepage_aside', true ) ) { ?>
					<div id="homepage-aside">
						<?php the_post_thumbnail( 'lead-image' ); ?>
					</div><!-- #homepage-aside -->
				<?php } // end Featured Image check
				elseif( 'slider' == get_post_meta( $post->ID, '_thsp_widgetized_homepage_aside', true ) ) {
					$args = array(
						'post_type' => 'attachment',
						'numberposts' => -1,
						'post_status' =>'any',
						'post_parent' => $post->ID
					); 
					$attachments = get_posts( $args );
					if ( $attachments ) { ?>
						<div id="homepage-aside">
							<div class="flexslider">
								<ul class="slides">
								<?php foreach( $attachments as $attachment ) {
									$attachment_image_src = wp_get_attachment_image( $attachment->ID, 'lead-image' ); ?>
									<li>
										<?php echo $attachment_image_src; ?>
										<?php // See if captions need to be shown
										if ( get_post_meta( $post->ID, '_thsp_widgetized_homepage_captions', true ) ) { ?>
										<div class="slide-caption">
											<h3><?php echo $attachment->post_title; ?></h3>
											<?php if ( '' != $attachment->post_content ) { ?>
												<div><?php echo $attachment->post_content; ?></div>
											<?php } ?>
										</div><!-- .slide-caption -->
										<?php } // end if ?>
									</li>
								<?php } // end foreach ?>
								</ul><!-- .slides -->
							</div><!-- .flexslider -->
						</div><!-- #homepage-aside -->
					<?php } // end if			
				} // end Slider check
				?>
					
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; // end of the loop. ?>

			<!-- Homepage widget area  -->
			<?php if ( is_active_sidebar( 'homepage-widget-area' ) ) : ?>
				<section id="homepage-widget-area" class="<?php echo thsp_count_widgets( 'homepage-widget-area' ); ?>">
					<?php dynamic_sidebar( 'homepage-widget-area' ); ?>
				</section><!-- #footer-widgets -->
			<?php endif; ?>

			<?php
				// After Content theme hook callback
				thsp_hook_after_content();
			?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>