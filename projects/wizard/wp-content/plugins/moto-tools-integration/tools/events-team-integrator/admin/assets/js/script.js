jQuery( document ).ready( function( $ ) {

	$mebmersSelect = $( '#mti-mebmers-select' );

	if ( ! $.isFunction( jQuery.fn.select2 ) || ! $mebmersSelect.length ) {
		return !1;
	}

	$mebmersSelect.select2();

} )
