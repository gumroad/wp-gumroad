<?php

/**
 * Show notice after plugin install/activate in admin dashboard.
 *
 * @package    GUM
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

?>

<style>
	#gum-install-notice .button-primary,
	#gum-install-notice .button-secondary {
		margin-left: 15px;
	}
</style>

<div id="gum-install-notice" class="updated">
	<p>
		<?php echo $this->get_plugin_title() . __( ' is now installed.', 'gum' ); ?>
		<a href="<?php echo add_query_arg( 'page', $this->plugin_slug, admin_url( 'admin.php' ) ); ?>" class="button-primary"><?php _e( 'Go to Shortcode Help Now', 'gum' ); ?></a>
	</p>
</div>
