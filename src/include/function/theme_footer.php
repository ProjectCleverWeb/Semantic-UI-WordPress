<?php
/**
 * A drop-in replacement for WordPress' get_footer()
 * 
 * NOTE: This is largely copied from the WordPress 4.2.2 core
 * 
 * Improvements:
 *   - Function variables do not interfere with included file
 *   - wp_query vars override existing global vars (temporary)
 *   - Returns the the return value of the file
 *   - Better Debugging
 *   - Supports overrides via template_use_part()
 * 
 * @see https://codex.wordpress.org/Function_Reference/get_footer
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialized template.
 * @return mixed       The returned value of the file on success, NULL otherwise
 */
function theme_footer($name = NULL) {
	global $debug, $theme;
	$action = "get_footer";
	$debug->runtime_checkpoint('[Theme] Action: '.$action);
	
	do_action($action, $name);
	
	return template_part($theme->content_sub_path.DIRECTORY_SEPARATOR.'footer', $name);
}
