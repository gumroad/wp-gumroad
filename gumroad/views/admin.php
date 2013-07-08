<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package		GUM
 * @subpackage	Views
 * @author		Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */
?>
<div class="wrap">
	<?php global $gum_settings; ?>
	
	<?php screen_icon( 'edit' ); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<p>
		For enabling the Gumroad overlay on individual posts or pages, when you edit a post or page you'll see the option among the right sidebar options.
	</p>
	<p>
		For enabling the Gumroad overlay for list pages with multiple posts, use the general settings below.
	</p>
	<p>
		In all cases add Gumroad links as you normally would to your content (i.e. <code>http://gum.co/demo</code>) and the overlay should appear where enabled.
	</p>

	<div id="container">
		<?php // TODO settings_errors(); ? ?>

		<form method="post" action="options.php">
			<?php
			
				settings_fields( 'gum_settings_general' );
				do_settings_sections( 'gum_settings_general' );

				submit_button();
			?>
		</form>
	</div>

	<div class="updated">
		<p>
			Find this plugin useful? Can you do us a huge favor and
			<strong><a href="http://wordpress.org/support/view/plugin-reviews/gumroad" target="_blank">Rate it on WordPress.org</a></strong>. Thanks!
		</p>
	</div>
	
</div>
