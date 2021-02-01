<?php
add_filter( 'woocommerce_locate_template', function( $template, $template_name, $template_path ) {
	if ( ! MLWOO_IS_APP ) {
		return $template;
	}

	$name = basename( $template );

	if ( 'cart-shipping.php' === $name ) {
		return MLBERK_TEMPLATE_PATH . 'cart-shipping.php';
	}

	if ( 'error.php' === $name ) {
		return MLBERK_TEMPLATE_PATH . 'error.php';
	}

	return $template;
}, 9999, 3 );