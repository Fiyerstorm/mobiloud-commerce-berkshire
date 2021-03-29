const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

module.exports = {
	entry: {
		'checkout': [ './src/js/checkout.js', './src/scss/checkout.scss' ],
		'account': [ './src/js/account.js', './src/scss/account.scss' ],
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
