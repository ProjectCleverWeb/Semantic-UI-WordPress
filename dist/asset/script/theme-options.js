// By default, jQuery in the WordPress dashboard runs in "safe mode" which means
// the '$' shortcut is not available. Since these scripts are only run in the
// dashboard, any tracking should be disabled/removed.
jQuery(document).ready(function() {
	// Semantic UI inits
	jQuery('.ui.accordion').accordion();
	jQuery('.ui.dropdown').dropdown();
	jQuery('.ui.hover.dropdown').dropdown({
		on: 'hover'
	});
	jQuery('.ui.checkbox').checkbox();
	jQuery('.ui.modal').modal();
	jQuery('.ui.popup').popup();
	jQuery('.ui.rating').rating();
	jQuery('.shape').shape();
	jQuery('.ui.sidebar').sidebar();
	
	jQuery('.message .close').on('click', function() {
		jQuery(this).closest('.message').fadeOut();
	});
	
	// Disabled until nag is completed
	// jQuery('#issue-tracker-nag').nag('show');
	
	jQuery('#theme-options-tabs .menu .item').tab({
		context: jQuery('#theme-options-tabs')
	});
	
	// don't show invalid images
	jQuery("img").error(function () { 
		jQuery(this).css({visibility:"hidden"}); // reserve area if dimensions are set
		// jQuery(this).css({display:"none"}); // never reserve area
	});
	
	// Syntax Highlighter
	hljs.configure({tabReplace: '\t'}); // Tab size can be controlled in most browsers
	jQuery('pre code').each(function(i, e) {
		hljs.highlightBlock(e);
	});
	
	Mousetrap.bind(['ctrl+shift+l'], function(e) {
		jQuery('#semantic-debug-log').modal('show');
		return false;
	});
});
