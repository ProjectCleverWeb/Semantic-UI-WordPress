<?php
/**
 * Chooses the template to display
 *
 * @package Semanitic UI for WordPress
 */

if (theme::get_option('first_run')) {
	theme::part('template', 'template', 'first-run');
} elseif (is_front_page() || is_home()) {
	theme::part('template', 'template', 'home');
} else {
	theme::part('template', 'template', 'default');
}