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
			$categories = \MLWoo\Ecommerce\WooCommerce\Endpoints\Home::get_categories();
			$products   = \MLWoo\Ecommerce\WooCommerce\Endpoints\Home::get_products();
			$lt_posts   = \MLBerkshire\App\get_latest_posts();
		?>

		<div class="mlwoo mlwoo--home">

			<!-- Search field -->
			<div class="mlwoo__search mlwoo__search--product">
				<div class="mlwoo__search-wrapper">
					<input class="mlwoo__input" id="mlwoo__search-input" type="search" placeholder="<?php esc_html_e( 'Search products...' ); ?>" />
					<div class="mlwoo__clear-btn">
						<img src="<?php echo esc_url( MLWOO_URL . 'dist/images/clear.svg' ); ?>" />
					</div>
				</div>
			</div>
			<div id="mlwoo__search-results" class="mlwoo__search-results">
				<div class="mlwoo__grid mlwoo__grid--products"></div>
				<div class="mlwoo__load-more-spinner">
					<img src="<?php echo esc_url( MLWOO_URL . 'dist/images/loading-dark.svg' ); ?>" />
				</div>
			</div>
			<!-- Search field. -->

			<!-- Categories -->
			<?php if ( apply_filters( 'mlwoo_home_display_categories', true ) ) : ?>
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
			<?php endif; ?>

			<!-- Categories. -->

			<!-- Products -->
			<?php if ( apply_filters( 'mlwoo_home_display_products', true ) ) : ?>
				<h2 class="mlwoo__grid--title">
					<span><?php echo apply_filters( 'mlwoo_home_products_grid_title', esc_html__( 'Products', 'mlwoo' ) ); ?></span>
				</h2>
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
			<?php endif; ?>
			<?php do_action( 'mlwoo_home_replace_products' ); ?>
			<!-- Products. -->

			<!-- Latest Posts -->
				<h2 class="mlwoo__grid--title">
					<span><?php echo esc_html__( 'Latest Posts', 'mlwoo' ); ?></span>
				</h2>
				<div class="mlberk__latest-posts-list">
					<?php foreach ( $lt_posts as $key => $post ) : ?>
						<div class="mlberk__latest-posts-item">
							<a class="mlberk__latest-posts-link" href="#" onclick="nativeFunctions.handlePost( <?php echo $post['id']; ?> )">
								<div class="mlberk__latest-posts-thumbnail">
									<?php echo $post['thumbnail']; ?>
								</div>
								<div class="mlberk__latest-posts-category"><?php echo esc_html( $post['category'] ); ?></div>
								<h3 class="mlberk__latest-posts-title"><?php echo esc_html( $post['title'] ); ?></h3>
								<div class="mlberk__latest-posts-description"><?php echo strip_shortcodes( $post['content'] ); ?></div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<!-- Latest Posts. -->

		</div>
		<?php \MLWoo\Ecommerce\WooCommerce\Endpoints\Base::load_js(); ?>
		<footer class="mlwoo__footer">
			<?php wp_footer(); ?>
		</footer>
	</body>
</html>