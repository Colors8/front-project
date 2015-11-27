	jQuery(function() {
		$(document).on('click', "#site-header--account-inner", function () {
			if ( $("#site-header--account-content").hasClass('active') ) {
				$("#site-header--account-content").removeClass('active');
				$("#site-header--account-inner").removeClass('active');
			} else {
				$("#site-header--account-content").addClass('active');
				$("#site-header--account-inner").addClass('active');
			}
		});
	});