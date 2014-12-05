<?php

/**
 * Simple PSR-4 autoloader for the \semantic namespace
 * 
 * Loads files from `includes/classes`
 * 
 * @codeCoverageIgnore
 */
spl_autoload_register(function ($class) {
	$prefix = 'semantic';
	
	$prefix_len = strlen($prefix);
	if(strncmp($prefix, $class, $prefix_len) !== 0) {
		return;
	}
	
	$file = __DIR__.'/classes'.str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $prefix_len)).'.php';
	
	if(file_exists($file) && is_file($file)) {
		require_once $file;
	}
});
