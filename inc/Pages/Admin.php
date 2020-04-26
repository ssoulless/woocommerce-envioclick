<?php
/**
 * @package EnvioclickPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
	public $settings;

	public $pages = [
			[
				'page_title' => 'EnvioClick', 
				'menu_title' => 'EnvioClick', 
				'capability' => 'manage_options', 
				'menu_slug' => 'envioclick_plugin', 
				'callback' => function() { echo '<h1>Envioclick Plugin</h1>'}, 
				'icon_url' => 'dashicons-admin-generic', 
				'position' => 9
			]
		];

	public function __construct()
	{
		$this->settings = new SettingsApi();
	}

	public function register() {
		$this->settings->add_pages( $this->pages )->register();
	}

	// public function add_admin_pages(){
	// 	add_menu_page( 'EnvioClick', 'EnvioClick', 'manage_options', 'envioclick_plugin', array( $this, 'admin_index' ), 'dashicons-admin-generic', 9 );
	// }

	// public function admin_index(){
	// 	require_once $this->plugin_path . 'templates/admin.php';
	// }
}