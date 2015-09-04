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
	
	$search_path = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $prefix_len)).'.php';
	$file_alt    = realpath(TEMPLATEPATH.$include_path.$search_path);
	$file        = realpath(STYLESHEETPATH.$include_path.$search_path);
	if($file_alt && is_file($file_alt)) {
		require_once $file_alt;
	} elseif($file && $file != $file_alt && is_file($file)) {
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
$func_dir = realpath($theme->include_path.'/function');
$func_alt_dir = realpath(STYLESHEETPATH.'/'.$theme->include_sub_path.'/function');
if ($func_alt_dir && is_dir($func_alt_dir)) {
	foreach (scandir($func_alt_dir) as $function_file) {
		// ignore non-php files, check if the file exists, and that there isn't a function with the same name
		if (substr($function_file, -4) == '.php' && is_file($func_alt_dir.DIRECTORY_SEPARATOR.$function_file) && !function_exists(substr($function_file, 0, -4))) {
			$theme->req_once($func_alt_dir.DIRECTORY_SEPARATOR.$function_file, TRUE);
		}
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
$theme->integrations();

// Let the debugger know that we finished the functions.php file
$debug->runtime_checkpoint('[Theme] Finished Functions File');
