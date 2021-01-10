import { tns } from '../../node_modules/tiny-slider/src/tiny-slider';
import '../../node_modules/tiny-slider/src/tiny-slider.scss';

tns( {
	container: '.mlwoo--single-product__slider',
	items: 1,
	slideBy: 1,
	autoplay: false,
	mouseDrag: true,
	controls: false,
	navContainer: '#mlwoo--single-product__thumbnail-nav',
	navAsThumbnails: true,
} );

( function( $ ) {
	let quantity = Number( $( '#mlwoo--single-product__quantity-input' ).val() );
	const controlBoard = $( '.mlwoo--single-product__add-to-cart-form' );
	const addToCartBtn = $( '#mlwoo--single-product__add-to-cart-button' );
	const addToCartBtnText = $( '.mlwoo--single-product__add-to-cart-text' );
	const addToCartSpinner = $( '.mlwoo--single-product__add-to-cart-spinner' );
	const quantityChangeBtn = $( '.mlwoo--single-product__quantity-input-control--increase, .mlwoo--single-product__quantity-input-control--decrease' );
	const pill = $( '.mlwoo__pill' );

	addToCartBtn.on( 'click', addToCartHandler );
	quantityChangeBtn.on( 'click', setQuantity )

	function addToCartHandler() {
		const productId = addToCartBtn.data( 'product-id' );

		$.ajax( {
			url: mlwoo.ajaxUrl,
			type: 'POST',
			data: {
				action: 'mlwoo_add_to_cart',
				product_id: productId,
				quantity
			},
			beforeSend: function() {
				controlBoard.addClass( 'mlwoo__pointer--disable' );
				addToCartBtnText.hide();
				addToCartSpinner.show();
			},
		} ).done( function( response ) {
			if ( ! response.success ) {
				return;
			}

			controlBoard.removeClass( 'mlwoo__pointer--disable' );
			addToCartBtnText.show();
			addToCartSpinner.hide();
			pillAnimate();
		} );
	}

	function setQuantity( e ) {
		const action = $( this ).data( 'quantity-action' );
		const quantityIpField = $( '#mlwoo--single-product__quantity-input' );

		switch ( action ) {
			case 'increase':
				quantity = quantity + 1;
				quantityIpField.val( quantity );
				break;

			case 'decrease':
				if ( 1 === quantity ) {
					return;
				}

				quantity = quantity - 1;
				quantityIpField.val( quantity );
				break;

			default:
				break;
		}
	}

	function pillAnimate() {
		pill.addClass( 'mlwoo__pill--slide-in' );

		setTimeout( function() {
			pill.removeClass( 'mlwoo__pill--slide-in' );
		}, 1800 );
	}
} )( jQuery )
