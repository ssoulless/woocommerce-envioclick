<?php
/**
 * @package EnvioclickPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function admin_general_settings()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function admin_authentication()
	{
		return require_once( "$this->plugin_path/templates/authentication.php" );	
	}

	public function envioclick_options_group( $input)
	{
		return $input;
	}

	public function envioclick_admin_section()
	{
		echo 'This is a beautiful admin section';
	}

	public function envioclick_text_example()
	{
		$value = esc_attr( get_option( 'text_example' ) );
		echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write something here">';
	}

	public function envioclick_api_key()
	{
		$value = esc_attr( get_option( 'api_key' ) );
		echo '<input type="text" class="regular-text" name="api_key" value="' . $value . '" placeholder="Paste Envioclick API Key here">';		
	}
}