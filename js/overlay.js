$(function () {
	var windJ = $(window);
	var overlay = $('.overlay');
	var overlayContent = $(overlay.children('.overlay-content')[0]);
	var overlayBg = $(overlay.children('.overlay-background')[0]);
	var body = $(document.body);
	overlayBg.click(function () {
		location.hash = '';
	});
	function checkHash() {
		var hash = location.hash.slice(1);
		if (hash === '') {
			overlay.removeClass('shown');
			body.css({overflow: 'auto'});
		} else {
			overlayContent.html($("#" + hash.slice('popup-'.length) + ' .popup-content').clone());
			overlay.addClass('shown');
			body.css({overflow: 'hidden'});
		}
	}

	windJ.on('hashchange', checkHash);
	windJ.on('load', checkHash);
});