=== Gumroad Product Pages ===
Contributors: pderksen, nickyoung87
Tags: gumroad, gumroad product pages, gumroad overlay, gumroad embed, ecommerce, e-commerce, pdf, javascript, overlay, embed
Requires at least: 3.6.1
Tested up to: 3.9
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display your Gumroad product pages in a pretty lightbox or embed them right in your posts using shortcodes.

== Description ==

This plugin lets you bring in the Gumroad product pages right onto your site, so that transactions can happen inline — without ruining the browsing experience for your customers.

The overlay option pops up the purchase form in a pretty lightbox.

The embed option shows the product purchase form directly on your page.

Shortcode examples:

`[gumroad id="demo"]`
`[gumroad id="demo" type="embed"]`
`[gumroad id="demo" text="Purchase Item" wanted="true"]`

Full shortcode documentation is in Settings > Gumroad after plugin is activated.

[Follow this project on Github](https://github.com/pderksen/WP-Gumroad).

== Installation ==

= 1. Admin Search =
1. In your Admin, go to menu Plugins > Add.
1. Search for `Gumroad`.
1. Find the plugin that's labeled `Gumroad Overlay & Embed`.
1. Look for the author name `Phil Derksen` on the plugin.
1. Click to install.
1. Activate the plugin.
1. A new menu item `Gumroad` will appear under your Settings menu option.

= 2. Download & Upload =
1. Download the plugin (a zip file) on the right column of this page.
1. In your Admin, go to menu Plugins > Add.
1. Select the tab "Upload".
1. Upload the .zip file you just downloaded.
1. Activate the plugin.
1. A new menu item `Gumroad` will appear under your Settings menu option.

= 3. FTP Upload =
1. Download the plugin (.zip file) on the right column of this page.
1. Unzip the zip file contents.
1. Upload the `gumroad` folder to the `/wp-content/plugins/` directory of your site.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. A new menu item `Gumroad` will appear under your Settings menu option.

== Frequently Asked Questions ==

Full shortcode documentation is in Settings > Gumroad after plugin is activated.

Your theme must implement **wp_footer()** in the footer.php file, otherwise JavaScript will not load correctly. You can test if this is the issue by switching to a WordPress stock theme such as twenty-twelve temporarily.

If the overlay doesn't get triggered on click (and your browser is redirected to a gumroad.com URL), please make sure that there is not extra code that is hijacking the click event (for example, a Google Analytics onclick event).

A popular known plugin that does this is "Google Analytics for WordPress". Try unchecking one or both of these options: 1) Track outbound clicks & downloads, 2) Check Advanced Settings, then make sure "Track outbound clicks as pageviews" is un-checked.

See the official Gumroad [overlay](https://gumroad.com/overlay) or [embed](https://gumroad.com/embed) documentation for further troubleshooting.

Spanish translation by Andrew Kurtis of [webhostinghub.com](http://www.webhostinghub.com/).

== Changelog ==

= 1.1.3 = 

* Added locale shortcode attribute.

= 1.1.2 =

* Spanish translation updates.

= 1.1.1 =

* Added Spanish translation (thanks to Andrew Kurtis of [webhostinghub.com](http://www.webhostinghub.com/)).
* Tested up to WordPress 3.9.

= 1.1.0 =

* Added Gumroad embed purchase page option.
* Plugin now uses only shortcodes to display Gumroad overlay or embed.
* Main settings options removed.
* Post meta options removed.
* Tested up to WordPress 3.8.

= 1.0.1 =

* Bug fixes.
* Added settings link to plugin listing entry.
* Added plugin activation notice.
* Added sidebar content to settings page.
* Fixed PHP debug warnings.

= 1.0.0 =

* Initial release.

== Upgrade Notice ==

= 1.1.0 =

After upgrading your previously saved Gumroad settings will no longer apply. This plugin now uses shortcodes only.
