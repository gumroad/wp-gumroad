<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Function to display the Gumroad "overlay" button
 * 
 * @snce 1.1.0
 * 
 */
function gum_overlay_button( $args ) {
	
	$url = 'https://gum.co/' . $args['id'];
	
	return '<a href="' . add_query_arg( array( 'wanted' => $args['wanted'], 'locale' => $args['locale'] ), $url ) . '" class="gumroad-button">' . $args['text'] . '</a>';
}

/**
 * Function to display the Gumroad "embed" in a page
 * 
 * @snce 1.1.0
 * 
 */
function gum_embed_button( $id ) {
	
	return sprintf( '<div class="gumroad-product-embed" data-gumroad-product-id="%s"></div>', esc_attr( $id ) );
}

/**
 * Function to load the correct JS based on the shortcode type
 * This function is only called from the shortcode function so that we know the JS is only being loaded on pages where it is needed
 * 
 * 
 * @since 1.1.0
 */
function gum_load_js( $type ) {
	if( $type == 'embed' ) {
		// Enqueue Gumroad 'embed' JS. Don't set a version.
		wp_enqueue_script( GUM_PLUGIN_SLUG . '-embed-script', 'https://gumroad.com/js/gumroad-embed.js', array(), null, false );
	} else {
		// Enqueue Gumroad 'overlay' JS. Don't set a version.
		wp_enqueue_script( GUM_PLUGIN_SLUG . '-overlay-script', 'https://gumroad.com/js/gumroad.js', array(), null, false );
	}
}

/**
 * Function to return the number of PIB Lite downloads from wordpress.org
 * 
 * @since 1.1.0
 * 
 */
function gum_get_pib_downloads() {
	
	require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
	
	$plugin_info = plugins_api( 'plugin_information', array( 'slug' => 'pinterest-pin-it-button' ) );
	
	return number_format_i18n( $plugin_info->downloaded );
}

/**
 * Function to check if PIB Lite or PIB Pro are active
 * 
 * @since 1.1.0
 * 
 * @return bool
 */
function gum_is_pib_active() {
	if( class_exists( 'Pinterest_Pin_It_Button' ) || class_exists( 'Pinterest_Pin_It_Button_Pro' ) ) 
		return true;
	
	return false;
}
