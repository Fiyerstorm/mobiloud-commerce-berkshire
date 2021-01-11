( function( $ ) {
	let toggleDesc = false;

	const readMoreBtn = $( '.mlwoo--product-category__read-more-btn' );
	const desc = $( '.mlwoo--product-category__read-more-desc' );
	const grid = $( '.mlwoo__grid--category' );

	readMoreBtn.on( 'click', function() {
		if ( ! toggleDesc ) {
			grid.css( 'transform', `translate( 0, ${ desc.outerHeight() }px )` );
			setTimeout( function() {
				desc.css( 'opacity', '1' );
			}, 150 );
		} else {
			grid.css( 'transform', `translate( 0, 0px )` );
			desc.css( 'opacity', '0' );
		}

		toggleDesc = ! toggleDesc;
	} );
} )( jQuery )