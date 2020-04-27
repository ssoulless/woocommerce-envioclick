<?php
/**
 * @package EnvioclickPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->set_pages();

		$this->set_subpages();

		//To add more sub pages in the future
		$this->settings->add_pages( $this->pages )->with_subpage( 'General Settings' )->add_subpages( $this->subpages )->register();
	}

	public function set_pages()
	{
		$this->pages = array(
			array(
				'page_title' => 'EnvioClick', 
				'menu_title' => 'EnvioClick', 
				'capability' => 'manage_options', 
				'menu_slug' => 'envioclick_plugin', 
				'callback' => function() { echo '<h1>Envioclick Plugin</h1>'; }, 
				'icon_url' => 'dashicons-admin-generic', 
				'position' => 9
			)
		);
	}

	public function set_subpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'envioclick_plugin',
				'page_title' => 'Authentication', 
				'menu_title' => 'API Authentication', 
				'capability' => 'manage_options', 
				'menu_slug' => 'envioclick_authentication', 
				'callback' => function() { echo '<h1>Envioclick API Authentication</h1>'; }
			)
		);
	}
}