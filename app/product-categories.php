<?php
namespace MLBerkshire\App;

add_filter( 'mlwoo_template_product_categories', function( $template ) {
	return MLBERK_PATH . 'templates/product-categories.php';
} );

add_filter( 'mlwoo_get_categories_for_loop', '__return_false' );

add_action( 'mlwoo_get_categories_after_for_loop', function( $categories ) {
	foreach ( $categories as $category ) : ?>
		<a onclick="nativeFunctions.handleLink( '<?php echo esc_url( sprintf( MLWOO_ENDPOINT . '/product-category/%s', $category->term_id ) ); ?>', '<?php echo $category->name; ?>', 'native' )" class="mlwoo__grid-item--square">
			<div class="mlwoo__grid-item__wrapper">
				<div class="mlwoo__grid-item__wrapper-inner" style="background-image: url( <?php echo esc_url( $category->image_url ); ?> )">
					<div class="mlwoo__grid-item-title mlwoo__grid-item-title--category">
						<?php echo esc_html( $category->name ); ?>
						<div class="mlwoo__grid-item--product-count">
							<?php printf( '%s %s', esc_html( $category->count ), esc_html__( 'products', 'mlberk' ) ) ?>
						</div>
					</div>
				</div>
			</div>
		</a>
	<?php endforeach;
} );