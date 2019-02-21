=== Gumroad ===
Contributors: karloscarweber, pderksen, nickyoung87, gumroad
Tags: gumroad, gumroad product pages, gumroad overlay, gumroad embed, ecommerce, e-commerce, pdf, javascript, overlay, embed
Requires at least: 3.9
Tested up to: 4.9.6
Stable tag: 2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Make your Gumroad products available for purchase right within WordPress.

== Description ==

This plugin lets you embed Gumroad into your website, using our Overlay and Embed widgets: https://gumroad.com/widgets

Zero coding knowledge is required. Once installed, all links to Gumroad will automatically open the Gumroad Overlay (lightbox popup).

For more information on how this plugin works, you can see a video on our Overlay here: https://www.youtube.com/watch?v=u80Ey6lSRyE

You can also use shortcodes:

Basic overlay example: `[gumroad id="DviQY"]`

Basic embed example: `[gumroad id="GAPdj" type="embed"]`

Overlay that will automatically show the payment form: `[gumroad id="DviQY" text="Purchase Item" wanted="true"]`

The ID ("GAPdJ") is the same as your Gumroad product URL ("gumroad.com/l/GAPdJ"). See the full documentation in Settings > Gumroad after the plugin is activated.

== Installation ==

= 1. Admin Search =
1. In your Admin, go to menu Plugins > Add.
1. Search for `Gumroad`.
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

Your theme must implement **wp_footer()** in the footer.php file, otherwise JavaScript will not load correctly. You can test if this is the issue by switching to a WordPress stock theme such as twenty-twelve temporarily.

If the overlay doesn't get triggered on click (and your browser is redirected to a gumroad.com URL), please make sure that there is not extra code that is hijacking the click event (for example, a Google Analytics onclick event).

A popular known plugin that does this is "Google Analytics for WordPress". Try unchecking one or both of these options: 1) Track outbound clicks & downloads, 2) Check Advanced Settings, then make sure "Track outbound clicks as pageviews" is un-checked.

See the official Gumroad [overlay](https://gumroad.com/overlay) or [embed](https://gumroad.com/embed) documentation for further troubleshooting.

== Screenshots ==

1. Example of the Overlay popup

2. Example of the inline Embed

== Changelog ==

= 1.2.4 - January 30, 2019 =

* Add Gutenberg Blocks

= 1.2.3 - January 28, 2019 =

* Simplify admin help page.
* Regular links are now the default for Gumroad short codes.
* Add option to choose to make a link a button.

= 1.2.2 - December 13, 2018 =

* Simplify HTML/CSS for admin help page
* Remove locale preference from shortcodes

= 1.2.1 - December 11, 2018 =

* Tested up to Wordpress 4.9.8
* Posts with product links now automatically include gumroad.js

= 1.2 =

* Tested up to Wordpress 4.9.6
* New documentation

= 1.1.9 - April 25, 2015 =

* Updated calls to add_query_arg to prevent any possible XSS attacks.
* Tested up to WordPress 4.2.

= 1.1.8 =

* Remove note in help about using in template files or theme files.

= 1.1.7 =

* Tested up to WordPress 4.1.

= 1.1.6 =

* Replace all i18n functions with escaped equivalents.
* Simplified load_plugin_textdomain() call.
* Add proper escaping when building the overlay button.
* Removed activation/install notice.
* Removed some now unused functions and files.

= 1.1.5 =

* Videos added to in-plugin help page.
* Demo videos added to Readme.txt.
* Tested up to WordPress 4.0.

= 1.1.4 =

* Added shortcode attribute to add CSS classes to the overlay link button.

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
