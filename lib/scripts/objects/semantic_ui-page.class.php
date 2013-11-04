<?php
namespace semantic_ui;

/**
 * This class handles page related info
 */
class page {
	
	public $ref; // top level class (semantic_ui-main.class.php)
	public $settings;
	
	public function __construct(&$settings,&$ref) {
		
		$this->ref = &$ref;
		$this->settings = &$settings;
		
		
		
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