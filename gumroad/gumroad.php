<?php
/**
 * Gumroad Overlay
 *
 * Display your Gumroad purchase pages in a pretty lightbox.
 *
 * @package		GUM
 * @author		Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license		GPL-2.0+
 * @link		http://philderksen.com
 * @copyright	2013 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Gumroad
 * Plugin URI: http://pinterestplugin.com
 * Description: Add new description here
 * Version: 1.0.0
 * Author: Phil Derksen, Nick Young
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// TODO: replace `class-plugin-name.php` with the name of the actual plugin's class file
require_once( plugin_dir_path( __FILE__ ) . 'class-gumroad.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
// TODO: replace PluginName with the name of the plugin defined in `class-plugin-name.php`
register_activation_hook( __FILE__, array( 'Gumroad', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Gumroad', 'deactivate' ) );

// TODO: replace PluginName with the name of the plugin defined in `class-plugin-name.php`
Gumroad::get_instance();