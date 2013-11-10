<?php
namespace semantic_ui;

/**
 * This handles giving WP additional backend
 * functionality
 */
class admin {
	public function __construct() {
		$this->ref = vars::$ref;
		$this->data_class = vars::$data_class;
	}
	
	/**
	 * template method
	 */
	public static function _() {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
	}
}