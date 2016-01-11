<?php
/**
 * theme__section() function
 */

/**
 * A drop-in replacement for WordPress' get_header(), get_footer(), & get_sidebar()
 * 
 * NOTE: This is largely copied from the WordPress 4.2.2 core
 * 
 * Improvements:
 *   - Function variables do not interfere with included file
 *   - Returns the the return value of the file
 *   - Better Debugging
 *   - Supports overrides via template_use_part()
 *   - Also checks content directory
 * 
 * @see https://codex.wordpress.org/Function_Reference/get_footer
 * @param string      $section The name of the section to load
 * @param string|null $name    The name of the specialized template.
 * @return mixed               The returned value of the file on success, NULL otherwise
 */
function theme__section($section, $name = NULL) {
	global $debug, $theme;
	$action = 'get_'.$section;
	$debug->runtime_checkpoint('[Theme] Action: '.$action);
	
	do_action($action, $name);
	
	$locations = array();
	$name      = (string) $name;
	if (!empty($name)) {
		$locations[] = sprintf('%1$s-%2$s', $theme->content_sub_path, $section, $name);
		$locations[] = sprintf('%1$s/%2$s-%3$s', $theme->content_sub_path, $section, $name);
	}
	$locations[] = $section;
	$locations[] = $theme->content_sub_path.'/'.$section;
	
	foreach ($locations as $loc) {
		if (template_part__locate($loc.'.php')) {
			return template_part($loc, $name);
		}
	}
	$debug->runtime_checkpoint('[Theme] Failed Action: '.$action);
	return NULL;
}
