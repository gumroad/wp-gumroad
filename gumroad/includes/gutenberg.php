<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Function to load the gutenberg Gumroad widgets
 *
 * @snce 2.1
 *
 */
 function gum_gutenberg_blocks() {
   wp_register_script(
     'gumblocks',
     plugins_url( 'gumroad/scripts/gumblocks.js' ),
     array( 'wp-blocks', 'wp-element' )
   );

   register_block_type( 'gumroad/gumblocks',  array(
     'editor_script' => 'gumblocks'
   ) );

 }

// Register the scripts and blocks now.
gum_gutenberg_blocks();

// add_action( 'init', 'gum_gutenberg_blocks' );
