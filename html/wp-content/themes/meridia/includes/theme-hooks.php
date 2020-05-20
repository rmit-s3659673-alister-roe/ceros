<?php
/**
 * Theme hooks.
 *
 * @package Meridia
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Head top
 */
function meridia_head_top() {
	do_action( 'meridia_head_top' );
}

/**
 * Head bottom
 */
function meridia_head_bottom() {
	do_action( 'meridia_head_bottom' );
}

/**
 * Header before
 */
function meridia_header_before() {
	do_action( 'meridia_header_before' );
}

/**
 * Header after
 */
function meridia_header_after() {
	do_action( 'meridia_header_after' );
}

/**
 * Body top
 */
function meridia_body_top() {
	do_action( 'meridia_body_top' );
}

/**
 * Body bottom
 */
function meridia_body_bottom() {
	do_action( 'meridia_body_bottom' );
}

/**
 * Primary content top
 */
function meridia_primary_content_top() {
	do_action( 'meridia_primary_content_top' );
}

/**
 * Primary content bottom
 */
function meridia_primary_content_bottom() {
	do_action( 'meridia_primary_content_bottom' );
}


/**
 * Entry content top
 */
function meridia_entry_content_top() {
	do_action( 'meridia_entry_content_top' );
}

/**
 * Entry content bottom
 */
function meridia_entry_content_bottom() {
	do_action( 'meridia_entry_content_bottom' );
}

/**
 * Footer before
 */
function meridia_footer_before() {
	do_action( 'meridia_footer_before' );
}

/**
 * Footer after
 */
function meridia_footer_after() {
	do_action( 'meridia_footer_after' );
}