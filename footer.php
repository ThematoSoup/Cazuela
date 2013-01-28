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
			<?php if( thsp_count_footer_sidebars() > 0 ) { ?>
			<section id="footer-sidebars" class="clearfix active-<?php echo thsp_count_footer_sidebars(); ?>">
				<?php foreach( thsp_get_footer_sidebars() as $name => $id ) { ?>
					<?php if ( is_active_sidebar( $id ) ) { ?>
						<div id="<?php echo $id; ?>" class="footer-sidebar">
							<?php dynamic_sidebar( $id ); ?>
						</div>
					<?php } ?>
				<?php } ?>
			</section><!-- #footer-widgets -->
			<?php } ?>
		</div><!-- .inner -->

		<?php do_action( 'thsp_after_footer' ); ?>
	</footer><!-- #colophon .site-footer -->

</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>