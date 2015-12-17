<?php
/**
 * template_part__load() function
 */

/**
 * A drop-in replacement for WordPress' load_template()
 * 
 * Improvements:
 *   - Function variables do not interfere with included file
 *   - Returns the the return value of the file
 *   - Better Debugging
 *   - Supports overrides via template_use_part()
 * 
 * @see https://codex.wordpress.org/Function_Reference/load_template
 * @param string  $template_file Path to template file.
 * @param bool    $require_once  Whether to require_once or require. Default true.
 * @param  string $identifier    The slug/action identifier to load
 * @return mixed                 The returned value of the loaded file
 */
function template_part__load($template_file, $require_once = TRUE, $identifier = '') {
	global $theme, $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
	
	$query_vars = array();
	if (is_array($wp_query->query_vars)) {
		$query_vars = $wp_query->query_vars;
	}
	$vars = array(
		'posts'         => $posts,
		'post'          => $post,
		'wp_did_header' => $wp_did_header,
		'wp_query'      => $wp_query,
		'wp_rewrite'    => $wp_rewrite,
		'wpdb'          => $wpdb,
		'wp_version'    => $wp_version,
		'wp'            => $wp,
		'id'            => $id,
		'comment'       => $comment,
		'user_ID'       => $user_ID
	) + $query_vars;
	
	if (!empty($identifier)) {
		return $theme->part($identifier, $template_file, TRUE, $require_once, $vars);
	} elseif ($require_once) {
		return $theme->req_once($template_file, TRUE, $vars);
	} else {
		return $theme->req($template_file, TRUE, $vars);
	}
}
