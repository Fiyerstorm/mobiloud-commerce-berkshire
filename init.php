<?php
/**
 * App
 */
require_once 'app/assets.php';
require_once 'app/hooks.php';
require_once 'app/product-category.php';
require_once 'app/product-categories.php';
require_once 'app/single-product.php';
require_once 'app/home.php';
require_once 'app/cart.php';

function mlberk_ext_mobiloud_templates_paths( $paths_array ) {
	array_unshift( $paths_array, MLBERK_PATH . 'templates' );
	return $paths_array;
}
add_filter( 'mobiloud_templates_paths', 'mlberk_ext_mobiloud_templates_paths' );

function mlberk_post_stylesheets() {
	?>
	<link rel="stylesheet" href="<?php echo esc_url( MLBERK_URL . 'dist/css/single-post.css' ); ?>">
	<?php
}
add_action( 'ml_post_remove_all_actions', 'mlberk_post_stylesheets', 100 );
