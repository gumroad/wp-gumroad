<?php

/**
 * Official Gumroad Wordpress Plugin
 *
 * @package   GUM
 * @author    Karl Oscar Weber <me@kow.fm>, Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>, Gumroad <hi@gumroad.com>
 * @license   GPL-2.0+
 * @link      https://gumroad.com
 * @copyright 2013-2018 Gumroad
 *
 * @wordpress-plugin
 * Plugin Name: Gumroad
 * Plugin URI: https://gumroad.com
 * Description: Make your Gumroad products available for purchase right within WordPress.
 * Version: 3.1.0
 * Author: Gumroad
 * Author URI: http://gumroad.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/gumroad/WP-Gumroad
 * Text Domain: gum
 * Domain Path: /languages/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'GUM_MAIN_FILE' ) ) {
	define( 'GUM_MAIN_FILE', __FILE__ );
}

require_once( plugin_dir_path( __FILE__ ) . 'class-gumroad.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, array( 'Gumroad', 'activate' ) );

Gumroad::get_instance();
