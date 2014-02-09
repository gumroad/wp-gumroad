<?php

/**
 * Sidebar portion of the administration dashboard view.
 *
 * @package    GUM
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;
?>

<div class="sidebar-container">
	<div class="sidebar-content">
		<p>
			<?php _e( "Help us get noticed (and boost our egos) with a rating and short review.", 'gum' ); ?>
		</p>

		<a href="http://wordpress.org/support/view/plugin-reviews/gumroad" class="btn btn-small btn-block btn-inverse" target="_blank">
			<?php _e( 'Rate this plugin on WordPress.org', 'gum' ); ?></a>
	</div>
</div>

<div class="sidebar-container">
	<h3 class="sidebar-title-large"><?php _e( 'Need more Pinterest traffic?', 'gum' ); ?></h3>

	<div class="sidebar-content">
		<p>
			<?php _e( 'Check out our Pinterest "Pin It" Button plugin. Now with <strong>' . gum_get_pib_downloads() . '</strong> downloads!', 'gum' ); ?>
		</p>

		<p class="small-text">
			<a href="<?php echo add_query_arg( array(
					'tab'  => 'search',
					'type' => 'term',
					's'    => urlencode('"pinterest pin it button"')
				), admin_url( 'plugin-install.php' ) ); ?>" class="btn btn-small btn-block btn-danger">
				<?php _e( 'Get the Free "Pin It" Button plugin', 'gum' ); ?></a><br/>
			<a href="http://wordpress.org/plugins/pinterest-pin-it-button/" target="_blank"><?php _e( 'Visit the "Pin It" Button plugin page', 'gum' ); ?></a>
		</p>
	</div>
</div>
