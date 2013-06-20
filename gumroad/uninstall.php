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

	// Deletes all post meta data when uninstalled
	$posts = get_posts( 'numberposts=-1&post_type=post&post_status=any' );

	foreach( $posts as $p ) {
		delete_post_meta( $p->ID, '_gum_enabled' );
	}

	// Deletes all page meta data when uninstalled
	$pages = get_posts( 'numberposts=-1&post_type=page&post_status=any' );

	foreach( $pages as $p ) {
		delete_post_meta( $p->ID, '_gum_enabled' );
	}