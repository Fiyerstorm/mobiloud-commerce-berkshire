const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

module.exports = {
	entry: {
		'single-product': [ './src/scss/single-product.scss' ],
		'cart': [ './src/scss/cart.scss' ],
		'checkout': [ './src/scss/checkout.scss' ],
		'account': [ './src/scss/account.scss' ],
		'account-orders': [ './src/scss/orders.scss' ],
		'thank-you': [ './src/scss/thank-you.scss' ],
		'account-view-order': [ './src/scss/view-order.scss' ],
		// 'view-order': [ './src/scss/view-order.scss' ],
		'account-edit-address': [ './src/scss/edit-address.scss' ],
		'home': [ './src/scss/home.scss' ],
		// 'single-post': [ './src/scss/single-post.scss' ],
		'single-post': [ './src/scss/single-post.scss' ],
		'product-categories': [ './src/js/product-categories.js', './src/scss/product-categories.scss' ],
		'product-category': [ './src/js/product-category.js', './src/scss/product-category.scss' ],
	},
	output: {
		path: path.resolve( __dirname, 'dist' ),
		filename: 'js/[name].bundle.js'
	},
	module: {
		rules: [
			{
				test: /\.s[ac]ss$/i,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'sass-loader',
				],
			},
			{
				test: /\.(png|jpe?g|gif|svg)$/i,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: 'images/[name].[ext]',
						},
					},
				],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin( {
			filename: 'css/[name].css',
		} )
	],
};
