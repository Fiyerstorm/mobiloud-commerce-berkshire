<?php
add_filter( 'mlwoo_cart_override_templates', function( $template, $template_name, $template_path ) {
	$basename = basename( $template );

	if ( 'cart-shipping.php' === $basename ) {
		return MLBERK_TEMPLATE_PATH . 'cart-shipping.php';
	}

	return $template;
}, 10, 3 );
