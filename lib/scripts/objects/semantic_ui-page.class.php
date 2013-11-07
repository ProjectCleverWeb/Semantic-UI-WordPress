<?php
namespace semantic_ui;

/**
 * This class handles page related info
 */
class page {
	public function __construct(&$settings) {
		$this->settings = &$settings;
		$this->ref = vars::$ref;
		$this->data_class = vars::$data_class;
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