
$('.menu-btnn').on('click', function() {

		var elem = $(this),
		    item = $('.menu__item'),
		    active = 'is-active',
		    play = 'menu__item--play';

		if (  elem.hasClass(active) ) {
			elem.removeClass(active);
			$(item.get().reverse()).each(function(i) {
				var row = $(this);
					setTimeout(function() {
						row.removeClass(play);
				}, 50*i);
			});
		}

		else {
			elem.addClass(active);
			item.each(function(i) {
				var row = $(this);
					setTimeout(function() {
						row.addClass(play);
				}, 50*i);
			});
		}

	});
$(function() {
  $("#toggle").click(function() {
    var container = $("#toggle-contain");
    if (container.hasClass("cards-contain")) {
      container.removeClass("cards-contain");
      container.addClass("s6");
      container.removeClass("s12");
    } else {
      container.addClass("cards-container");
      container.removeClass("s6");
      container.addClass("s12");
    }
  });
});