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

	<h4>More examples</h4>

	<ul class="ul-disc">
		<li><code>[gumroad id="DviQY" text="Purchase Item" wanted="true"]</code></li>
		<p><img style="width: 100%;max-width: 941px;" src="https://s3.amazonaws.com/gumroad/assets/wordpress_docs/wantedoverlaydemo.gif"></p>
	</ul>

	<h3>Automatic linking and embeds</h3>

	<p>Links to Gumroad products will automatically trigger the overlay. Embed code copied from the Gumroad product widget will also work without including the script tag:</p>

	<p>
		<code>
		&lt;div class="gumroad-product-embed" data-gumroad-product-id="DviQY"&gt;&lt;a href="https://gumroad.com/l/qLlJJ"&gt;Loading...&lt;/a&gt;&lt;/div&gt;
		</code>
	</p>

	<hr>

	<p>We'd love a super short review. Seriously, it means a lot.</p>

	<a href="https://wordpress.org/support/view/plugin-reviews/gumroad" class="button-primary" target="_blank">Submit a review</a>

	<p>Need some help? Have a feature request?</p>
	<p><a href="https://wordpress.org/support/plugin/gumroad" target="_blank">Visit our Community Support Forums</a></p>

	<hr>

</div><!-- .wrap -->
