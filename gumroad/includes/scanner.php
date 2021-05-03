<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Scanner
 *
 * The Scanner scans the post_content for gumroad links and then
 * automatically include gumroad.js if it finds one.
 */
 function gum_post_scanner( $post_object ) {
	 scanner($post_object->post_content);
 }

 /**
  * Function accepts the post_content and scans it for gumroad short links
	*
	* @since 1.2.1
	*
  */
 function scanner( $post_content ) {

 	// counts to see if we find any gumroad product links.
 	if (count(preg_grep('/(gumroad.com\/a\/[[:alnum:]]+\/[[:alnum:]]|gumroad.com\/l\/[[:alnum:]]|gum.co\/[[:alnum:]])/', explode("\n", $post_content))) > 0) {
		gum_load_js('overlay');
 	}
	if (count(preg_grep('/(class=\"gumroad-product-embed\")/', explode("\n", $post_content))) > 0) {
		gum_load_js('embed');
	}
 }

add_action('the_post', 'gum_post_scanner');
