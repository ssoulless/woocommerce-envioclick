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
	class WC_Envioclick
	{

		public $plugin;

		function __construct(){
			$this->plugin = plugin_basename( __FILE__ );
		}
    
	    function register(){
	    	add_action( 'admin_enqueue_scripts', array($this, 'enqueue') );
	    	add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	    	add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link') );
	    }

	    public function settings_link( $links ){
	    	$settings_link = '<a href="admin.php?page=envioclick_plugin">Settings</a>';
	    	array_push( $links, $settings_link);
	    	return $links;
	    }

	    public function add_admin_pages(){
	    	add_menu_page( 'EnvioClick', 'EnvioClick', 'manage_options', 'envioclick_plugin', array( $this, 'admin_index' ), 'dashicons-admin-generic', 9 );
	    }

	    public function admin_index(){
	    	require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
	    }

	    function enqueue(){
	    	// enqueue all the scripts
	    	wp_enqueue_style( 'mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__) );
	    }

	 //    /*
		// * Add action button in order list to change order status from completed to delivered
		// */
		// public function add_shipped_order_status_actions_button($actions, $order){
			
		// 	// wp_enqueue_style( 'shipment_tracking_styles',  wc_advanced_shipment_tracking()->plugin_dir_url() . 'assets/css/admin.css', array(), wc_advanced_shipment_tracking()->version );	
		// 	// wp_enqueue_script( 'woocommerce-advanced-shipment-tracking-js', wc_advanced_shipment_tracking()->plugin_dir_url() . 'assets/js/admin.js', array( 'jquery' ), wc_advanced_shipment_tracking()->version);
			
		// 	$actions['add_tracking'] = array(
		// 		'url'       => "#".$order->get_id(),
		// 		'name'      => __( 'Add Tracking', 'woo-advanced-shipment-tracking' ),
		// 		'action'    => "add_inline_tracking", // keep "view" class for a clean button CSS
		// 	);		
		// 	return $actions;
		// }

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
