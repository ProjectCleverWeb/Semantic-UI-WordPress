$(document).ready(function() {
	// Semantic UI inits
	$('.ui.accordion').accordion();
	$('.ui.dropdown').dropdown();
	$('.ui.hover.dropdown').dropdown({
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
	$('pre code').each(function(i, e) {hljs.highlightBlock(e)});
});
