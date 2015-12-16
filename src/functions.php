<?php
/**
 * Functions File
 * ==============
 * This is basically WordPress' version of a theme bootstrap file. Keep in mind
 * that this file will be called whenever WordPress is called, and this is the
 * active theme.
 */

/**
 * PSR-0 autoloader with child theme support
 * 
 * Loads files from `includes/class`
 * 
 * @codeCoverageIgnore
 */
spl_autoload_register(function ($class) {
	$include_path = '/include/class';
	$search_path  = str_replace('\\', DIRECTORY_SEPARATOR, '\\'.$class).'.php';
	$file_alt     = realpath(get_template_directory().$include_path.$search_path);
	$file         = realpath(get_stylesheet_directory().$include_path.$search_path);
	if($file_alt && is_file($file_alt)) {
		require_once $file_alt;
	} elseif($file && $file != $file_alt && is_file($file)) {
		require_once $file;
	}
});

/*** Run Inits ***/
new \semantic\theme();

// Let the debugger know that we finished the functions.php file
global $debug;
$debug->runtime_checkpoint('[Theme] Finished Functions File');
