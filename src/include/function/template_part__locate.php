<?php
/**
 * template_part__locate() function
 */

/**
 * A drop-in replacement for WordPress' locate_template()
 * 
 * NOTE: This is almost entirely copied from the WordPress 4.2.2 core
 * 
 * Improvements:
 *   - Function variables do not interfere with included file
 *   - Uses is_file() instead of file_exists()
 *   - Better Debugging
 * 
 * @see https://codex.wordpress.org/Function_Reference/locate_template
 * @param  string|array $template_names Template file(s) to search for, in order.
 * @param  bool         $load If true the template file will be loaded if it is found.
 * @param  bool         $require_once Whether to require_once or require. Default true. Has no effect if $load is false.
 * @return string The   template filename if one is located.
 */
function template_part__locate($template_names, $load = FALSE, $require_once = TRUE) {
	$located = '';
	foreach ((array) $template_names as $template_name) {
		if (!$template_name) {
			continue;
		}
		if (is_file(get_stylesheet_directory().'/'.$template_name)) {
			$located = get_stylesheet_directory().'/'.$template_name;
			break;
		} elseif (is_file(get_template_directory().'/'.$template_name)) {
			$located = get_template_directory().'/'.$template_name;
			break;
		}
	}
	
	if ($load && '' != $located) {
		template_part__load($located, $require_once);
	}
	
	return $located;
}
