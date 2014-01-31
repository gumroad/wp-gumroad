<?php
/**
 * Plugin shortcode functions
 *
 * @package GUM
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;


/**
 * Function to process the [gumroad] shortcode
 * 
 * @since 1.1.0
 */
function gum_gumroad_shortcode( $attr ) {
	
	extract( shortcode_atts( array(
					'type' => 'overlay',
					'product_id' => '',
					'text' => '',
					'wanted' => 'false'
				), $attr ) );
	
	gum_load_js( $type );
	
	if( ! empty( $product_id ) ) {
		if( $type == 'embed' ) {
			return gum_embed_button( $product_id );
		} else {
			return gum_overlay_button( $product_id, $text, $wanted );
		}
	}
}
add_shortcode( 'gumroad', 'gum_gumroad_shortcode' );

