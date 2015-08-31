<?php
/**
 * A drop-in replacement for WordPress' load_template()
 * 
 * Improvements:
 *   - All global variables are available (not just WordPress globals)
 *   - Function variables do not interfere with included file
 *   - wp_query vars override existing global vars (temporary)
 *   - Returns the the return value of the file
 *   - Better Debugging
 *   - Supports overrides via template_use_part()
 * 
 * @see https://codex.wordpress.org/Function_Reference/load_template
 * @param string $template_file Path to template file.
 * @param bool   $require_once  Whether to require_once or require. Default true.
 */
function template_part__load($template_file, $require_once = TRUE, $id = '') {
	global $theme, $wp_query;
	if (!empty($id)) {
		return $theme->part($id, $template_file, TRUE, $require_once, $wp_query->query_vars);
	} elseif ($require_once) {
		return $theme->req_once($template_file, TRUE, $wp_query->query_vars);
	} else {
		return $theme->req($template_file, TRUE, $wp_query->query_vars);
	}
}
