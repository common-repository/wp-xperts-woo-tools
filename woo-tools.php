<?php
/**
 *Plugin Name: WP-xPerts Woo Tools
 * Plugin URI: http://wp-xperts.com/
 * Description: WP-xPerts Woo Tools is a most powerful plugin to do small woocommerce tweaks for which you need a developer. you can easily manage woocommerce product tabs, add to cart button text, redirect on add to cart, redirect on checkout and related products.
 * Version: 1.1
 * Author: Sajid Hussain
 * Author URI: http://wp-xperts.com/
 * Text Domain: wx-woo-tools
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


define( 'WX_PATH_INCLUDES', dirname( __FILE__ ) . '/inc' );
define( 'WX_PATH_CSS', plugin_dir_url( __FILE__ ) . 'css/' );
define('WX_TEXT_DOMAIN', 'wx-woo-tools');



/*
 * plugin base class
 */

class WX_WOO_Tools{

    public $WX_wt_settings;

    public function __construct()
    {
        //add settings page
        add_action( 'admin_menu', array($this, 'woo_tools_settings') );

        //script and styles on admin side
        add_action( 'admin_enqueue_scripts', array( $this, 'woo_tools_admin_styles' ) );
    }
    static function WX_get_setting($Setting_key)
    {
        $WX_tools_options   =   unserialize( get_option('WX_woo_tools_options') );
        if(array_key_exists($Setting_key, $WX_tools_options))
        {
            return $WX_tools_options[$Setting_key];
        }
        else
        {
            return '';
        }

    }

    static function testMethod()
    {
        return 'test display';
    }
    //create page settings page in admin
    public function woo_tools_settings()
    {
        add_menu_page( 'Woo Tools', 'Woo Tools', 'manage_options', 'wx-woo-tools-settings', 'wx_woo_tools_settings' );
    }

    //include css in settings page
    public function woo_tools_admin_styles( $hook )
    {
        //print_r($hook);
        if($hook != 'toplevel_page_wx-woo-tools-settings') {
            return;
        }
        wp_register_style( 'wx-woo-tools-admin-styles', plugins_url( '/css/styles-admin.css', __FILE__ ), array(), '1.0', 'screen' );
        wp_enqueue_style( 'wx-woo-tools-admin-styles' );

        wp_enqueue_script( 'jquery-ui-accordion' );
        wp_enqueue_script( 'wx-woo-tools-admin-script', plugins_url( '/js/admin-script.js', __FILE__ ) );
    }

}
if (  in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    $WooTools   =   new WX_WOO_Tools();

    function wx_woo_tools_settings()
    {
        echo '<div class="wrap">';
        _e( '<h1>Wp xPerts Woo Tools</h1>', WX_TEXT_DOMAIN );
        require_once WX_PATH_INCLUDES.'/settings.php';
        echo '</div>';
    }

    require_once 'inc/woo-hooks.php';
}

