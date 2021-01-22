<?php

namespace MLBerkshire\App;

/**
 * Remove categories section.
 */
add_filter( 'mlwoo_home_display_categories', '__return_false' );

/**
 * Register nav menu
 */
add_action( 'after_setup_theme', '\MLBerkshire\App\register_menu' );
function register_menu() {
	register_nav_menus( array(
		'ml_berkshire_home_menu' => __( 'Berkshire App Homepage Categories' ),
	) );

	register_nav_menus( array(
		'ml_berkshire_product_categories_menu' => __( 'Berkshire App Product Categories' ),
	) );
}

add_filter( 'mlwoo_home_products_grid_title', function( $title ) {
	return __( 'Featured products', 'mlberk' );
} );

add_filter( 'mlwoo_template_home', function( $template ) {
	return MLBERK_PATH . 'templates/home.php';
} );

function get_primary_category( $post_id ) {
	$category_id = get_post_meta( $post_id, '_yoast_wpseo_primary_category', 'category', true );

	if ( $category_id ) {
		$category_term = get_term( (int)$category_id, 'category' );
		return $category_term->name;
	}

	return '';
}

function get_latest_posts() {
	$posts_args = array(
		'post_type'      => 'post',
		'posts_per_page' => apply_filters( 'mlberk_home_latest_posts_count', 5 ),
	);

	$posts_query = new \WP_Query( $posts_args );

	$posts_array = array();

	while ( $posts_query->have_posts() ) {
		$posts_query->the_post();

		$post_id = get_the_ID();

		$posts_array[] = array(
			'id'        => $post_id,
			'category'  => get_primary_category( $post_id ),
			'title'     => get_the_title(),
			'thumbnail' => get_the_post_thumbnail( $post_id, 'medium' ),
			'content'   =>  wp_trim_words( wp_strip_all_tags( get_the_content() ), 15, '...' ),
		);
	}

	return $posts_array;
}

function get_categories_from_menu( $menu_items = array() ) {
	$categories = array();

	if ( ! empty( $menu_items ) && is_array( $menu_items ) ) {
		foreach ( $menu_items as $index => $menu_item ) {
			$term = get_term_by( 'id', (int)$menu_item->object_id, 'product_cat' );
			$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
			$image_url    = wp_get_attachment_url( $thumbnail_id );

			if ( false === $image_url ) {
				$image_url = \MLWoo\Ecommerce\WooCommerce\Utils\get_placeholder_image_url();
			}

			$term->image_url = $image_url;
			$categories[] = $term;
		}
	}

	return $categories;
}

function get_nav_menu_items_by_location( $location, $args = [] ) {
	$locations = get_nav_menu_locations();
	$object    = wp_get_nav_menu_object( $locations[ $location ] );
	$menu_items = wp_get_nav_menu_items( $object->name, $args );

	return $menu_items;
}