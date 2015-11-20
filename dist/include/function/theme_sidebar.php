<?php
/**
 * A drop-in replacement for WordPress' get_sidebar()
 * 
 * NOTE: This is largely copied from the WordPress 4.2.2 core
 * 
 * Improvements:
 *   - Function variables do not interfere with included file
 *   - Returns the the return value of the file
 *   - Better Debugging
 *   - Support overrides via template_use_part()
 *   - Also checks content directory
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
	
	$locations = array();
	$name = (string) $name;
	if (!empty($name)) {
		$locations[] = "sidebar-{$name}";
		$locations[] = $theme->content_sub_path."/sidebar-{$name}";
	}
	$locations[] = "sidebar";
	$locations[] = $theme->content_sub_path."/sidebar";
	
	foreach ($locations as $loc) {
		if (template_part__locate($loc.'.php')) {
			return template_part($loc, $name);
		}
	}
	$debug->runtime_checkpoint('[Theme] Failed Action: '.$action);
	return NULL;
}
