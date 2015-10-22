<?php
/**
 * Add debug information to WordPress includes
 */
add_filter('template_include', function($template) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Action: Using Template "'.$template.'"');
	return $template;
}, 99);
add_action('wp_head', function() {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Action: Called wp_head()');
}, 0, 0);
add_action('wp_footer', function() {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Action: Called wp_footer()');
}, 0, 0);
add_action('get_header', function() {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Action: Called get_header()');
}, 0, 0);
add_action('get_footer', function() {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Action: Called get_footer()');
}, 0, 0);
add_filter('index_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: index_template');
	return $content;
});
add_filter('404_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: 404_template');
	return $content;
});
add_filter('archive_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: archive_template');
	return $content;
});
add_filter('author_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: author_template');
	return $content;
});
add_filter('category_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: category_template');
	return $content;
});
add_filter('tag_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: tag_template');
	return $content;
});
add_filter('taxonomy_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: taxonomy_template');
	return $content;
});
add_filter('date_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: date_template');
	return $content;
});
add_filter('home_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: home_template');
	return $content;
});
add_filter('front_page_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: front_page_template');
	return $content;
});
add_filter('page_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: page_template');
	return $content;
});
add_filter('paged_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: paged_template');
	return $content;
});
add_filter('search_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: search_template');
	return $content;
});
add_filter('single_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: single_template');
	return $content;
});
add_filter('attachment_template', function($content) {
	global $debug;
	$debug->runtime_checkpoint('[WordPress] Hook: attachment_template');
	return $content;
});
