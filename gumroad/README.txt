=== Gumroad Overlay & Embed Purchase Pages ===
Contributors: pderksen, nickyoung87
Tags: gumroad, gumroad purchase pages, gumroad overlay, gumroad embed, ecommerce, e-commerce, pdf, javascript, embed
Requires at least: 3.5.2
Tested up to: 3.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display your Gumroad purchase pages in a pretty lightbox or embed them right on your pages.

== Description ==

This plugin lets you bring in the Gumroad purchase pages right onto your site, so that transactions can happen inline — without ruining the browsing experience for your customers.

The overlay option pops up the purchase form in a pretty lightbox. See the official [Gumroad Overlay documentation](https://gumroad.com/overlay).

The embed option shows the purchase form directly on your page. See the official [Gumroad Embed documentation](https://gumroad.com/embed).

This plugin simply embeds a Gumroad JavaScript snippet on the posts or pages you specify. See the options along the right sidebar while editing a post or page.

You can also enable Gumroad on the home page or archive pages where multiple posts are shown. Just look under Settings in your WordPress dashboard.

[Follow this project on Github](https://github.com/pderksen/WP-Gumroad).

== Installation ==

= 1. Admin Search =
1. In your Admin, go to menu Plugins > Add.
1. Search for `Gumroad`.
1. Find the plugin that's labeled `Gumroad`.
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

[TODO copy from official docs]

= Troubleshooting =

[TODO this right?]

From the official [Gumroad overlay documentation](https://gumroad.com/overlay):

If the overlay doesn't get triggered on click (and your browser is redirected to a gumroad.com URL), please make sure that there is not extra code that is hijacking the click event (for example, a Google Analytics onclick event).

A popular known plugin that does this is **Google Analytics for WordPress**. Try unchecking one or both of these options: 1) Track outbound clicks & downloads, 2) Check Advanced Settings, then make sure "Track outbound clicks as pageviews" is un-checked.

Your theme must implement **wp_footer()** in the footer.php file, otherwise JavaScript will not load correctly. You can test if this is the issue by switching to a WordPress stock theme such as twenty-twelve temporarily.

== Screenshots ==

*TODO: Redo screenshots, add embed.*

1. Enabling Gumroad overlay JavaScript in the post sidebar.
2. Gumroad purchase page overlay on top of a WordPress page.
3. Gumroad overlay settings page (home/archive page options).

== Changelog ==

= 1.1.0 =

* Plugin now uses shortcodes to display the Gumroad Overlay or Embed 
* Removed main plugin settings page since plugin now uses shortcodes

= 1.0.2 =

* TODO: Added embeddable purchase page option.
* Tested up to WordPress 3.8.

= 1.0.1 =

* Bug fixes.
* Added settings link to plugin listing entry.
* Added plugin activation notice.
* Added sidebar content to settings page.
* Fixed PHP debug warnings.

= 1.0.0 =

* Initial release.
