<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.ceylonthemes.com/
 * @since      1.0.0
 *
 * @package    Ceylon Themes
 * @subpackage Ceylon_Demo_Setup
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ceylon Themes
 * @subpackage Ceylon_Demo_Setup
 * @author     Ceylon Themes <info@ceylonthemes.com>
 */
class Ceylon_Demo_Setup_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ceylon-demo-installer',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}