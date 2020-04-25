<?php

/**
* @package EnvioclickPlugin
*/

namespace Inc\Base;

class Admin
{

	public function register() {
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue') );
	}

	function enqueue(){
		// enqueue all the scripts
		wp_enqueue_style( 'adminEnvioclickStyles', PLUGIN_URL . 'assets/admin.css' ) );
	}
}
