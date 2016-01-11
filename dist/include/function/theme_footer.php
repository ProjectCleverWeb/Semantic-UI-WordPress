<?php
/**
 * theme_footer() function
 */

/**
 * A drop-in replacement for WordPress' get_footer()
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
 * @param string|null $name The name of the specialized template.
 * @return mixed            The returned value of the file on success, NULL otherwise
 */
function theme_footer($name = NULL) {
	theme__section('footer', $name);
}
