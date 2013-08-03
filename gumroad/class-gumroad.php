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
		// Include required files.
		$this->includes();

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ), 2 );

		// Enqueue admin styles and scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add admin notice after plugin activation. Also check if should be hidden.
		add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );

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
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		global $post;
		global $gum_options;
		
		$gum_meta = get_post_meta( $post->ID, '_gum_enabled', true );
		$load_script = 0;
		
		if( isset( $gum_options['show_on'] ) ) 
			$show_on = $gum_options['show_on'];
		
		if ( empty( $show_on['blog_home_page'] ) && is_home() )
			return;
		else if ( ! empty( $show_on['blog_home_page'] ) && is_home() )
			$load_script = 1;

		if ( empty( $show_on['archives'] ) && is_archive() )
			return;
		else if ( ! empty( $show_on['archives'] ) && is_archive() )
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
			$this->get_plugin_title() . __( ' Settings', 'gum' ),
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
	private function includes() {
		// Load global options.
		global $gum_options;

		// Include the file to register all of the plugin settings.
		include_once( 'includes/register-settings.php' );

		// Load global options settings.
		$gum_options = gum_get_settings();
		
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

		return $post_id;
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
