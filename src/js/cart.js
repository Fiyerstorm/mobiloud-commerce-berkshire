( function( $ ) {
	let htmlCache;
	let bgColor = '';
	let fgColor = '';

	$( document ).on( 'click', 'button[name="apply_coupon"]', function() {
		$( '.mlwoo--cart__apply-coupon-spinner' ).show();
		fgColor = $( this ).css( 'color' );
		bgColor = $( this ).css( 'background-color' );

		$( this ).css( 'color', bgColor );
		htmlCache = $( this ).children();
	} );

	$( document ).on( 'applied_coupon', function() {
		$( 'button[name="apply_coupon"]' ).append( htmlCache );
		$( 'button[name="apply_coupon"]' ).css( 'color', fgColor );
		$( '.mlwoo--cart__apply-coupon-spinner' ).hide();
	} );
} )( jQuery )
