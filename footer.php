<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */
?>

		</div><!-- .inner -->
	</div><!-- #main .site-main -->

	<?php do_action( 'thsp_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner clearfix">
			<?php
				/* 
				 * Count widgets in footer widget area
				 * Used to set widget width based on total count
				 */
				$sidebars_widgets_count = wp_get_sidebars_widgets();
				if( isset( $sidebars_widgets_count['footer-widget-area'] ) ) {
					// If there's more than four, keep them at 25%
					if( count( $sidebars_widgets_count['footer-widget-area'] ) > 4 ) {
						$footer_widgets_classes = 'clearfix widget-count-4-plus';
					} else {
						$footer_widgets_classes = 'clearfix widget-count-' . count( $sidebars_widgets_count['footer-widget-area'] );
					}
				} else {
					$footer_widgets_classes = 'clearfix';
				}
			?>
			
			<section id="footer-widget-area" class="<?php echo $footer_widgets_classes; ?>">
				<?php if ( ! dynamic_sidebar( 'footer-widget-area' ) ) : ?>
			
					<aside id="search" class="widget widget_search">
						<?php get_search_form(); ?>
					</aside>
			
					<aside id="archives" class="widget">
						<h1 class="widget-title"><?php _e( 'Archives', 'cazuela' ); ?></h1>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</aside>
			
				<?php endif; // end sidebar widget area ?>
			</section><!-- #footer-widgets -->
		</div><!-- .inner -->

		<?php do_action( 'thsp_after_footer' ); ?>
	</footer><!-- #colophon .site-footer -->

</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>