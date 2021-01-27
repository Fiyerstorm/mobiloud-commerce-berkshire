( function( $ ) {
	const placeOrderBtn = $( 'button[name="mlwoo_checkout_place_order"]' );
	const placeOrderBtnText = $( '.mlwoo--place-order-text' );
	const placeOrderBtnSpinner = $( '.mlwoo--place-order-spinner' );
	const checkout_form = $( 'form.checkout' );

	$( document.body ).on( 'checkout_error', function() {
		placeOrderBtnSpinner.hide();
		placeOrderBtnSpinner.show();
	} );

	checkout_form.on( 'checkout_place_order_success', function() {
		if ( 'undefined' !== typeof nativeFunctions ) {
			nativeFunctions.syncCart( Number( mlwoo.cartCount ) );
		}
	} );

	$( document ).on( 'click', 'button[name="mlwoo_checkout_place_order"]', function() {
		$.ajax( {
			type: 'POST',
			url: wc_checkout_params.checkout_url,
			data: checkout_form.serialize(),
			dataType: 'json',
			beforeSend: function() {
				$( '.mlwoo--place-order-text' ).hide();
				$( '.mlwoo--place-order-spinner' ).show();
			}
		} ).done( function( response ) {
			if ( ! response.success ) {
				return;
			}

			$( '.mlwoo--place-order-text' ).show();
			$( '.mlwoo--place-order-spinner' ).hide();

			nativeFunctions.handleLink( response.data.redirectUrl, 'Thank You', 'native' );
		} );
	} );
} )( jQuery )
