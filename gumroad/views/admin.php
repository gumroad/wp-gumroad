<?php

/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package    GUM
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorgumeb@gmail.com>, Gumroad <maxwell@gumroad.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wrap">
	<div id="gum-settings">
		<div id="gum-settings-content">

			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<p>Use the shortcode <code>[gumroad id="DviQY"]</code> to add a product link that will open in an overlay.</p>

			<p>Use the shortcode <code>[gumroad id="GAPdj" type="embed"]</code> to add an embedded Gumroad product.</p>

			<h4>Available attributes for a shortcode:</h4>

			<table class="widefat importers" cellspacing="0">
				<thead>
					<tr>
						<th>Attribute</th>
						<th>Description</th>
						<th>Options</th>
						<th>Default</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>id</td>
						<td>Gumroad product ID</td>
						<td>Any valid Gumroad product ID, <a href="https://help.gumroad.com/11164-Payments/whats-my-product-id" target="_blank">What is my Gumroad product ID?</a></td>
						<td>none</td>
					</tr>
					<tr>
						<td>type</td>
						<td>The type of product link you want to show.</td>
						<td>overlay, embed</td>
						<td>overlay</td>
					</tr>
					<tr>
						<td>text</td>
						<td>Text that shows on the overlay button (applies to overlay only).</td>
						<td>Any text</td>
						<td>I want this!</td>
					</tr>
					<tr>
						<td>wanted</td>
						<td>If true, user will be sent directly to the checkout form (applies to overlay only).</td>
						<td>true if wanted, otherwise leave unspecified</td>
						<td>False</td>
					</tr>
				</tbody>
			</table>
		</div><!-- #gum-settings-content -->

		<div id="gum-settings-sidebar">
			<?php include( 'admin-sidebar.php' ); ?>
		</div>
	</div>

</div><!-- .wrap -->
