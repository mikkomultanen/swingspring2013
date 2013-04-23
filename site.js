$(function() {
    fixEmailLinks();

    var History = window.History;
    if($.browser.msie || !History.enabled) return false;

	var $menuLinks = $("#menu a");
	$menuLinks.on('click', function(event) {
		event.preventDefault();
		History.pushState({}, "Swing Spring 2013", $(this).attr('href'));
	});

	var firstLinkParams = getParams($menuLinks.first().attr('href'))

    History.Adapter.bind(window,'statechange',function(){
		var params = getParams(History.getState().url);
		var pageId = params.pageId || firstLinkParams.pageId;
		var language = params.language || firstLinkParams.language;
		var page = language + "_" + pageId + ".html?" + Math.floor(new Date().getTime()/(60*60*1000));
		$menuLinks.removeClass('active');
		$menuLinks.filter('[href*="pageId=' + pageId + '"]').addClass('active');
		$("#page").load(page, function() {
			fixEmailLinks();
			refreshLanguageLinks(pageId);
			$('html, body').animate({
				scrollTop: $("#menu").offset().top
			}, 500);
		});
    });
});
function getParams(url) {
    var params = {}, hash;
    var hashes = url.slice(url.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        params[hash[0]] = hash[1];
    }
    return params;
}
function fixEmailLinks() {
	$('.email').replaceWith(function() {
		var data = $.map($(this).attr('data').split(','), function(c, i) {return String.fromCharCode(c-i); });
		return ['<a href=\"mailto:'].concat(data, ['\">'], data, ['</a>']).join('');
	});
}
function refreshLanguageLinks(pageId) {
	$('#languages a').each(function() {
		var $this = $(this);
		var language = getParams($this.attr('href')).language;
		$this.attr('href', 'index.php?pageId=' + pageId + "&language=" + language);
	});
}