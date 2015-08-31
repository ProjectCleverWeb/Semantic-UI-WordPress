<?php
/**
 * Chooses the template to display
 */

if ($theme->get_option('first_run')) {
	template_part($theme->template_sub_path.'/first-run');
} elseif (is_front_page() || is_home()) {
	template_part($theme->template_sub_path.'/home');
} else {
	template_part($theme->template_sub_path.'/default', get_post_type());
}
