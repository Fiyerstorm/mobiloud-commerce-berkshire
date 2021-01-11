<?php
/**
 * Plugin Name:     MobiLoud Commerce Extension for Berkshire
 * Plugin URI:      https://github.com/mobiloudsupport/woocommerce-integration
 * Description:     Adds support for WooCommerce based sites.
 * Author:          Siddharth Thevaril
 * Author URI:      https://github.com/sidsector9
 * Text Domain:     mlberk
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         MLBerk
 */

if ( ! defined( 'MLBERK_PATH' ) ) {
	define( 'MLBERK_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'MLBERK_URL' ) ) {
	define( 'MLBERK_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'MLBERK_TEMPLATE_PATH' ) ) {
	define( 'MLBERK_TEMPLATE_PATH', MLBERK_PATH . 'templates/' );
}

add_action( 'plugins_loaded', 'mlberk_switch_user_theme' );
function mlberk_switch_user_theme() {
	if ( ML_IS_APP ) {
		switch_theme( 'twentyseventeen' );
	} else {
		switch_theme( 'berkshire-theme' );
	}
}

require_once 'init.php';

