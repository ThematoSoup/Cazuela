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
		/*
		 * Prevents adding empty #before-footer div
		 */
		if ( has_action( 'thsp_before_footer' ) ) { ?>
		<div id="before-footer" class="clearfix">
			<div class="inner clearfix">
				<?php do_action( 'thsp_before_footer' ); ?>
			</div>
		</div><!-- #before-footer -->
		<?php }
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
		<div class="inner clearfix">
			<?php
				/* 
				 * Count widgets in footer widget area
				 * Used to set widget width based on total count
				 * Defined in /inc/extras.php
				 */
				$footer_widgets_count = thsp_count_widgets( 'footer-widget-area' );
			?>
			
			<section id="footer-widget-area" class="<?php echo $footer_widgets_count; ?>">
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
					'container_class'	=> 'footer-navigation'
				) );
			?>
			
			<div id="footer-credits">
				<a href="<?php echo esc_url( __( 'http://demo.thematosoup.com/cazuela/', 'cazuela' ) ); ?>" title="<?php esc_attr_e( 'Cazuela &mdash; free, responsive WordPress theme', 'cazuela' ); ?>"><?php echo __( 'Cazuela theme', 'cazuela' ); ?></a> powered by <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'cazuela' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'cazuela' ); ?>"><?php _e( 'WordPress', 'cazuela' ); ?></a>
			</div><!-- #footer-credits -->
		</div><!-- #footer-nav -->

		<?php
			/*
			 * Prevents adding empty #before-header div
			 */
			if ( has_action( 'thsp_after_footer' ) ) { ?>
			<div id="after-footer" class="clearfix">
				<div class="inner clearfix">
					<?php do_action( 'thsp_after_footer' ); ?>
				</div>
			</div><!-- #before-header -->
			<?php }
		?>
	</footer><!-- #colophon .site-footer -->

</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>