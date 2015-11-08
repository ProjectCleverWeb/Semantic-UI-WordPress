<?php

namespace semantic\walker;

abstract class abstract_base extends \Walker {
	public function __construct($options = array()) {
		$this->seamntic_options = $options;
		global $debug;
		$debug->runtime_checkpoint(sprintf('[Theme] Class "%1$s" Initialized', get_class($this)));
	}
}
