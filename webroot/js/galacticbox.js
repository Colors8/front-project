jQuery(function() {
	$(document).on('click', ".galacticbox_trigger", function () {
		$( "#galacticbox" ).addClass("active");
		//$('body').css("overflow","hidden");

		var attr = $(this).attr('data-galacticbox-image');
		var attr2 = $(this).attr('data-galacticbox-iframe');
		var attr3 = $(this).attr('data-galacticbox-video');
		var attr4 = $(this).attr('data-galacticbox-text');

		if (typeof attr !== typeof undefined && attr !== false) {
			$( "#galacticbox-content" ).html('<img src="' + $( this ).attr("data-galacticbox-image") + '" alt="Image" />');
		} else if (typeof attr2 !== typeof undefined && attr2 !== false) {
			$( "#galacticbox-content" ).html('<iframe frameborder="0" src="' + $( this ).attr("data-galacticbox-iframe") + '"></iframe>');
		} else if (typeof attr3 !== typeof undefined && attr3 !== false) {
			$( "#galacticbox-content" ).html('<video controls><source src="' + $( this ).attr("data-galacticbox-video") + '" type="video/mp4">Your browser does not support the video tag.</video>');
		} else if (typeof attr4 !== typeof undefined && attr4 !== false) {
			$( "#galacticbox-content" ).append('<div id="galacticbox-text">' + $( this ).attr("data-galacticbox-text") + '</div>');
		}
	});

	$( document ).on('click', '#galacticbox-close', galacticHide);
	$( document ).on('click', '#galacticbox-mask', galacticHide);

	function galacticHide() {
		//$('body').css("overflow","auto");
		$( "#galacticbox" ).removeClass("active");
		$( "#galacticbox-content" ).empty();
	}
});