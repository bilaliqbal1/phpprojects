<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.ceylonthemes.com/
 * @since      1.0.0
 *
 * @package    Ceylon Themes
 * @subpackage Ceylon_Demo_Setup
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ceylon Themes
 * @subpackage Ceylon_Demo_Setup
 * @author     Ceylon Themes <info@ceylonthemes.com>
 */
class Ceylon_Demo_Setup_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        update_option( '__ceylon_demo_setup_do_redirect', true );
	}
}