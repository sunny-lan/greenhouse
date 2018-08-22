$(function () {
	var windJ = $(window);

	var background = $('.interactive-map .interactive-map-inside .background');
	var interactiveMapInside = $('.interactive-map .interactive-map-inside');
	var interactiveMap = $('.interactive-map');
	var navbar = $('#navbar');
	var zoomControl = $('.interactive-map .zoom .zoom-control');

	function rescale() {
		var width = interactiveMap.width(),
			height = interactiveMap.height();
		var preScale = Math.min(width / interactiveMapInside.width(), height / interactiveMapInside.height());
		interactiveMapInside.css({transform: 'scale(' + preScale * zoomControl.val() + ')'});
	}

	windJ.resize(rescale);
	windJ.on('load', function () {
		interactiveMapInside.css({width: background.width(), height: background.height()});
		rescale();
		interactiveMapInside.css({opacity: 1});
		$('.loading').css({opacity: 0});
	});
	zoomControl.on('input', rescale);

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
		var id = 'popup-' + box.attr('id');
		popupLink.click(function () {
			location.hash = id;
		});
	});
});