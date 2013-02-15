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
		 * Prevents adding empty #before-header div
		 */
		if ( has_action( 'thsp_before_footer' ) ) { ?>
		<div id="before-footer" class="clearfix">
			<div class="inner clearfix">
				<?php do_action( 'thsp_before_footer' ); ?>
			</div>
		</div><!-- #before-header -->
		<?php }
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
		<div class="inner clearfix">
			<?php
				/* 
				 * Count widgets in footer widget area
				 * Used to set widget width based on total count
				 */
				$sidebars_widgets_count = wp_get_sidebars_widgets();
				$footer_widgets_classes = isset( $sidebars_widgets_count['footer-widget-area'] ) ? 'clearfix widget-count-' . count( $sidebars_widgets_count['footer-widget-area'] ) : 'clearfix';
			?>
			
			<section id="footer-widget-area" class="<?php echo $footer_widgets_classes; ?>">
				<?php dynamic_sidebar( 'footer-widget-area' ); ?>
			</section><!-- #footer-widgets -->

			<?php
				// Footer menu
				wp_nav_menu( array( 
					'theme_location'	=> 'footer',
					'container'			=> 'nav',
					'container_class'	=> 'footer-navigation'
				) );
			?>
		</div><!-- .inner -->
		<?php endif; ?>

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