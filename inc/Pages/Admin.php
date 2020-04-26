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

	public $pages = array();

	public $subpages = array();

	public function __construct()
	{
		$this->settings = new SettingsApi();

		$this->pages = [
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

		$this->subpages = [
			[
				'parent_slug' => 'envioclick_plugin',
				'page_title' => 'Authentication', 
				'menu_title' => 'API Authentication', 
				'capability' => 'manage_options', 
				'menu_slug' => 'envioclick_authentication', 
				'callback' => function() { echo '<h1>Envioclick API Authentication</h1>'; }
			]
		];
	}

	public function register() {
		//To add more sub pages in the future
		$this->settings->add_pages( $this->pages )->with_subpage( 'General Settings' )->add_subpages( $this->subpages )->register();
	}

	// public function add_admin_pages(){
	// 	add_menu_page( 'EnvioClick', 'EnvioClick', 'manage_options', 'envioclick_plugin', array( $this, 'admin_index' ), 'dashicons-admin-generic', 9 );
	// }

	// public function admin_index(){
	// 	require_once $this->plugin_path . 'templates/admin.php';
	// }
}