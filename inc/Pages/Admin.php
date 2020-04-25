<?php

/**
* @package EnvioclickPlugin
*/

namespace Inc\Pages;

class Admin
{

	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages(){
		add_menu_page( 'EnvioClick', 'EnvioClick', 'manage_options', 'envioclick_plugin', array( $this, 'admin_index' ), 'dashicons-admin-generic', 9 );
	}

	public function admin_index(){
		require_once PLUGIN_PATH . 'templates/admin.php';
	}
}