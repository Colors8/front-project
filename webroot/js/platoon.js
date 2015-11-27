	jQuery(function() {
		var platoonMarker = 2;
		var ableScroll = false;

		platoonAction(platoonMarker);
		function platoonAction(current) {
			if (platoonMarker < 1) {
				platoonMarker = $(".platoon-slide").length;
				current = $(".platoon-slide").length;
			}
			if (current > $(".platoon-slide").length) {
				platoonMarker = 1;
				current = 1;
			}

			$(".platoon-slide").removeClass("platoon-before3 platoon-before2 platoon-before1 platoon-current platoon-after1 platoon-after2 platoon-after3");
			$(".platoon-slide:nth-child("+current+")").addClass("platoon-current");
			$(".platoon-slide:nth-child("+current+")").prev(".platoon-slide").addClass("platoon-before1");
			$(".platoon-slide:nth-child("+current+")").prev(".platoon-slide").prev(".platoon-slide").addClass("platoon-before2");
			$(".platoon-slide:nth-child("+current+")").next(".platoon-slide").addClass("platoon-after1");
			$(".platoon-slide:nth-child("+current+")").next(".platoon-slide").next(".platoon-slide").addClass("platoon-after2");
			if ((current-3) > 0) {
				for (i = (current-3); i > 0; --i) {	
					$(".platoon-slide:nth-child("+i+")").addClass("platoon-before3");
				}
			}
			var total = $(".platoon-slide").length+1;
			if ((total-3) > 0) {
				for (i = (current+3); i < total; ++i) {
					$(".platoon-slide:nth-child("+i+")").addClass("platoon-after3");
				}
			}
		}

		$("#platoon-slider").on({
			mouseenter: function () {
				ableScroll = true;
			},
			mouseleave: function () {
				ableScroll = false;
			}
		});

		$(document).on('click', "#platoon-slider-left", function() {
			platoonMarker--;
			platoonAction(platoonMarker);
		});
		$(document).on('click', "#platoon-slider-right", function() {
			platoonMarker++;
			platoonAction(platoonMarker);
		});

		$(document).keydown(function(e) {
			if (ableScroll == true) {
				switch(e.which) {
					case 37: platoonMarker--// left
					break;

					case 38: platoonMarker--// up
					break;

					case 39: platoonMarker++// right
					break;

					case 40: platoonMarker++// down
					break;

					default: return;
				}
				platoonAction(platoonMarker);
				e.preventDefault();
			}
		});
	});