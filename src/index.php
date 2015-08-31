<?php
/**
 * Chooses the template to display
 */

if ($theme->get_option('first_run')) {
	template_part($theme->template_sub_path.'/first-run');
} elseif (is_404()) {
	template_use_part($theme->content_sub_path.'/loop', $theme->content_sub_path.'/404');
	template_part($theme->template_sub_path.'/default', 'page');
} elseif (is_front_page() || is_home()) {
	template_part($theme->template_sub_path.'/home');
} else {
	template_part($theme->template_sub_path.'/default', $theme->post_type);
}
