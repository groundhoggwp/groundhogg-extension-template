<?php
/*
 * Plugin Name: Groundhogg - My Extension
 * Plugin URI:  https://www.groundhogg.io/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Description: Your extension description here
 * Version: 1.0
 * Author: Your Name
 * Author URI: https://www.groundhogg.io/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 * Text Domain: groundhogg-extension
 * Domain Path: /languages
 *
 * Groundhogg is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Groundhogg is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

namespace GroundhoggExtension;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GROUNDHOGG_EXTENSION_VERSION', '1.0' );
define( 'GROUNDHOGG_EXTENSION_PREVIOUS_STABLE_VERSION', '1.0' );
define( 'GROUNDHOGG_EXTENSION_NAME', 'My Extension Name' );

define( 'GROUNDHOGG_EXTENSION__FILE__', __FILE__ );
define( 'GROUNDHOGG_EXTENSION_PLUGIN_BASE', plugin_basename( GROUNDHOGG_EXTENSION__FILE__ ) );
define( 'GROUNDHOGG_EXTENSION_PATH', plugin_dir_path( GROUNDHOGG_EXTENSION__FILE__ ) );

define( 'GROUNDHOGG_EXTENSION_URL', plugins_url( '/', GROUNDHOGG_EXTENSION__FILE__ ) );

define( 'GROUNDHOGG_EXTENSION_ASSETS_PATH', GROUNDHOGG_EXTENSION_PATH . 'assets/' );
define( 'GROUNDHOGG_EXTENSION_ASSETS_URL', GROUNDHOGG_EXTENSION_URL . 'assets/' );

define( 'GROUNDHOGG_EXTENSION_REQUIRED_WP_VERSION', '4.9' );
define( 'GROUNDHOGG_EXTENSION_REQUIRED_PHP_VERSION', '7.0' );
define( 'GROUNDHOGG_EXTENSION_REQUIRED_CORE_VERSION', '2.4' );

define( 'GROUNDHOGG_EXTENSION_TEXT_DOMAIN', 'groundhogg-extension' );

add_action( 'plugins_loaded', function () {
	load_plugin_textdomain( GROUNDHOGG_EXTENSION_TEXT_DOMAIN, false, basename( dirname( __FILE__ ) ) . '/languages' );
} );

// Check PHP and WP are up to date!
if ( check_wp_version() && check_php_version() ) {

	// Groundhogg is loaded, load now.
	if ( did_action( 'groundhogg/loaded' ) ) {

		if ( check_core_version() ) {
			require __DIR__ . '/includes/plugin.php';
		}

		// Lazy load, wait for Groundhogg!
	} else {

		add_action( 'groundhogg/loaded', function () {
			if ( check_core_version() ) {
				require __DIR__ . '/includes/plugin.php';
			}
		} );

		// Might not actually be loaded, so we'll check in later.
		check_groundhogg_active();
	}
}

/**
 * Check that Gorundhogg is using the latest available core version
 *
 * @return bool|int
 */
function check_core_version() {

	$correct_version = version_compare( GROUNDHOGG_VERSION, GROUNDHOGG_EXTENSION_REQUIRED_CORE_VERSION, '>=' );

	if ( ! $correct_version ) {
		add_action( 'admin_notices', function () {
			$message      = sprintf( esc_html__( '%s requires Groundhogg version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', 'groundhogg' ), GROUNDHOGG_EXTENSION_NAME, GROUNDHOGG_EXTENSION_REQUIRED_CORE_VERSION );
			$html_message = sprintf( '<div class="notice notice-error">%s</div>', wpautop( $message ) );
			echo wp_kses_post( $html_message );
		} );
	}

	return $correct_version;
}

/**
 * Check that the wp version is most recent
 *
 * @return bool|int
 */
function check_wp_version() {

	$correct_version = version_compare( get_bloginfo( 'version' ), GROUNDHOGG_EXTENSION_REQUIRED_WP_VERSION, '>=' );

	if ( ! $correct_version ) {
		add_action( 'admin_notices', function () {
			$message      = sprintf( esc_html__( '%s requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', 'groundhogg' ), GROUNDHOGG_EXTENSION_NAME, GROUNDHOGG_EXTENSION_REQUIRED_WP_VERSION );
			$html_message = sprintf( '<div class="notice notice-error">%s</div>', wpautop( $message ) );
			echo wp_kses_post( $html_message );
		} );
	}

	return $correct_version;
}

/**
 * Check that the PHP version is compatible
 *
 * @return bool|int
 */
function check_php_version() {

	$correct_version = version_compare( PHP_VERSION, GROUNDHOGG_EXTENSION_REQUIRED_PHP_VERSION, '>=' );

	if ( ! $correct_version ) {
		add_action( 'admin_notices', function () {
			$message      = sprintf( esc_html__( '%s requires PHP version %s+, plugin is currently NOT RUNNING.', 'groundhogg' ), GROUNDHOGG_EXTENSION_NAME, GROUNDHOGG_EXTENSION_REQUIRED_PHP_VERSION );
			$html_message = sprintf( '<div class="notice notice-error">%s</div>', wpautop( $message ) );
			echo wp_kses_post( $html_message );
		} );
	}

	return $correct_version;
}

/**
 * Check that Groundhogg is active!
 */
function check_groundhogg_active() {
	// Might not actually be loaded, so we'll check in later.
	add_action( 'admin_notices', function () {

		// Is not loaded!
		if ( ! defined( 'GROUNDHOGG_VERSION' ) ) {
			$message      = sprintf( esc_html__( 'Groundhogg is not currently active, it must be active for %s to work.', 'groundhogg' ), GROUNDHOGG_EXTENSION_NAME );
			$html_message = sprintf( '<div class="notice notice-warning">%s</div>', wpautop( $message ) );
			echo wp_kses_post( $html_message );
		}
	} );
}