<?php
/**
 * Chooses the template to display
 */

if (theme::get_option('first_run')) {
	theme::part('template', 'template', 'first-run');
} elseif (is_front_page() || is_home()) {
	theme::part('template', 'template', 'home');
} else {
	theme::part('template', 'template', 'default');
}
