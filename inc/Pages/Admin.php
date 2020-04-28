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

		$this->set_settings();

		$this->set_sections();

		$this->set_fields();

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
				'callback' => array( $this->callbacks, 'admin_general_settings' ), 
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
				'callback' => array( $this->callbacks, 'admin_authentication' )
			)
		);
	}

	public function set_settings()
	{
		$args = array(
			array(
				'option_group' => 'envioclick_options_group',
				'option_name' => 'text_example',
				'callback' => array( $this->callbacks, 'envioclick_options_group')
			),
			array(
				'option_group' => 'envioclick_options_group',
				'option_name' => 'api_key'
			)
		);

		$this->settings->set_settings( $args );
	}

	public function set_sections()
	{
		$args = array(
			array(
				'id' => 'envioclick_admin_index',
				'title' => 'Settings',
				'callback' => array( $this->callbacks, 'envioclick_admin_section'),
				'page' => 'envioclick_plugin'
			)
		);

		$this->settings->set_sections( $args );
	}

	public function set_fields()
	{
		$args = array(
			array(
				'id' => 'text_example',
				'title' => 'Text example',
				'callback' => array( $this->callbacks, 'envioclick_text_example'),
				'page' => 'envioclick_plugin',
				'section' => 'envioclick_admin_index',
				'args' => array(
					'label_for' => 'text_example',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'api_key',
				'title' => 'API Key',
				'callback' => array( $this->callbacks, 'envioclick_api_key'),
				'page' => 'envioclick_plugin',
				'section' => 'envioclick_admin_index',
				'args' => array(
					'label_for' => 'api_key',
					'class' => 'example-class'
				)
			)
		);

		$this->settings->set_sections( $args );
	}
}