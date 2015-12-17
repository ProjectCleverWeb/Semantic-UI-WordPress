<?php
/**
 * Base Class
 * ==========
 * This class allows you to add any common functionality to all the other
 * classes. In this case we are just adding some debugging info.
 */

namespace semantic;

/**
 * Base Class
 * 
 * This class allows you to add any common functionality to all the other
 * classes. In this case we are just adding some debugging info.
 */
abstract class abstract_base {
	
	/**
	 * Just logs that the current class was initialized
	 */
	public function __construct() {
		global $debug;
		$debug->runtime_checkpoint(sprintf('[Theme] Class "%1$s" Initialized', get_class($this)));
	}
}
