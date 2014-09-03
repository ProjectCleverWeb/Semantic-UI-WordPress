// By default, jQuery in the WordPress dashboard runs in "safe mode" which means
// the '$' shortcut is not available. Since these scripts are only run in the
// dashboard, any tracking should be disabled/removed.

function theme_options_display(name, is_default) {
	is_default = typeof is_default !== 'undefined' ? is_default : false;
	if (is_default) {
		sections = jQuery('.theme-options-section');
		the_default = jQuery('#theme-options-' + name);
		if (the_default.length) {
			jQuery('#theme-options-menu').css('display', 'block');
			jQuery('h3.section-header').css('display', 'none');
			sections.css('display', 'none');
			the_default.css('display', '');
			jQuery('.theme-options-menu .' + name + '.item').addClass('active');
		} else {
			console.log('theme_options_display() says: ".theme-options-section.' + name + '" does not exist! did nothing...');
		}
		return;
	} else {
		sections = jQuery('.theme-options-section');
	}
	section = jQuery('#theme-options-' + name);
	if (section.length && !jQuery('.theme-options-menu .' + name + '.item.active').length) {
		sections.css('display', 'none');
		section.css('display', '');
		section.transition('fade in');
		jQuery('.theme-options-menu .item').removeClass('active');
		jQuery('.theme-options-menu .' + name + '.item').addClass('active');
	};
}

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
	
	
	theme_options_display('general', true);
	
	
	// don't show invalid images
	jQuery("img").error(function () { 
		jQuery(this).css({visibility:"hidden"}); // reserve area if dimensions are set
		// jQuery(this).css({display:"none"}); // never reserve area
	});
	
	// Syntax Highlighter
	hljs.configure({tabReplace: '\t'}); // Tab size can be controlled in most browsers
	jQuery('pre code').each(function(i, e) {hljs.highlightBlock(e)});
});