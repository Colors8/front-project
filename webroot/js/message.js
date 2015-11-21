jQuery(function() {
	$(".message").delay( 8000 ).fadeOut( 2000 );

	$(document).on('click', ".message", function() {
		$(this).hide();
	});
});