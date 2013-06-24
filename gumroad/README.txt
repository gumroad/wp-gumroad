=== Gumroad Overlay ===
Contributors: pderksen, nickyoung87
Tags: gumroad, gumroad overlay, ecommerce, e-commerce, pdf, javascript, embed
Requires at least: 3.4.2
Tested up to: 3.6
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display your Gumroad purchase pages in a pretty lightbox overlay.

== Description ==

The Gumroad overlay lets you bring in the Gumroad purchase pages right onto your site, so that transactions can happen inline — in a pretty Gumroad lightbox — without ruining the browsing experience for your customers (taken from the official [Gumroad overlay documentation](https://gumroad.com/overlay)).

This plugin simply embeds the Gumroad JavaScript snippet on the posts or pages you specify. Just check the box in the sidebar when editing a post or page.

You can also enable Gumroad on pages with multiple posts such as home or archive pages.

Then just add the links to your Gumroad products on your posts and pages (i.e. `http://gum.co/demo`).

== Installation ==

[TODO]

== Frequently Asked Questions ==

= Troubleshooting =

From the official [Gumroad overlay documentation](https://gumroad.com/overlay):

If the overlay doesn't get triggered on click (and your browser is redirected to a gumroad.com URL), please make sure that there is not extra code that is hijacking the click event (for example, a Google Analytics onclick event).

A popular known plugin that does this is **Google Analytics for WordPress**. Try unchecking one or both of these options: 1) Track outbound clicks & downloads, 2) Check Advanced Settings, then make sure "Track outbound clicks as pageviews" is un-checked.

Your theme must implement **wp_footer()** in the footer.php file, otherwise JavaScript will not load correctly. You can test if this is the issue by switching to a WordPress stock theme such as twenty-twelve temporarily.

== Screenshots ==

1. Enabling Gumroad overlay JavaScript in the post sidebar.
2. Screenshot of Gumroad overlay on top of a WordPress page.

== Changelog ==

= 1.0.0 =
* Initial release
