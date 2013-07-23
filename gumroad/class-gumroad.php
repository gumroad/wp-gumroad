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
		// Initialize the settings. This needs to have priority over adding the admin page or the admin page will come up blank.
		add_action( 'admin_init', array( $this, 'initialize_settings' ), 1 );
		
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ), 2 );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add Post Meta stuff.
		add_action( 'add_meta_boxes', array( $this, 'call_meta_boxes') );
		add_action( 'save_post', array( $this, 'save_meta_data') );

		// Add plugin listing "Settings" action link.
		add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_slug . '.php' ), array( $this, 'settings_link' ) );
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
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		global $post;
		
		$gum_meta = get_post_meta( $post->ID, '_gum_enabled', true );
		$gum_option = get_option( 'gum_settings_general' );
		$gum_option = $gum_option['show_on'];
		$load_script = 0;
		
		if ( ! ( $gum_option['blog_home_page'] ) && is_home() )
			return;
		else if ( $gum_option['blog_home_page'] && is_home() )
			$load_script = 1;

		if ( ! ( $gum_option['archives'] ) && is_archive() )
			return;
		else if ( $gum_option['archives'] && is_archive() )
			$load_script = 1;
		
		if ( $gum_meta )
			$load_script = 1;
		
		if ( $load_script )
			// Enqueue Gumroad JS plugin boilerplate style. Don't set a version.
			wp_enqueue_script( $this->plugin_slug . '-overlay-script', 'https://gumroad.com/js/gumroad.js', array(), null, true );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Gumroad Purchase Page Overlay Settings', $this->plugin_slug ),
			__( 'Gumroad', $this->plugin_slug ),
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
	 * Initialize settings.
	 *
	 * @since    1.0.0
	 */
	public function initialize_settings() {
		// Load global options
		global $gum_options;
		
		// Include the file to register all of the plugin settings
		include_once( 'views/register-settings.php' );
		
		// Load global options settings
		$gum_options = gum_get_settings();
	}

	/*
	 * Add the post meta boxes and callback function to print the HTML
	 * Reference: http://www.wproots.com/complex-meta-boxes-in-wordpress/
	 * 
	 * @since    1.0.0
	 */
	public function call_meta_boxes() {
		global $post;

		//Loop through to make sure custom post types are enabled
		$post_type = $post->post_type;
		
		add_meta_box('gum-meta', 'Gumroad', 'display_meta_box', $post_type, 'side', 'core');

		function display_meta_box( $post ) {
			$gum_meta = get_post_meta( $post->ID, '_gum_enabled', true );

			wp_nonce_field( basename( __FILE__ ), 'gum_enabled_nonce' );
			?>
			<p>
				<input type="checkbox" name="gum_enabled" <?php checked( $gum_meta, 'on', 1 ); ?> />
				<label for="gum_enabled"><?php echo __( 'Enable Gumroad overlay on this individual post/page URL.', 'gum' ); ?></label>
			</p>
			<?php
		}
	}

	/*
	 * Save the post meta
	 * 
	 * @since    1.0.0
	 */
	public function save_meta_data( $post_id ) {

		if ( ! isset( $_POST['gum_enabled_nonce'] ) || ! wp_verify_nonce ( $_POST['gum_enabled_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		
		if ( isset( $_POST['gum_enabled'] ) ) {
			update_post_meta( $post_id, '_gum_enabled', $_POST['gum_enabled'] );
		} else {
			delete_post_meta( $post_id, '_gum_enabled' );
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
}
