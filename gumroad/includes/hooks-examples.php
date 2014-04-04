<?php

/*************************
 * FILTER HOOKS
 ************************/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 * 
 * @since 
 */
function test_gum_shortcode_before( $before_html ) {
	return '<p>Before Gumroad</p>';
}
add_filter( 'gum_shortcode_before', 'test_gum_shortcode_before' );


/**
 * 
 * 
 * @since 
 */
function test_gum_shortcode_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'gum_shortcode_html', 'test_gum_shortcode_html' );


/**
 * 
 * 
 * @since 
 */
function test_gum_shortcode_after( $after_html ) {
	return '<p>After Gumroad</p>';
}
add_filter( 'gum_shortcode_after', 'test_gum_shortcode_after' );

