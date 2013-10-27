<?php
/**
 * Theme hooks and related functions
 *
 * ========
 * Contents
 * ========
 *
 *
 * @package Cazuela
 * @since Cazuela 1.0
 */


function thsp_hook_before_header() {
	/*
	 * Prevents adding empty #before-header div
	 */
	if ( has_action( 'thsp_before_header' ) ) { ?>
	<div id="before-header" class="clearfix">
		<div class="inner clearfix">
			<?php do_action( 'thsp_before_header' ); ?>
		</div>
	</div><!-- #before-header -->
	<?php }
}


function thsp_hook_after_header() {
	/*
	 * Prevents adding empty #after-header div
	 */
	if ( has_action( 'thsp_after_header' ) ) { ?>
	<div id="after-header" class="clearfix">
		<div class="inner clearfix">
			<?php do_action( 'thsp_after_header' ); ?>
		</div>
	</div><!-- #after-header -->
	<?php }
}


function thsp_hook_before_footer() {
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
}


function thsp_hook_after_footer() {
	/*
	 * Prevents adding empty #after-footer div
	 */
	if ( has_action( 'thsp_after_footer' ) ) { ?>
	<div id="after-footer" class="clearfix">
		<div class="inner clearfix">
			<?php do_action( 'thsp_after_footer' ); ?>
		</div>
	</div><!-- #after-footer -->
	<?php }
}


function thsp_hook_before_content() {
	/*
	 * Prevents adding empty #before-content div
	 */
	if ( has_action( 'thsp_before_content' ) ) { ?>
	<div id="before-content" class="clearfix">
		<?php do_action( 'thsp_before_content' ); ?>
	</div><!-- #before-content -->
	<?php }
}

function thsp_hook_after_content() {
	/*
	 * Prevents adding empty #after-content div
	 */
	if ( has_action( 'thsp_after_content' ) ) { ?>
	<div id="after-content" class="clearfix">
		<?php do_action( 'thsp_after_content' ); ?>
	</div><!-- #after-content -->
	<?php }
}


/**
 * Attach widget areas to theme action hooks
 * Makes it possible to disable widget areas in certain pages using remove_action
 * And replace them with custom functionality
 *
 * @uses	add_action			http://codex.wordpress.org/Function_Reference/add_action
 * @uses	dynamic_sidebar		http://codex.wordpress.org/Function_Reference/dynamic_sidebar
 * @uses	is_active_sidebar	http://codex.wordpress.org/Function_Reference/is_active_sidebar
 * @since	Cazuela 1.0
 */
function thsp_before_header_sidebar() {
	/* 
	 * Count widgets in before header widget area
	 * Used to set widget width based on total count
	 * Defined in /inc/extras.php
	 */
	echo '<div class="' . thsp_count_widgets( 'before-header-sidebar' ) . '">';
	dynamic_sidebar( 'before-header-sidebar' );
	echo '</div>';
}
if ( is_active_sidebar( 'before-header-sidebar' ) ) {
	add_action( 'thsp_before_header', 'thsp_before_header_sidebar' );
}

function thsp_after_header_sidebar() {
	/* 
	 * Count widgets in after header widget area
	 * Used to set widget width based on total count
	 * Defined in /inc/extras.php
	 */
	echo '<div class="' . thsp_count_widgets( 'after-header-sidebar' ) . '">';
	dynamic_sidebar( 'after-header-sidebar' );
	echo '</div>';
}
if ( is_active_sidebar( 'after-header-sidebar' ) ) {
	add_action( 'thsp_after_header', 'thsp_after_header_sidebar' );
}

function thsp_attach_before_content_sidebar() {
	dynamic_sidebar( 'before-content-sidebar' );
}
if ( is_active_sidebar( 'before-content-sidebar' ) ) {
	add_action( 'thsp_before_content', 'thsp_attach_before_content_sidebar' );
}

function thsp_attach_after_content_sidebar() {
	dynamic_sidebar( 'after-content-sidebar' );
}
if ( is_active_sidebar( 'after-content-sidebar' ) ) {
	add_action( 'thsp_after_content', 'thsp_attach_after_content_sidebar' );
}

function thsp_attach_before_footer_sidebar() {
	/* 
	 * Count widgets in before footer widget area
	 * Used to set widget width based on total count
	 * Defined in /inc/extras.php
	 */
	echo '<div class="' . thsp_count_widgets( 'before-footer-sidebar' ) . '">';
	dynamic_sidebar( 'before-footer-sidebar' );
	echo '</div>';
}
if ( is_active_sidebar( 'before-footer-sidebar' ) ) {
	add_action( 'thsp_before_footer', 'thsp_attach_before_footer_sidebar' );
}

function thsp_attach_after_footer_sidebar() {
	/* 
	 * Count widgets in after footer widget area
	 * Used to set widget width based on total count
	 * Defined in /inc/extras.php
	 */
	echo '<div class="' . thsp_count_widgets( 'after-footer-sidebar' ) . '">';
	dynamic_sidebar( 'after-footer-sidebar' );
	echo '</div>';
}
if ( is_active_sidebar( 'after-footer-sidebar' ) ) {
	add_action( 'thsp_after_footer', 'thsp_attach_after_footer_sidebar' );
}