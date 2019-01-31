<?php
/**
 * Plugin shortcode functions
 *
 * @package GUM
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Function to process the [gumroad] shortcode
 *
 * @since 1.1.0
 */
function gum_gumroad_shortcode( $attr ) {

	$defaults = array(
					'id'     => '',
					'type'   => 'none', // none, overlay, embed
					'class'  => '',
					'text'   => 'I want this!',
					'wanted' => '',
					'button' => 'false'
				);

	extract( shortcode_atts( $defaults, $attr ) );

	gum_load_js( $type );

	$attr = array_merge( $defaults, $attr );

	if( ! empty( $id ) ) {

		// link behaviour
		if ( $type == 'embed') { // Embed
			$html = gum_embed( $id );
		} else if ( $type == 'overlay' ) { // Overlay
			$html = gum_overlay( $attr );
		} else { // Default
			$html = gum_link( $attr );
		}

		$before_html = '';
		$after_html  = '';

		$before_html = apply_filters( 'gum_shortcode_before', $before_html );
		$html        = apply_filters( 'gum_shortcode_html', $html );
		$after_html  = apply_filters( 'gum_shortcode_after', $after_html );

		return $before_html . $html . $after_html;
	}
}
add_shortcode( 'gumroad', 'gum_gumroad_shortcode' );
