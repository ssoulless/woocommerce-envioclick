<?php
/**
 * @package EnvioclickPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;

class Admin extends BaseController
{

	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages(){
		add_menu_page( 'EnvioClick', 'EnvioClick', 'manage_options', 'envioclick_plugin', array( $this, 'admin_index' ), 'dashicons-admin-generic', 9 );
	}

	public function admin_index(){
		require_once $this->plugin_path . 'templates/admin.php';
	}
}