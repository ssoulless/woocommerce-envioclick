<?php
/*
Plugin Name: Woocommerce EnvioClick
Description: Integration of woocommerce with the shipping provider EnvioClick.
Version: 0.1.0
Contributors: ssoulless
Author: Sebastian Velandia Giraldo
Author URI: https://www.instagram.com/svelagiraldo27/
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: woocommerce-envioclick
Domain Path:  /languages
*/


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists('WC_Envioclick') ){
	class WC_Envioclick{
    
	    function register(){
	    	add_action( 'admin_enqueue_scripts', array($this, 'enqueue') );
	    }

	    function enqueue(){
	    	// enqueue all the scripts
	    	wp_enqueue_style( 'mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__) );
	    }

	     /**
	     * Get MP alert frame for notfications 
	     *
	     * @param string $message
	     * @param string $type
	     * @return void
	     */
	    public static function getAlertFrame($message, $type)
	    {
	        return '<div class="notice '.$type.' is-dismissible">
	                    <div class="mp-alert-frame"> 
	                        <div class="mp-right-alert">
	                            <p>' . $message . '</p>
	                        </div>
	                    </div>
	                    <button type="button" class="notice-dismiss">
	                        <span class="screen-reader-text">' . __('Discard', 'woocommerce-envioclick') . '</span>
	                    </button>
	                </div>';
	    }

	}

	if ( class_exists( 'WC_Envioclick' ) ){
		$wc_envioclick = new WC_Envioclick();
		$wc_envioclick->register();
	}
}

/**
 * Summary: Places a warning error to notify user that WooCommerce is missing.
 * Description: Places a warning error to notify user that WooCommerce is missing.
 */
function notify_woocommerce_miss()
{
    $type = 'error';
    $message = sprintf(
            __('The payment module of Woo EnvioClick depends on the latest version of %s to run!', 'woocommerce-mercadopago'),
            ' <a href="https://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a>'
        );
    echo WC_Envioclick::getAlertFrame($message, $type);
}

$all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
if (!stripos(implode($all_plugins), 'woocommerce.php')) {
    add_action('admin_notices', 'notify_woocommerce_miss');
    return;
}
