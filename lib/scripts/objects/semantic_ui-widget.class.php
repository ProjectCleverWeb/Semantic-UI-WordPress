<?php
namespace semantic_ui;

/**
 * Passes settings to widgets
 */
class widget extends \WP_Widget {
	public function __construct(&$settings) {
		$this->settings = &$settings;
		$this->ref = vars::$ref;
		$this->data_class = vars::$data_class;
	}
	
	public function get_settings($id) {
		if (isset($this->settings[$id])) {
			return $this->settings[$id];
		}
		return FALSE;
	}
}