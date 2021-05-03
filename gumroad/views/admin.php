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

<div class="wrap gumroad-wrap">
	<h2><?php get_admin_page_title() ?></h2>

	<h2>Guides:</h2>

  <h3>Using Gumroad blocks</h3>

  <p>Open the post editor and add a new Gumroad Block by searching for <em>gumroad</em> in the block inserter menu. Choose the Gumroad Block option. You can change the text of the Gumroad link directly. Before the link will work you'll need to add a URL to your Gumroad block; While editing the Link text click on the gear icon in the upper right corner to reveal the settings menu.</p>

  <p>In the settings menu you can add the link to your Gumroad product.</p>

  <p>
    <img src="<?= plugins_url() ?>/gumroad/assets/images/gumroad-wp-004.gif" alt="">
  </p>

  <p>You may also change the appearance and behavior of your Gumroad link from the settings menu.</p>

  <p>
    <img src="<?= plugins_url() ?>/gumroad/assets/images/gumroad-wp-005.gif" alt="">
  </p>

  <p>It's also possible to change the link into an embedded product.</p>

  <p>
    <img src="<?= plugins_url() ?>/gumroad/assets/images/gumroad-wp-006.gif" alt="">
  </p>


	<h3>Using Shortcodes</h3>

	<h4>For WordPress version 5.0:</h4>

	<p>Open the Editor and either type <code>/</code> or click on the <em>plus</em> icon and then choose to add a shortcode.</p>

	<p>
		<img src="<?= plugins_url() ?>/gumroad/assets/images/gumroad-wp-001.png" alt="">
	</p>

	<p>With the Shortcode Block you can use shortcodes normally like you would in WordPress version <strong>4.9</strong>.</p>

	<p>
		<img src="<?= plugins_url() ?>/gumroad/assets/images/gumroad-wp-007.png" alt="">
	</p>

	<h4>For WordPress version 4.9.2 and lower:</h4>

	<p>Use the shortcode <code>[gumroad url="https://gumroad.com/l/DviQY"]</code> to add a normal link (anchor tag) to a Gumroad product with the text "I want this!". Clicking this link will not trigger the overlay.

	<p>Use the shortcode <code>[gumroad url="https://gumroad.com/l/DviQY" button="true"]</code> to add a button to a Gumroad product. This button will be purely cosmetic.

	<p>Use the shortcode <code>[gumroad url="https://gumroad.com/l/DviQY" type="overlay"]</code> to add a link to a Gumroad product that will open in an overlay.</p>

	<p>Use the shortcode <code>[gumroad url="https://gumroad.com/l/GAPdj" type="embed"]</code> to add an embedded Gumroad product.</p>

	<p>Similarly,</p>

	<p>Use the shortcode <code>[gumroad url="https://gumroad.com/a/919237747/llNDe" type="overlay"]</code> to add a link to an affiliated Gumroad product that will open in an overlay.</p>

	<p>Use the shortcode <code>[gumroad url="https://gumroad.com/a/919237747/llNDe" type="embed"]</code> to add an embedded affiliated Gumroad product.</p>

	<h4>Available attributes for a shortcode:</h4>

	<table class="widefat importers" cellspacing="0">
		<thead>
			<tr>
				<th>Attribute</th>
				<th>Required?</th>
				<th>Description</th>
				<th>Options</th>
				<th>Default</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><strong>url</strong></td>
				<td><strong>Yes</strong></td>
				<td>Gumroad product URL</td>
				<td>
					<ul class="ul-disc">
						<li>Any valid Gumroad regular product URL <small>(can be copied from <a href="https://gumroad.com/products" target="_blank">gumroad.com/products</a> while signed in)</small></li>
						<li>Or, an affiliated product URL <small>(can be copied from <a href="https://gumroad.com/products/affiliated" target="_blank">gumroad.com/products/affiliated</a> while signed in)</small></li>
					</ul>
				</td>
				<td>none</td>
			</tr>
			<tr>
				<td><strong>type</strong></td>
				<td>No</td>
				<td>The type of product link you want to show.</td>
				<td>none, overlay, embed</td>
				<td>none</td>
			</tr>
			<tr>
				<td><strong>text</strong></td>
				<td>No</td>
				<td>Text for the link or button (applies to overlay only).</td>
				<td>Any text</td>
				<td>I want this!</td>
			</tr>
			<tr>
				<td><strong>wanted</strong></td>
				<td>No</td>
				<td>If true, user will be sent directly to the checkout form (applies to overlay only).</td>
				<td>true if wanted, otherwise leave unspecified</td>
				<td>False</td>
			</tr>
			<tr>
				<td><strong>button</strong></td>
				<td>No</td>
				<td>An option to change the gumroad link into a Gumroad button.</td>
				<td>true, false</td>
				<td>False</td>
			</tr>
			<tr>
				<td><strong>class</strong></td>
				<td>No</td>
				<td>An optional class that you can add to gumroad buttons and links</td>
				<td>Text including letters, numbers, and dashes. A space separates multiple classes</td>
				<td>none</td>
			</tr>
		</tbody>
	</table>

	<h4>More examples</h4>

	<ul class="ul-disc">
		<li><code>[gumroad url="https://gumroad.com/l/DviQY" button="true" type="overlay" text="Purchase Item" wanted="true"]</code></li>
		<p><img src="https://s3.amazonaws.com/gumroad/assets/wordpress_docs/wantedoverlaydemo.gif"></p>
	</ul>

	<h3>Automatic linking and embeds</h3>

	<p>You can forego using shortcodes entirely, and links to Gumroad products will automatically trigger the overlay. Embed code copied from the <a href="https://gumroad.com/widgets" target="_blank">Gumroad product widget</a> will also work without including the script tag:</p>

	<p>
		<code>
		&lt;div class="gumroad-product-embed"&gt;&lt;a href="https://gumroad.com/l/DviQY"&gt;Loading...&lt;/a&gt;&lt;/div&gt;
		</code>
	</p>

	<hr>

	<p>We'd love a super short review. Seriously, it means a lot.</p>

	<a href="https://wordpress.org/support/view/plugin-reviews/gumroad" class="button-primary" target="_blank">Submit a review</a>

	<p>Need some help? Have a feature request?</p>
	<p><a href="https://wordpress.org/support/plugin/gumroad" target="_blank">Visit our Community Support Forums</a></p>

	<hr>

</div><!-- .wrap -->
