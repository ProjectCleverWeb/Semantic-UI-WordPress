<?php
/**
 * template_part() function
 */

/**
 * A drop-in replacement for WordPress' get_template_part()
 * 
 * NOTE: This is largely copied from the WordPress 4.2.2 core
 * 
 * Improvements:
 *   - Function variables do not interfere with included file
 *   - Returns the the return value of the file
 *   - Better Debugging
 *   - Supports overrides via template_use_part()
 * 
 * @see https://codex.wordpress.org/Function_Reference/get_template_part
 * @param string      $slug The slug name for the generic template.
 * @param string|null $name The name of the specialized template.
 * @return mixed            The returned value of the file on success, NULL otherwise
 */
function template_part($slug, $name = NULL) {
	global $debug;
	$action = str_replace('\\', '/', 'get_template_part_'.$slug);
	$debug->runtime_checkpoint('[Theme] Action: '.$action);
	
	do_action($action, $slug, $name);
	
	$templates = array();
	$name      = (string) $name;
	if ('' !== $name) {
		$templates[] = $slug.'-'.$name.'.php';
	}
	$templates[] = $slug.'.php';
	
	$located = template_part__locate($templates);
	if ($located) {
		return template_part__load($located, FALSE, $action);
	}
	$debug->runtime_checkpoint('[Theme] Failed Action: '.$action);
	return NULL;
}
