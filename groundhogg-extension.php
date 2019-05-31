<?php
/*
 * Plugin Name: Groundhogg Extension Name
 * Plugin URI:  https://www.groundhogg.io/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Description: The description of your extension.
 * Version: 2.0
 * Author: Groundhogg Inc.
 * Author URI: https://www.groundhogg.io/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 * Text Domain: groundhogg
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

// TODO Refactor `groundhogg_extension`, `GroundhoggExtension` and `GROUNDHOGG_EXTENSION` with the name of your extension to avoid conflicts.

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'GROUNDHOGG_EXTENSION_VERSION', '1.0' ); // Todo Update Version #
define( 'GROUNDHOGG_EXTENSION_PREVIOUS_STABLE_VERSION', '0.1' ); // TODO  Update Version #
define( 'GROUNDHOGG_EXTENSION_NAME', 'My Extension' ); //TODO Update the name of your extension.

define( 'GROUNDHOGG_EXTENSION__FILE__', __FILE__ );
define( 'GROUNDHOGG_EXTENSION_PLUGIN_BASE', plugin_basename( GROUNDHOGG_EXTENSION__FILE__ ) );
define( 'GROUNDHOGG_EXTENSION_PATH', plugin_dir_path( GROUNDHOGG_EXTENSION__FILE__ ) );

define( 'GROUNDHOGG_EXTENSION_URL', plugins_url( '/', GROUNDHOGG_EXTENSION__FILE__ ) );

define( 'GROUNDHOGG_EXTENSION_ASSETS_PATH', GROUNDHOGG_EXTENSION_PATH . 'assets/' );
define( 'GROUNDHOGG_EXTENSION_ASSETS_URL', GROUNDHOGG_EXTENSION_URL . 'assets/' );

add_action( 'plugins_loaded', 'groundhogg_extension_load_plugin_textdomain' );

define( 'GROUNDHOGG_EXTENSION_TEXT_DOMAIN', 'groundhogg' );

if ( ! version_compare( PHP_VERSION, '5.4', '>=' ) ) {
    add_action( 'admin_notices', 'groundhogg_extension_fail_php_version' );
} elseif ( ! version_compare( get_bloginfo( 'version' ), '4.7', '>=' ) ) {
    add_action( 'admin_notices', 'groundhogg_extension_fail_wp_version' );
} else {
    require GROUNDHOGG_EXTENSION_PATH . 'includes/plugin.php';
}

/**
 * Load Groundhogg textdomain.
 *
 * Load gettext translate for Groundhogg text domain.
 *
 * @since 1.0.0
 *
 * @return void
 */
function groundhogg_extension_load_plugin_textdomain() {
    load_plugin_textdomain( GROUNDHOGG_EXTENSION_TEXT_DOMAIN, false, basename( dirname( __FILE__ ) ) . '/languages' );
}

/**
 * Groundhogg admin notice for minimum PHP version.
 *
 * Warning when the site doesn't have the minimum required PHP version.
 *
 * @since 2.0
 *
 * @return void
 */
function groundhogg_extension_fail_php_version() {
    /* translators: %s: PHP version */
    $message = sprintf( esc_html__( '%s requires PHP version %s+, plugin is currently NOT RUNNING.', 'groundhogg' ), GROUNDHOGG_EXTENSION_NAME, '5.6' );
    $html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
    echo wp_kses_post( $html_message );
}

/**
 * Groundhogg admin notice for minimum WordPress version.
 *
 * Warning when the site doesn't have the minimum required WordPress version.
 *
 * @since 2.0
 *
 * @return void
 */
function groundhogg_extension_fail_wp_version() {
    /* translators: %s: WordPress version */
    $message = sprintf( esc_html__( '%s requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', 'groundhogg' ), GROUNDHOGG_EXTENSION_NAME, '4.9' );
    $html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
    echo wp_kses_post( $html_message );
}