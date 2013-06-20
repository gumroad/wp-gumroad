<?php
	/**
	* Register Settings
	*
	* @package GUM     
	* @subpackage
	* @copyright   Copyright (c) 2013, 
	* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
	* @since       1.0
    */

    // Exit if accessed directly
    if ( !defined( 'WPINC' ) ) exit;

function gum_register_settings() {
	$gum_settings = array(
	    /* General Settings */
	    'general' => array(
		   'activate_on' => array(
			  'id' => 'show_on',
			  'name' => __('Activate Gumroad on', 'pib'),
			  'desc' => '',
			  'type' => 'multicheck',
			  'options' => array(
				 'blog_home_page' => array(
					'label' => __('Blog Home Page (or Latest Posts Page)', 'pib'),
					'value' => 1
				),
				 'front_page' => array(
					'label' => __('Front Page (different from Home Page only if set in Settings > Reading)', 'pib'),
					'value' => 1
				),
				 'archives' => array(
					'label' => __('Archives (includes Category, Tag, Author, and date-based pages', 'pib'),
					'value' => 1
				)
			  )
		   )
	    )
	);
	
	/* If the options do not exist then create them for each section */
	if ( false == get_option( 'gum_settings_general' ) ) {
		add_option( 'gum_settings_general' );
	}
	
	/* Add the General Settings section */
	add_settings_section(
		'gum_settings_general',
		__( 'General Settings', 'gum' ),
		'__return_false',
		'gum_settings_general'
	);
	
	foreach ( $gum_settings['general'] as $option ) {
		add_settings_field(
			'gum_settings_general[' . $option['id'] . ']',
			$option['name'],
			function_exists( 'gum_' . $option['type'] . '_callback' ) ? 'gum_' . $option['type'] . '_callback' : 'gum_missing_callback',
			'gum_settings_general',
			'gum_settings_general',
			array(
				'id' => $option['id'],
				'desc' => $option['desc'],
				'name' => $option['name'],
				'section' => 'general',
				'size' => isset( $option['size'] ) ? $option['size'] : null,
				'options' => isset( $option['options'] ) ? $option['options'] : '',
				'std' => isset( $option['std'] ) ? $option['std'] : ''
			)
		);
	}
	
	/* Register all settings or we will get an error when trying to save */
	register_setting( 'gum_settings_general',		'gum_settings_general',			'gum_settings_sanitize' );
	
}
add_action('admin_init', 'gum_register_settings');


/*
 * Multiple checkboxes callback function
 */

function gum_multicheck_callback( $args ) {
	global $gum_options;

	foreach( $args['options'] as $key => $option ):
		if( isset( $gum_options[$args['id']][$key] ) ) { $enabled = $option; } else { $enabled = NULL; }
		echo '<input name="gum_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']"" id="gum_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="checkbox" value="' . $option['value'] . '" ' . checked($option, $enabled, false) . '/>&nbsp;';
		echo '<label for="gum_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option['label'] . '</label><br/>';
	endforeach;
	echo '<p class="description">' . $args['desc'] . '</p>';
}

/*
 * Function we can use to sanitize the input data and return it when saving options
 */

function gum_settings_sanitize( $input ) {
	add_settings_error( 'gum-notices', '', __('Settings Updated', 'gum'), 'updated' );
	return $input;
}
/*
 *  Default callback function if correct one does not exist
 */

function gum_missing_callback() {
	printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'gum' ), $args['id'] );
}

/*
 * Function used to return an array of all of the plugin settings
 */
function gum_get_settings() {
	$general_settings =			is_array( get_option( 'gum_settings_general' ) ) ? get_option( 'gum_settings_general' )  : array();
	
	return array_merge( $general_settings );
}

