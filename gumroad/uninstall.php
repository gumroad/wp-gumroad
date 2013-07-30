<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @package GUM
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove option records from options table
delete_option( 'gum_settings_general' );

// Remove custom post meta fields
delete_post_meta_by_key( '_gum_enabled' );
