<?php
/**
 * template_use_part() function
 */

/**
 * This allows you to replace anything that hasn't been fetched by template_part()
 * yet, and you know the $slug to.
 * 
 * @see https://codex.wordpress.org/Function_Reference/get_template_part
 * @param string|null $slug        The slug name to replace for the generic template.
 * @param string      $replacement The slug name of the replacement for the generic template.
 * @param string      $name        The name of the specialized template.
 * @return mixed                   TRUE if the part was successfully added, FALSE otherwise
 */
function template_use_part($slug, $replacement, $name = NULL) {
	global $theme;
	$action = str_replace('\\','/','get_template_part_'.$slug);
	
	$templates = array();
	$name      = (string) $name;
	if (!empty($name)) {
		$templates[] = $replacement.'-'.$name.'.php';
	}
	$templates[] = $replacement.'.php';
	
	$located = template_part__locate($templates);
	if (!empty($located)) {
		return $theme->use_part($action, $located, TRUE);
	}
	return FALSE;
}
