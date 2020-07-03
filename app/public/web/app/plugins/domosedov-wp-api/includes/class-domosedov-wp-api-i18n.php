<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       domosedev.info
 * @since      1.0.0
 *
 * @package    Domosedov_Wp_Api
 * @subpackage Domosedov_Wp_Api/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Domosedov_Wp_Api
 * @subpackage Domosedov_Wp_Api/includes
 * @author     Aleksandr Grigorii <domosedov.dev@gmail.com>
 */
class Domosedov_Wp_Api_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'domosedov-wp-api',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
