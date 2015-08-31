<?php
/**
 * A drop-in replacement for WordPress' get_sidebar()
 * 
 * NOTE: This is largely copied from the WordPress 4.2.2 core
 * 
 * Improvements:
 *   - All global variables are available (not just WordPress globals)
 *   - Function variables do not interfere with included file
 *   - wp_query vars override existing global vars (temporary)
 *   - Returns the the return value of the file
 *   - Better Debugging
 *   - Support overrides via template_use_part()
 * 
 * @see https://codex.wordpress.org/Function_Reference/get_sidebar
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialized template.
 * @return mixed       The returned value of the file on success, NULL otherwise
 */
function theme_sidebar($name = NULL) {
	global $debug, $theme;
	$action = "get_sidebar";
	$debug->runtime_checkpoint('[Theme] Action: '.$action);
	
	do_action($action, $name);
	
	return template_part($theme->content_sub_path.DIRECTORY_SEPARATOR.'sidebar', $name);
}
