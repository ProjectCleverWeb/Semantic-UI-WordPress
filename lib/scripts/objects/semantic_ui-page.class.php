<?php
namespace semantic_ui;

/**
 * This class handles page related info
 */
class page {
	
	public $ref; // top level class (semantic_ui-main.class.php)
	public $data_class; // the data_class (default: semantic_ui-wp.class.php)
	public $settings;
	
	public function __construct(&$settings,&$ref) {
		$this->ref = &$ref;
		$this->settings = &$settings;
		$this->data_class = &$ref->data_class;
		
	}
	
	
	public function the_title($id = FALSE) {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
		
		return the_title();
	}
	
	
	public function the_content($id = FALSE) {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
		
		
		
		return the_content();
	}
	
	
}