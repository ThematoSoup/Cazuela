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

	<?php
		// Before Footer theme hook callback
		thsp_hook_before_footer();
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
		<div class="inner clearfix">
			<section id="footer-widget-area" class="<?php echo thsp_count_widgets( 'footer-widget-area' ); ?>">
				<?php dynamic_sidebar( 'footer-widget-area' ); ?>
			</section><!-- #footer-widgets -->
		</div><!-- .inner -->
		<?php endif; ?>

		<div id="footer-nav" class="inner clearfix">
			<?php
				// Footer menu
				wp_nav_menu( array( 
					'theme_location'	=> 'footer',
					'container'			=> 'nav',
					'container_class'	=> 'footer-navigation',
					'fallback_cb'		=> ''
				) );
			?>
			
			<div id="footer-credits">
				<a href="<?php echo esc_url( __( 'http://thematosoup.com/themes/cazuela/', 'cazuela' ) ); ?>" title="<?php esc_attr_e( 'Cazuela &mdash; free, responsive WordPress theme', 'cazuela' ); ?>" rel="nofollow"><?php echo __( 'Cazuela theme', 'cazuela' ); ?></a> powered by <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'cazuela' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'cazuela' ); ?>"><?php _e( 'WordPress', 'cazuela' ); ?></a>
			</div><!-- #footer-credits -->
		</div><!-- #footer-nav -->

		<?php
			// Before Footer theme hook callback
			thsp_hook_after_footer();
		?>
	</footer><!-- #colophon .site-footer -->

</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>