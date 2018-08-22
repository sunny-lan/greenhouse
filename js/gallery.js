$(function () {
	$("#pictures").find(".picture-tile").each(function () {
		var tile = $(this);
		tile.click(function () {
			location.hash = 'popup-' + tile.attr('id');
		});
	});
});