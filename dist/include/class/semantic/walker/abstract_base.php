<?php
/**
 * The customer walker base class
 */

namespace semantic\walker;

/**
 * The customer walker base class
 */
abstract class abstract_base extends \Walker {
	
	/**
	 * Array of option to pass to the walker
	 * @var array
	 */
	public $semantic_options;
	
	/**
	 * Simple setup for walker classes.
	 * 
	 * @param array $options Custom options to pass to the walker as $this->semantic_options
	 */
	public function __construct($options = array()) {
		$this->semantic_options = $options;
		global $debug;
		$debug->runtime_checkpoint(sprintf('[Theme] Class "%1$s" Initialized', get_class($this)));
	}
}
