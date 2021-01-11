<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
		<?php \MLWoo\Ecommerce\WooCommerce\Endpoints\Base::load_css(); ?>
		<?php wp_head(); ?>
	</head>
	<body>
		<?php
			$cat_id   = (int)get_query_var( 'product_cat' );
			$products = \MLWoo\Ecommerce\WooCommerce\Endpoints\Product_Category::get_product_by_category( $cat_id );
			$cat_meta = \MLWoo\Ecommerce\WooCommerce\Endpoints\Product_Category::get_category_meta_by_id( $cat_id );
			$term_childrern = get_term_children( $cat_id, 'product_cat' );

			$term = get_term_by( 'id', $cat_id, 'product_cat' );
			$term_meta = get_term_meta( $cat_id, 'cat_meta', true );
			$image_id = get_term_meta( $cat_id, 'thumbnail_id', true );
			$desc = isset( $term_meta['cat_header'] ) ? wp_strip_all_tags( do_shortcode( $term_meta['cat_header'] ) ) : '';
			$desc = wp_strip_all_tags( strip_shortcodes( $desc ) );
			$image_url = '';

			if ( ! empty( $image_id ) ) {
				$image_url = wp_get_attachment_url( (int)$image_id );
			}
		?>
		<div class="mlwoo mlwoo--product-category">

			<!-- Category meta -->
			<div class="mlwoo--product-category__bg" style="background-image: url( <?php echo esc_url( $cat_meta['image_url'] ) ?> )">
				<div class="mlwoo--product-category__meta">
					<div class="mlwoo--product-category__title">
						<?php echo esc_html( $cat_meta['name'] ); ?>
					</div>
					<div class="mlwoo--product-category__description">
						<?php echo wp_kses_post( $desc ); ?>
					</div>
				</div>
			</div>

			<div class="mlwoo--product-category__read-more-wrapper">
				<div class="mlwoo--product-category__read-more-btn"><?php echo esc_html( 'Read more', 'mlwoo' ); ?></div>
				<div class="mlwoo--product-category__read-more-desc">
					<?php echo do_shortcode( $cat_meta['description'] ); ?>
				</div>
			</div>
			<!-- Category meta. -->

			<!-- Products -->
			<?php if ( empty( $term_childrern ) ) : ?>
				<div class="mlwoo__grid mlwoo__grid--products">
					<?php foreach ( $products['posts'] as $post ) : ?>
						<a href="#" onclick="nativeFunctions.handleLink( '<?php echo esc_url( sprintf( MLWOO_ENDPOINT . '?product_id=%s', $post['id'] ) ); ?>', '<?php echo $post['title']; ?>', 'native' )" class="mlwoo__grid-item--normal">
							<div class="mlwoo__grid-item__wrapper">
								<div class="mlwoo__grid-item__wrapper-inner">
									<img class="mlwoo__grid-item-image" src="<?php echo esc_url( $post['image_url'] ); ?>" />
									<div class="mlwoo__grid-item-meta">
										<div class="mlwoo__grid-item__category"><?php echo esc_html( $post['category'] ); ?></div>
										<div class="mlwoo__grid-item__title"><?php echo esc_html( $post['title'] ); ?></div>
										<div class="mlwoo__grid-item__price"><?php echo wp_kses_post( $post['price'] ); ?></div>
									</div>
								</div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<?php $categories = MLBerkshire\App\get_formatted_categories( $term_childrern ); ?>
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
			<?php endif ;?>
			<!-- Products. -->

		</div>
		<?php \MLWoo\Ecommerce\WooCommerce\Endpoints\Base::load_js(); ?>
		<?php wp_footer(); ?>
	</body>
</html>