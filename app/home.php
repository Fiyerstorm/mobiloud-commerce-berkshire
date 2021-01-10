<?php

namespace MLBerkshire\Templates;

/**
 * Remove categories section.
 */
add_filter( 'mlwoo_home_display_categories', '__return_false' );

/**
 * Register nav menu
 */
add_action( 'after_setup_theme', '\MLBerkshire\Templates\register_menu' );
function register_menu() {
	register_nav_menus( array(
		'ml_berkshire_home_menu' => __( 'Berkshire App Homepage Categories' ),
	) );
}

/**
 * Load categories from WordPress menu.
 */
add_action( 'mlwoo_home_replace_categories', '\MLBerkshire\Templates\render_categories' );
function render_categories() {
	$menu_items = get_nav_menu_items_by_location( 'ml_berkshire_home_menu' );
	$categories = get_categories_from_menu( $menu_items );

	?>
	<h2 class="mlwoo__grid--title">
		<span><?php esc_html_e( 'Categories', 'mlwoo' ); ?></span>
	</h2>
	<div class="mlwoo__grid mlwoo__grid--category">
		<?php foreach ( $categories as $category ) : ?>
			<a href="" onclick="nativeFunctions.handleLink( '<?php echo esc_url( sprintf( MLWOO_ENDPOINT . '/product-category/%s', $category->term_id ) ); ?>', '<?php echo $category->name; ?>', 'native' )" class="mlwoo__grid-item--square">
				<div class="mlwoo__grid-item__wrapper">
					<div class="mlwoo__grid-item__wrapper-inner" style="background-image: url( <?php echo esc_url( $category->image_url ); ?> )">
						<div class="mlwoo__grid-item-title mlwoo__grid-item-title--category">
							<?php echo esc_html( $category->name ); ?>
						</div>
					</div>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
}

function get_categories_from_menu( $menu_items = array() ) {
	$categories = array();

	if ( ! empty( $menu_items ) && is_array( $menu_items ) ) {
		foreach ( $menu_items as $index => $menu_item ) {
			$term = get_term_by( 'id', (int)$menu_item->object_id, 'product_cat' );
			$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
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