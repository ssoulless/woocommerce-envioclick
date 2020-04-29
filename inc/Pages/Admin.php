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
				'option_group' => 'envioclick_plugin_settings',
				'option_name' => 'quote_selection_preference',
				'callback' => array( $this->callbacks, 'select_sanitize' )
			),
			array(
				'option_group' => 'envioclick_plugin_authentication',
				'option_name' => 'api_key',
				'callback' => array( $this->callbacks, 'secret_key_hashing' )
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
			),
			array(
				'id' => 'envioclick_authentication_index',
				'title' => 'API Key Authentication',
				'callback' => array( $this->callbacks, 'envioclick_authentication_section'),
				'page' => 'envioclick_authentication'
			)
		);

		$this->settings->set_sections( $args );
	}

	public function set_fields()
	{
		$args = array(
			array(
				'id' => 'shipping_quote_selection_preference',
				'title' => __('¿Cómo se van a cotizar sus órdenes?', 'envioclick'),
				'callback' => array( $this->callbacks, 'envioclick_quotation_preference_select'),
				'page' => 'envioclick_plugin',
				'section' => 'envioclick_admin_index',
				'args' => array(
					'label_for' => 'shipping_quote_selection_preference',
					'class' => 'quotation_preferences'
				)
			),
			array(
				'id' => 'envioclick_api_key',
				'title' => 'API Key',
				'callback' => array( $this->callbacks, 'envioclick_api_key_textfield'),
				'page' => 'envioclick_authentication',
				'section' => 'envioclick_authentication_index',
				'args' => array(
					'label_for' => 'envioclick_api_key',
					'class' => 'envioclick_api_key'
				) 
			)
		);

		$this->settings->set_fields( $args );
	}
}