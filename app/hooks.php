<?php

add_action( 'wp', function() {
	$page_type = \MLWoo\Ecommerce\WooCommerce\Endpoints\Base::$page_type;
	add_filter( "mlwoo_" . $page_type . "_css", '__return_false' );
} );

add_action( 'after_setup_theme', function() {
	remove_action( 'woocommerce_before_cart_totals', 'flatsome_woocommerce_before_cart_totals' );
	remove_action( 'wp_footer', 'flatsome_mobile_menu', 7 );
} );

add_action( 'wp_enqueue_scripts', function() {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} );