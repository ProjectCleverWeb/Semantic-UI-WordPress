<?php
namespace semantic_ui;

/**
 * passes shared vars
 * 
 * Allows truly global access to vars without forcing
 * a particular global variable
 * 
 */
class vars {
	public static $ref; // top level class (semantic_ui-main.class.php)
	public static $data_class; // the data_class (default: semantic_ui-wp.class.php)
	
	public function __construct(&$ref) {
		$this::$ref = &$ref;
		$this::$data_class = &$ref->data_class;
	}
}