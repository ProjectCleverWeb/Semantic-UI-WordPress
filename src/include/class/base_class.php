<?php
/**
 * Debug Class
 */

namespace semantic;

abstract class base_class {
	public function __construct($class) {
		global $debug;
		$debug->runtime_checkpoint(sprintf('[Theme] Class "%1$s" Initialized', get_class($class)));
	}
}
