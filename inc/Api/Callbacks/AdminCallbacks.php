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

	public function select_sanitize( $input )
	{
		$errors = null;
		$value = sanitize_text_field( $input );

		$valid_values = array(
			'cheapest',
			'fastest',
		);

		if( ! in_array( $value, $valid_values ) ) {
			add_settings_error('quote_selection_preference', 'available_options_only', __('Only select options are available', 'envioclick'), 'error');
			return get_option( 'quote_selection_preference' );
		}

		return $value;
	}

	public function secret_key_hashing( $input )
	{
		$api_key = sanitize_text_field($input);

		return $api_key;
	}

	public function envioclick_admin_section()
	{
		echo __('Selecciona cómo quieres que se seleccione la cotización para el envío de tus pedidos', 'envioclick');
	}

	public function envioclick_authentication_section()
	{
		echo __('Ingresa tu API key generada desde tu cuenta de envioclick');
	}

	public function envioclick_quotation_preference_select()
	{
		$value = esc_attr( get_option( 'quote_selection_preference' ) );
		echo '<select type="text" class="regular-text" name="quote_selection_preference">
				<option value="cheapest" ' . ($value == 'cheapest' ? 'selected' : '') .'>' . __('Por menor precio', 'envioclick') . '</option>
				<option value="fastest" '. ($value == 'fastest' ? 'selected' : '') .'>' . __('Por menor tiempo de entrega', 'envioclick') . '</option>
			</select>';
	}

	public function envioclick_api_key_textfield()
	{
		$value = esc_attr( get_option( 'api_key' ) );
		
		echo '<input type="text" class="regular-text" name="api_key" value="' . $value . '" placeholder="' . __('Pega la API key de envioclick aquí', 'envioclick') . '">';		
	}
}