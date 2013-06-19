<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package		GUM
 * @author		Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license		GPL-2.0+
 * @link		http://philderksen.com
 * @copyright	2013 Phil Derksen
 */
?>
<div class="wrap">

	<?php screen_icon( 'edit' ); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<p>
		Currently you can enable the Gumroad overlay JavaScript on an individual post or page basis.
	</p>

	<p>
		When you edit a post or page, you'll see an option to enable Gumroad along the right sidebar options.
	</p>

	<p>
		Add Gumroad links as you normally would to your content (i.e. <code>http://gum.co/demo</code>) and the overlay should appear.
	</p>

</div>
