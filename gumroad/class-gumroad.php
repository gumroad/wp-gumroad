<?php

/**
 * Main Gumroad class
 *
 * @package GUM
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

class Gumroad {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = '1.0.1';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'gumroad';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		
		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		
		// Include required files.
		add_action( 'init', array( $this, 'includes' ), 1 );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ), 2 );

		// Enqueue admin styles and scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );

		// Add admin notice after plugin activation. Also check if should be hidden.
		add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );

		// Add plugin listing "Settings" action link.
		add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_slug . '.php' ), array( $this, 'settings_link' ) );
		
		// Set our plugin constants
		add_action( 'init', array( $this, 'setup_constants' ) );
	}
	
	/**
	 * Setup any plugin constants we need 
	 *
	 * @since    1.0.2
	 */
	public function setup_constants() {
		define( 'GUM_PLUGIN_SLUG', $this->plugin_slug );
	}
	
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.2
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), 'gum' );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );

	}
	
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.1
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		// Add value to indicate that we should show admin install notice.
		update_option( 'gum_show_admin_install_notice', 1 );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		$this->plugin_screen_hook_suffix = add_options_page(
			$this->get_plugin_title() . __( ' Help', 'gum' ),
			__( 'Gumroad', 'gum' ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}
	
	/**
	 * Include required files (admin and frontend).
	 *
	 * @since     1.0.1
	 */
	public function includes() {
		
		// Include any necessary functions
		include_once( 'includes/misc-functions.php' );
		
		// Include shortcode functions
		include_once( 'includes/shortcodes.php' );
	}

	/**
	 * Return localized base plugin title.
	 *
	 * @since     1.0.1
	 *
	 * @return    string
	 */
	public static function get_plugin_title() {
		return __( 'Gumroad Purchase Page Overlay', 'gum' );
	}

	/**
	 * Enqueue admin-specific style sheets for this plugin's admin pages only.
	 *
	 * @since     1.0.1
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( $this->viewing_this_plugin() ) {
			// Plugin admin custom Bootstrap CSS. Tack on plugin version.
			wp_enqueue_style( $this->plugin_slug .'-bootstrap', plugins_url( 'css/bootstrap-custom.css', __FILE__ ), array(), $this->version );

			// Plugin admin custom Flat UI CSS. Tack on plugin version.
			wp_enqueue_style( $this->plugin_slug .'-flat-ui', plugins_url( 'css/flat-ui-custom.css', __FILE__ ), array( $this->plugin_slug .'-bootstrap' ), $this->version );

			// Plugin admin CSS. Tack on plugin version.
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array( $this->plugin_slug .'-flat-ui' ), $this->version );
		}
	}

	/**
	 * Add Settings action link to left of existing action links on plugin listing page.
	 *
	 * @since   1.0.1
	 *
	 * @param   array  $links  Default plugin action links
	 * @return  array  $links  Amended plugin action links
	 */
	public function settings_link( $links ) {

		$setting_link = sprintf( '<a href="%s">%s</a>', add_query_arg( 'page', $this->plugin_slug, admin_url( 'options-general.php' ) ), __( 'Settings', 'gum' ) );
		array_unshift( $links, $setting_link );

		return $links;
	}

	/**
	 * Check if viewing this plugin's admin page.
	 *
	 * @since   1.0.1
	 *
	 * @return  bool
	 */
	private function viewing_this_plugin() {
		if ( ! isset( $this->plugin_screen_hook_suffix ) )
			return false;

		$screen = get_current_screen();

		if ( $screen->id == $this->plugin_screen_hook_suffix )
			return true;
		else
			return false;
	}

	/**
	 * Show notice after plugin install/activate in admin dashboard.
	 * Hide after first viewing.
	 *
	 * @since   1.0.1
	 */
	public function admin_install_notice() {
		// Exit all of this is stored value is false/0 or not set.
		if ( false == get_option( 'gum_show_admin_install_notice' ) )
			return;

		// At this point show install notice.
		include_once( 'views/admin-install-notice.php' );

		// Delete stored value to hide since we only want them to view it once.
		delete_option( 'gum_show_admin_install_notice' );
		return;
	}
}
