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

/*** Run Inits ***/
new \semantic\theme();

// Let the debugger know that we finished the functions.php file
global $debug;
$debug->runtime_checkpoint('[Theme] Finished Functions File');
