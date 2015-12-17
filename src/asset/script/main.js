WebFont.load({
	google: {families: [
		'Open+Sans:400,600,700,700italic:latin', // General Text
		'Roboto:400,300,500,700:latin', // Header Text
		'Droid+Sans+Mono::latin' // Monospace Text
	]}
});

$(document).ready(function() {
	// Semantic UI inits
	$('.ui.accordion').accordion();
	$('.ui.dropdown').dropdown({
		on: 'hover'
	});
	$('.ui.checkbox').checkbox();
	$('.ui.modal').modal();
	$('.ui.popup').popup();
	$('.ui.rating').rating();
	$('.shape').shape();
	$('.ui.sidebar').sidebar();
	
	// don't show invalid images
	$("img").error(function () { 
		$(this).css({visibility:"hidden"}); // reserve area if dimensions are set
		// $(this).css({display:"none"}); // never reserve area
	});
	
	// Syntax Highlighter
	hljs.configure({tabReplace: '\t'}); // Tab size can be controlled in most browsers
	$('pre code').each(function(i, e) {
		hljs.highlightBlock(e);
	});
	
	Mousetrap.bind(['ctrl+shift+l'], function(e) {
		$('#semantic-debug-log').modal('show');
		return false;
	});
});
