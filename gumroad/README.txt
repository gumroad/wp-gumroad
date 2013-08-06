=== Gumroad Purchase Page Overlay ===
Contributors: pderksen, nickyoung87
Tags: gumroad, gumroad purchase pages, gumroad overlay, ecommerce, e-commerce, pdf, javascript, embed
Requires at least: 3.4.2
Tested up to: 3.6
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display your Gumroad purchase pages in a pretty lightbox overlay.

== Description ==

The Gumroad overlay lets you bring in the Gumroad purchase pages right onto your site, so that transactions can happen inline — in a pretty Gumroad lightbox — without ruining the browsing experience for your customers (taken from the official [Gumroad overlay documentation](https://gumroad.com/overlay)).

This plugin simply embeds the Gumroad JavaScript snippet on the posts or pages you specify. Just check the box along the right sidebar when editing a post or page.

You can also enable Gumroad on the home page or archive pages where multiple posts are shown. Just look under Settings in your WordPress dashboard.

Now just add links to your Gumroad products on your posts and pages (i.e. `http://gum.co/demo`).

== Installation ==

**Finding and installing through the WordPress admin:**

1. If searching for this plugin in your WordPress admin, under Plugins > Add New search for "gumroad".
1. Find the plugin that's labeled **Gumroad Purchase Page Overlay**.
1. Also look for our author names (**Phil Derksen** and **Nick Young**).
1. Click "Install Now", then Activate, then head to Settings > Gumroad.

**Alternative installation methods:**

* Download this plugin, then upload through the WordPress admin (Plugins > Add New > Upload)
* Download this plugin, unzip the contents, then FTP upload to the `/wp-content/plugins/` directory

== Frequently Asked Questions ==

= Troubleshooting =

From the official [Gumroad overlay documentation](https://gumroad.com/overlay):

If the overlay doesn't get triggered on click (and your browser is redirected to a gumroad.com URL), please make sure that there is not extra code that is hijacking the click event (for example, a Google Analytics onclick event).

A popular known plugin that does this is **Google Analytics for WordPress**. Try unchecking one or both of these options: 1) Track outbound clicks & downloads, 2) Check Advanced Settings, then make sure "Track outbound clicks as pageviews" is un-checked.

Your theme must implement **wp_footer()** in the footer.php file, otherwise JavaScript will not load correctly. You can test if this is the issue by switching to a WordPress stock theme such as twenty-twelve temporarily.

== Screenshots ==

1. Enabling Gumroad overlay JavaScript in the post sidebar.
2. Gumroad purchase page overlay on top of a WordPress page.
3. Gumroad overlay settings page (home/archive page options).

== Changelog ==

= 1.0.1 =
* Bug fixes.
* Added settings link to plugin listing entry.
* Added plugin activation notice.
* Added sidebar content to settings page.
* Fixed PHP debug warnings.

= 1.0.0 =
* Initial release
