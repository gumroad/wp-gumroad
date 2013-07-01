<?php
/**
 * Main Gumroad class
 *
 * @package		GUM
 * @author		Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */
class Gumroad {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = '1.0.0';

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

		// TODO Load plugin text domain -- Translation not implemented for initial release.
		// TODO add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		// TODO Add file /lang/gumroad.pot, uncomment load_plugin_textdomain below.
		
		// Initialize the settings. This needs to have priority over adding the admin page or the admin page will come up blank.
		add_action( 'admin_init', array( $this, 'initialize_settings' ), 1 );
		
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ), 2 );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add Post Meta stuff
		add_action( 'add_meta_boxes', array( $this, 'call_meta_boxes') );
		add_action( 'save_post', array( $this, 'save_meta_data') );

		// Add plugin listing "Settings" and other action links
		add_filter( 'plugin_action_links', array( $this, 'add_action_link' ), 10, 2 );

		// Define custom functionality. Read more about actions and filters: http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		// TODO add_action( 'TODO', array( $this, 'action_method_name' ) );
		// TODO add_filter( 'TODO', array( $this, 'filter_method_name' ) );
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
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		// TODO: Define activation functionality here
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		// TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 * // TODO Translation not implemented for initial release
	 *
	 * @since    1.0.0
	 */
	/*
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}
	*/

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
		
		if( $gum_option['blog_home_page'] && is_home() ) 
			$load_script = 1;

		if( $gum_option['archives'] && is_archive() )
			$load_script = 1;
		
		if( $gum_meta )
			$load_script = 1;
		
		if( $load_script )
			wp_enqueue_script( $this->plugin_slug . 'gumroad-script', 'https://gumroad.com/js/gumroad.js', '', $this->version, true );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Gumroad Overlay Settings', $this->plugin_slug ),
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

	// TODO Nick please fix. I F'ed this up.
	
	/* 
	 * Add the post meta boxes and callback function to print the HTML
	 * Reference: http://www.wproots.com/complex-meta-boxes-in-wordpress/
	 * 
	 * @since    1.0.0
	 */
	public function call_meta_boxes() {
		// TODO Loop through to make sure custom post types are enabled
		global $post;
		
		$post_type = $post->post_type;
		
		
		add_meta_box('gum-meta', 'Gumroad', 'display_meta_box', $post_type, 'side', 'core');

		// TODO: Old/remove: Add the meta boxes for both posts and pages
		//add_meta_box('gum-meta', 'Gumroad', 'display_meta_box', 'post', 'side', 'core');
		//add_meta_box('gum-meta', 'Gumroad', 'add_meta_form', 'page', 'side', 'core');
		//add_meta_box('gum-meta', 'Gumroad', 'add_meta_form', 'movies', 'side', 'core');
		
		
		function display_meta_box( $post ) {
			$gum_meta = get_post_meta( $post->ID, '_gum_enabled', true );

			wp_nonce_field( basename( __FILE__ ), 'gum_enabled_nonce' );
			?>
			<p>
				<input type="checkbox" name="gum_enabled" <?php checked( $gum_meta, 'on', 1 ); ?> />
				<label for="gum_enabled"><?php echo __( 'Enable Gumroad overlay on this page', 'gum' ); ?></label>
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

		if( !isset( $_POST['gum_enabled_nonce'] ) || !wp_verify_nonce ( $_POST['gum_enabled_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		
		if( !current_user_can( 'edit_post', $post_id ) ) 
			return $post_id;
		
		if( isset( $_POST['gum_enabled'] ) ) {
			update_post_meta( $post_id, '_gum_enabled', $_POST['gum_enabled'] );
		} else {
			delete_post_meta( $post_id, '_gum_enabled' );
		}
	}

	/**
	 * Add plugin listing "Settings" and other action links
	 *
	 * @since    1.0.0
	 */
	function add_action_link( $links, $file ) {
		static $this_plugin;
		if ( empty( $this_plugin ) ) $this_plugin = $this->plugin_slug . '/' . $this->plugin_slug . '.php';
		if ( $file == $this_plugin ) {
			$settings_link = '<a href="' . admin_url( 'options-general.php?page='  . $this->plugin_slug ) . '">' . __( 'Settings', 'gum' ) . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}
}
