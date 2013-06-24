<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   GUM
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

//Remove custom post meta fields
$posts = get_posts( array( 'numberposts' => -1 ) );

foreach( $posts as $post ) {
	delete_post_meta( $post->ID, '_gum_enabled' );
}
