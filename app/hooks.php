<?php

add_action( 'wp', function() {
	$page_type = \MLWoo\Ecommerce\WooCommerce\Endpoints\Base::$page_type;
	add_filter( "mlwoo_" . $page_type . "_css", '__return_false' );
} );
