<?php
namespace semantic_ui;

/**
 * This class manages models
 * 
 * Models are pre-created sub-layouts that can be used
 * any number of times on any page.
 */
class model {
	
	public $ref; // top level class (semantic_ui-main.class.php)
	public $data_class; // the data_class (default: semantic_ui-wp.class.php)
	public $settings;
	
	public function __construct(&$settings) {
		$this->settings = &$settings;
		$this->ref = vars::$ref;
		$this->data_class = vars::$data_class;
	}
	
	public function fetch($id) {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
	}
	
	public function register($file,$id) {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
	}
	
	
}