<?php
/**
 * Plugin Name: Wellcrafted Core
 * Plugin URI: http://msherstobitow.com/plugins/wellcraftedcore
 * Description: A framework for all Wellcrafted plugins and themes.
 * Version: 1.0
 * Author: Maksim Sherstobitow
 * Author URI: http://msherstobitow.com
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * Wellcrafted Core textdomain
 */
if ( ! defined( 'WELLCRAFTED' ) ) {
    define( 'WELLCRAFTED', 'wellcrafted_core' );
}

/**
 * A minimum PHP version to use Wellcrafted Plugins
 * 
 * @var string
 * @since  1.0.0 
 */
define( 'WELLCRAFTED_COMPATIBLE_PHP_VERSION', '5.4.0' );

/**
 * Load Wellcrafted Core translations
 */
add_action('init', 'wellcrafted_load_core_plugin_textdomain' );

function wellcrafted_load_core_plugin_textdomain() {
    $locale = apply_filters( 'plugin_locale', get_locale(), WELLCRAFTED );
    load_textdomain( 
        WELLCRAFTED, 
        dirname( __FILE__ ) . '/translations/' . $locale . '.mo' 
    );
}

/**
 * Check if a PHP version is compatible with the plugin requirements.
 *
 * @since  1.0.0
 * @return bool Whether a PHP version is compatible with the plugin requirements
 */
function wellcrafted_check_php_version() {
    if ( version_compare( PHP_VERSION, WELLCRAFTED_COMPATIBLE_PHP_VERSION, '<' ) ) {
        add_action( 'admin_init', 'wellcrafted_admin_init' );
        return false;
    }
    return true;
}
/**
 * Deactivate the plugin because it's not compatible
 */
function wellcrafted_admin_init() {
    if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        add_action( 'admin_notices', 'wellcrafted_php_version_admin_notices' );

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
}

function wellcrafted_php_version_admin_notices() {
    $message = sprintf( 
        __( 'Wellcrafted Core plugin requires PHP version at least %s. You have %s' , WELLCRAFTED ),
        WELLCRAFTED_COMPATIBLE_PHP_VERSION,
        PHP_VERSION );

     echo "<div class=\"error\"> <p>$message</p></div>"; 
}


register_activation_hook( __FILE__, 'wellcrafted_check_php_version' );

if ( wellcrafted_check_php_version() ) {
    $wellcrafted_root_path = dirname( __FILE__ );
    
    /**
     * Load a Plugin class
     */
    require $wellcrafted_root_path . '/wellcrafted/core/plugin.php';
    require $wellcrafted_root_path . '/wellcrafted/core/registry.php';

    /**
     * Load singleton trait
     */
    require $wellcrafted_root_path . '/wellcrafted/core/traits/singleton.php';

    /**
     * Require functions
     */
    require $wellcrafted_root_path . '/functions/system.php';
    require $wellcrafted_root_path . '/functions/arrays.php';
    require $wellcrafted_root_path . '/functions/mail.php';
    require $wellcrafted_root_path . '/functions/hooks.php';
    require $wellcrafted_root_path . '/functions/thumbnails.php';
    require $wellcrafted_root_path . '/wellcrafted/core/core.php';
}