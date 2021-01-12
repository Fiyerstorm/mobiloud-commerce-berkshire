<?php
namespace MLBerkshire\App;

add_filter( 'mlwoo_template_single_product', '\MLBerkshire\App\berkshire_single_product_template' );
function berkshire_single_product_template() {
	$template = MLBERK_PATH . 'templates/single-product.php';
	return $template;
}
