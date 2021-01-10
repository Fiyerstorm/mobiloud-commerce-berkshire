<?php
namespace MLBerkshire\App;

add_filter( 'mlwoo_template_product_category', '\MLBerkshire\App\berkshire_product_category_template' );
function berkshire_product_category_template( $template ) {
	$template = MLBERK_PATH . 'templates/product-category.php';
	return $template;
}

function get_formatted_categories( $terms = array() ) {
	$categories = array();

	foreach ( $terms as $index => $term_id ) {
		$term = get_term_by( 'id', $term_id, 'product_cat' );
		$thumbnail_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
		$image_url    = wp_get_attachment_url( $thumbnail_id );

		if ( false === $image_url ) {
			$image_url = \MLWoo\Ecommerce\WooCommerce\Utils\get_placeholder_image_url();
		}

		$term->image_url = $image_url;
		$categories[] = $term;
	}

	return $categories;
}
