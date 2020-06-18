<?php

namespace GroundhoggExtension;

use Groundhogg\Admin\Admin_Menu;
use Groundhogg\DB\Manager;
use Groundhogg\Extension;

class Plugin extends Extension {


	/**
	 * Override the parent instance.
	 *
	 * @var Plugin
	 */
	public static $instance;

	/**
	 * Include any files.
	 *
	 * @return void
	 */
	public function includes() {
//        require  GROUNDHOGG_EXTENSION_PATH . '/includes/functions.php';
	}

	/**
	 * Init any components that need to be added.
	 *
	 * @return void
	 */
	public function init_components() {
		$this->installer = new Installer();
		$this->updater   = new Updater();
		$this->roles     = new Roles();
	}

	/**
	 * Get the ID number for the download in EDD Store
	 *
	 * @return int
	 */
	public function get_download_id() {
		// TODO: Implement get_download_id() method.
	}

	/**
	 * Get the version #
	 *
	 * @return mixed
	 */
	public function get_version() {
		return GROUNDHOGG_EXTENSION_VERSION;
	}

	/**
	 * @return string
	 */
	public function get_plugin_file() {
		return GROUNDHOGG_EXTENSION__FILE__;
	}

	/**
	 * Register autoloader.
	 *
	 * Groundhogg autoloader loads all the classes needed to run the plugin.
	 *
	 * @since 1.6.0
	 * @access private
	 */
	protected function register_autoloader() {
		require GROUNDHOGG_EXTENSION_PATH . 'includes/autoloader.php';
		Autoloader::run();
	}
}

Plugin::instance();