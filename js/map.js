var windJ = $(window);
$(function () {
	var background = $('.interactive-map .interactive-map-inside .background');
	var interactiveMapInside = $('.interactive-map .interactive-map-inside');
	var interactiveMap = $('.interactive-map');
	var navbar = $('#navbar');
	var zoomControl = $('.interactive-map .zoom .zoom-control');

	function rearrange() {
		interactiveMap.css({height: windJ.height() - navbar.height() - 20});
	}

	rearrange();

	function rescale() {
		var width = interactiveMap.width(),
			height = windJ.height() - navbar.height() - 20;
		var preScale = Math.min(width / interactiveMapInside.width(), height / interactiveMapInside.height());
		interactiveMapInside.css({transform: 'scale(' + preScale * zoomControl.val() + ')'});
	}

	windJ.resize(function () {
		rearrange();
		rescale();
	});
	windJ.on('load', function () {
		interactiveMapInside.css({width: background.width(), height: background.height()});
		rescale();
		interactiveMapInside.css({opacity: 1});
		$('.loading').css({opacity: 0});
		handleHash();
	});
	zoomControl.on('input', rescale);


	var overlay = $('.overlay');
	var overlayContent = $(overlay.children('.overlay-content')[0]);
	var overlayBg = $(overlay.children('.overlay-background')[0]);
	overlayBg.click(function () {
		location.hash = '';
	});
	function handleHash() {
		var hash = location.hash.slice(1);
		if (hash === '') {
			overlay.removeClass('shown');
		} else {
			var popup = $("#" + hash.slice('popup-'.length) + ' .box-popup');
			overlayContent.html(popup.clone());
			overlay.addClass('shown');
		}
	}

	$(window).on('hashchange', handleHash);

	$('.interactive-map .interactive-map-inside .box').each(function () {
		var box = $(this);
		var rect = JSON.parse(box.attr('data-rect'));
		box.css({
			position: 'absolute',
			top: rect.top,
			left: rect.l,
			width: rect.bottom,
			height: rect.r
		});
		var popupLink = $(box.find('.box-popup-link')[0]);
		var id = 'popup-'+box.attr('id');
		popupLink.click(function () {
			location.hash = id;
		});
	});
});