<?php
namespace semantic_ui;

/**
 * desc
 */
class name {
	public function __construct(&$settings) {
		$this->settings = &$settings;
		$this->ref = vars::$ref;
		$this->data_class = vars::$data_class;
	}
	
	/**
	 * template method
	 */
	public function _() {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
	}
}