<?php
/**
 * Chooses the template to display
 */

if (is_404()) {
	// There was an error with the request, display the 404 message instead of the normal loop
	template_use_part($theme->content_sub_path.'/loop', $theme->content_sub_path.'/404');
	template_part($theme->template_sub_path.'/default', 'page');
} elseif (is_front_page() || is_home()) {
	// This the home page, which is typically designed differently from the rest of the site
	template_part($theme->template_sub_path.'/home');
} else {
	// None of the above, give them the default template for the type of page they are requesting
	template_part($theme->template_sub_path.'/default', $theme->post_type);
}
