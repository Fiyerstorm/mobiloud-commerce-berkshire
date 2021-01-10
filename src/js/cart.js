( function( $ ) {
	const applyCouponBtn = $( 'button[name="apply_coupon"]' );
	const applyCouponBtnText = $( '.mlwoo--cart__apply-coupon-text' );
	const applyCouponBtnSpinner = $( '.mlwoo--cart__apply-coupon-spinner' );

	let textCache;
	let htmlCache;

	applyCouponBtn.on( 'click', function() {
		applyCouponBtnText.hide();
		applyCouponBtnSpinner.show();

		textCache = this.childNodes[2].textContent;
		htmlCache = $( this ).children();
	} );

	$( document ).on( 'applied_coupon', function() {
		applyCouponBtn.text( textCache ).append( htmlCache );
	} );
} )( jQuery )
