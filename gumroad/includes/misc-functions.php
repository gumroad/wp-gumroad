<?php

/**
 * Function to display the Gumroad "overlay" button
 * 
 * @snce 1.0.2
 * 
 */
function gum_overlay_button( $product_id, $text = '', $wanted = '' ) {
	
	return sprintf( '<a href="https://www.gum.co/%s%s" class="gumroad-button">%s</a>', 
						esc_attr( $product_id ),
						( $wanted == 'true' ? '?wanted=true' : '' ),
						$text );
}

/**
 * Function to display the Gumroad "embed" in a page
 * 
 * @snce 1.0.2
 * 
 */
function gum_embed_button( $product_id ) {
	
	return sprintf( '<div class="gumroad-product-embed" data-gumroad-product-id="%s"></div>', esc_attr( $product_id ) );
}
