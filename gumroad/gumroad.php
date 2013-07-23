<?php

/**
 * Gumroad Purchase Page Overlay
 *
 * Display your Gumroad purchase pages in a pretty lightbox overlay.
 *
 * @package   GUM
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @link      http://philderksen.com
 * @copyright 2013 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Gumroad Purchase Page Overlay
 * Plugin URI: http://wordpress.org/plugins/gumroad/
 * Description: Display your Gumroad purchase pages in a pretty lightbox overlay.
 * Version: 1.0.0
 * Author: Phil Derksen
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

require_once( plugin_dir_path( __FILE__ ) . 'class-gumroad.php' );

Gumroad::get_instance();
