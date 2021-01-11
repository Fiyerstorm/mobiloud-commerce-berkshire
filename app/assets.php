<?php
namespace MLBerkshire\App;
add_action( 'wp_enqueue_scripts','\MLBerkshire\App\enqueue_scripts', 999 );
function enqueue_scripts() {
	if ( ! ML_IS_APP ) {
		return;
	}

	$page_type = \MLWoo\Ecommerce\WooCommerce\Endpoints\Base::$page_type;
	$asset_version = 1;

	wp_enqueue_style(
		'mlwoo-' . $page_type . "-style",
		MLBERK_URL . "dist/css/" . $page_type . ".css",
		array(),
		$asset_version,
		'all'
	);

	if ( 'product-category' === $page_type ) {
		wp_enqueue_script(
			'mlwoo-' . $page_type . "-script",
			MLBERK_URL . "dist/js/" . $page_type . ".bundle.js",
			array( 'jquery' ),
			$asset_version,
			true
		);

		wp_localize_script(
			'mlwoo-' . $page_type . "-script",
			'mlwoo',
			array(
				'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
				'cartCount' => $woocommerce->cart->cart_contents_count,
			)
		);
	}
}
