<?php

/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package    GUM
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorgumeb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;
?>

<div class="wrap">

	<div id="gum-settings">
		<div id="gum-settings-content">

			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			
			<!-- Gumroad Shortcode Help -->

			<h3 class="title"><?php _e( 'Getting Started', 'gum' ); ?></h3>

			<p>
				<?php _e( 'Use the shortcode', 'gum' ); ?> <code>[gumroad id="demo"]</code> <?php _e( 'to add a product link that will popup in an overlay.', 'gum' ); ?>
			</p>
			<p>
				<?php _e( 'Use the function', 'gum' ); ?> <code><?php echo htmlentities( '<?php echo do_shortcode(\'[gumroad id="demo"]\'); ?>' ); ?></code>
				<?php _e( 'to display within template or theme files.', 'gum' ); ?>
			</p>

			<h4><?php _e( 'Available Attributes', 'gum' ); ?></h4>

			<table class="widefat importers" cellspacing="0">
				<thead>
					<tr>
						<th><?php _e( 'Attribute', 'gum' ); ?></th>
						<th><?php _e( 'Description', 'gum' ); ?></th>
						<th><?php _e( 'Options', 'gum' ); ?></th>
						<th><?php _e( 'Default', 'gum' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>id</td>
						<td><?php _e( 'The Gumroad product ID', 'gum' ); ?></td>
						<td>Any valid Gumroad product ID</td>
						<td>none</td>
					</tr>
					<tr>
						<td>type</td>
						<td><?php _e( 'The type of product link you want to show.', 'gum' ); ?></td>
						<td>overlay, embed</td>
						<td>overlay</td>
					</tr>
					<tr>
						<td>text</td>
						<td><?php _e( 'The text that shows on the overlay button. This only applies if the type is set to overlay.', 'gum' ); ?></td>
						<td>Any text</td>
						<td>Buy Now</td>
					</tr>
					<tr>
						<td>wanted</td>
						<td><?php _e( 'Will take the user right to the checkout page for this item. This only applies if the type is set to overlay.', 'gum' ); ?></td>
						<td>true, false</td>
						<td>false</td>
					</tr>
				</tbody>
			</table>
			
			<h4><?php _e( 'Examples', 'gum' ); ?></h4>

			<ul class="ul-disc">
				<li><code>[gumroad id="demo"]</code></li>
				<li><code>[gumroad id="demo" type="embed"]</code></li>
				<li><code>[gumroad id="demo" text="Purchase Item" wanted="true"]</code></li>
			</ul>

		</div><!-- #gum-settings-content -->

		<div id="gum-settings-sidebar">
			<?php include( 'admin-sidebar.php' ); ?>
		</div>
	</div>

</div><!-- .wrap -->
