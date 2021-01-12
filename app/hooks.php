<?php

add_action( 'wp', function() {
	$page_type = \MLWoo\Ecommerce\WooCommerce\Endpoints\Base::$page_type;
	add_filter( "mlwoo_" . $page_type . "_css", '__return_false' );
} );

add_action( 'after_setup_theme', function() {
	if ( ML_IS_APP ) {
		remove_action( 'woocommerce_before_cart_totals', 'flatsome_woocommerce_before_cart_totals' );
		remove_action( 'wp_footer', 'flatsome_mobile_menu', 7 );
		remove_action( 'woocommerce_checkout_after_order_review', 'flatsome_html_checkout_sidebar' );
	}
} );

add_action( 'wp_enqueue_scripts', function() {
	if ( ML_IS_APP ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	}
} );