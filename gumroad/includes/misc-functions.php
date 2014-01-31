<?php

/**
 * Function to display the Gumroad "overlay" button
 * 
 * @snce 1.1.0
 * 
 */
function gum_overlay_button( $product_id, $text = '', $wanted = '' ) {
	
	return sprintf( '<a href="https://gumroad.com/l/%s%s" class="gumroad-button">%s</a>', 
						esc_attr( $product_id ),
						( $wanted == 'true' ? '?wanted=true' : '' ),
						$text );
}

/**
 * Function to display the Gumroad "embed" in a page
 * 
 * @snce 1.1.0
 * 
 */
function gum_embed_button( $product_id ) {
	
	return sprintf( '<div class="gumroad-product-embed" data-gumroad-product-id="%s"></div>', esc_attr( $product_id ) );
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
