<?php
/**
 * Functions File
 * ==============
 * This is basically WordPress' version of a theme bootstrap file. Keep in mind
 * that this file will be called whenever WordPress is called, and this is the
 * active theme.
 */

/**
 * Simple PSR-4 autoloader for the \semantic namespace
 * 
 * Loads files from `includes/class`
 * 
 * @codeCoverageIgnore
 */
spl_autoload_register(function ($class) {
	$prefix       = 'semantic';
	$include_path = '/include/class';
	$prefix_len   = strlen($prefix);
	if(strncmp($prefix, $class, $prefix_len) !== 0) {
		return;
	}
	
	$search_path = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $prefix_len)).'.php'
	$file_alt    = TEMPLATEPATH.$include_path.$search_path;
	$file        = STYLESHEETPATH.$include_path.$search_path;
	if(is_file($file_alt)) {
		require_once $file_alt;
	} elseif($file != $file_alt && is_file($file)) {
		require_once $file;
	}
});

/*** Set Globals & Run Inits ***/
global $debug, $theme;
$debug  = new \semantic\debug();
$theme  = new \semantic\theme();
// Make them global in WP includes too
set_query_var('theme',  $theme);
set_query_var('debug',  $debug);

/*** Functions (1 per file) ***/
$debug->runtime_checkpoint('[Theme] Begin Including Function Files');
$func_dir = $theme->include_path.'/function';
$func_alt_dir = STYLESHEETPATH.'/'.$theme->include_sub_path.'/function';
foreach (scandir($func_alt_dir) as $function_file) {
	// ignore non-php files, check if the file exists, and that there isn't a function with the same name
	if (substr($function_file, -4) == '.php' && is_file($func_alt_dir.DIRECTORY_SEPARATOR.$function_file) && !function_exists(substr($function_file, 0, -4))) {
		$theme->req_once($func_alt_dir.DIRECTORY_SEPARATOR.$function_file, TRUE);
	}
}
if ($func_dir != $func_alt_dir) {
	foreach (scandir($func_dir) as $function_file) {
		// ignore non-php files, check if the file exists, and that there isn't a function with the same name
		if (substr($function_file, -4) == '.php' && is_file($func_dir.DIRECTORY_SEPARATOR.$function_file) && !function_exists(substr($function_file, -4))) {
			$theme->req_once($func_dir.DIRECTORY_SEPARATOR.$function_file, TRUE);
		}
	}
}
$debug->runtime_checkpoint('[Theme] Finished Including Function Files');

/*** Initialize all the WordPress integrations */
$debug->runtime_checkpoint('[Theme] Begin WordPress Integrations');
$integrations = new \semantic\integrations;
// Alphebetical based on the callback (doesn't effect the order they are called)
add_action('admin_bar_menu',      array($integrations, 'admin_bar_links'), 999);
add_filter('nav_menu_css_class',  array($integrations, 'current_nav'), 10, 1);
add_filter('admin_footer_text',   array($integrations, 'dashboard_footer'));
add_action('init',                array($integrations, 'editor_styles'), 11);
add_action('wp_enqueue_scripts',  array($integrations, 'enqueue'));
add_filter('user_contactmethods', array($integrations, 'google_author'));
add_action('after_setup_theme',   array($integrations, 'init'));
add_action('admin_menu',          array($integrations, 'options'));
add_filter('post_thumbnail_html', array($integrations, 'post_thumbnail'), 10, 3);
add_action('init',                array($integrations, 'register_enqueue'), 10);
add_filter('get_search_form',     array($integrations, 'search_form'));
add_action('widgets_init',        array($integrations, 'widgets_init'));
add_filter('wp_title',            array($integrations, 'wp_title'), 10, 2);
add_action('template_include',    array($integrations, 'set_post_type'));
if ($debug->active) {
	$debug->runtime_checkpoint('[Theme] Adding Debug WordPress Integrations');
	template_part($theme->include_sub_path.'/debug_hooks');
}
$debug->runtime_checkpoint('[Theme] Finished WordPress Integrations');

// Let the debugger know that we finished the functions.php file
$debug->runtime_checkpoint('[Theme] Finished Functions File');
