	jQuery(function() {

		var body = document.body,
		timer;

		window.addEventListener('scroll', function() {
			clearTimeout(timer);
			if(!body.classList.contains('disable-hover')) {
				body.classList.add('disable-hover')
			}
			timer = setTimeout(function(){
				body.classList.remove('disable-hover')
			},100);
		}, false);

		setTimeout(function(){$("#body").removeClass('hide');}, 200);
		setTimeout(function(){$("#loader").removeClass('active');}, 200);

		$(window).on('beforeunload ', function(e) {
			$("#loader").addClass('active');
		});
		
	});