<?php
namespace semantic_ui;

/**
 * This class make various tools available to the rest of SUI
 * 
 * This class shoould always be standalone
 */
class tools {
	
	public $ref; // top level class (semantic_ui-main.class.php)
	public $settings;
	
	public function __construct(&$settings) {
		
		$this->ref = &$ref;
		$this->settings = &$settings;
		
		
		
	}
	
	
	/**
	 * Determines if $value is a default
	 * 
	 * @param  mixed   $value        The value to chack
	 * @param  mixed   $compare      An additional value to compair (optional)
	 * @param  boolean $invert_bool  Check for FALSE instead of TRUE
	 * @return boolean               TRUE if is a know default; FALSE otherwise
	 */
	public function is_default($value, $compare = NULL, $invert_bool = FALSE) {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
		if ($compare !== NULL) {
			if ($value === $compare) {
				return TRUE;
			}
		}
		
		// prep
		if (is_string($value)) {
			strtolower(trim($value));
		} elseif (is_array($value)) {
			if ($value == array()) {
				return TRUE;
			}
		} elseif (is_object($value)) {
			if ($value == new stdClass) {
				return TRUE;
			}
		}
		
		if ((bool) $invert_bool) {
			$defaults = array(
				NULL, '', FALSE, 0, '0', 'false', 'default', 'auto'
			);
		} else {
			$defaults = array(
				NULL, '', TRUE, 1, '1', 'true', 'default', 'auto'
			);
		}
		
		if ($compare !== NULL) {
			if (is_string($compare)) {
				$compare = strtolower(trim($compare));
			}
			$defaults[] = $compare;
		}
		
		$is_default = FALSE;
		foreach ($defaults as $default) {
			if ($value === $default) {
				$is_default = TRUE;
				break;
			}
		}
		
		return $is_default;
	}
	
	/**
	 * Makes calling sui objects a little easier
	 * @param  [type] $class [description]
	 * @param  [type] $func  [description]
	 * @return [type]        [description]
	 */
	public function obj_callback($class,$func) {
		return array('\\semantic_ui\\'.((string) $class), (string) $func);
	}
	
	
	public function rating($pos, $neg, $options = FALSE) {
		$default = array(
			'max_rating' => 5,
			'full'       => 'X',
			'half'       => '/',
			'none'       => '-'
		);
		
		if (is_array($options)) {
			$o = $options + $default;
		} else {
			$o = $default;
		}
		
		$total = (round((int) $neg) + round((int) $pos));
		$half_stars = round(($pos/$total)*($o['max_rating']*2));
		$stars = floor($half_stars/2);
		
		$done = 0;
		$i = 1;
		while ($i<($o['max_rating']+1) && $i++) {
			if ((($stars+1) - $i) >= 0) {
				echo $o['full'];
			} else {
				if ($half_stars & 1 && $done == 0) {
					echo $o['half'];
					$done = 1;
				} else {
					echo $o['none'];
				}
			}
		}
	}
	
	
	/**
	 * function template
	 */
	public function _() {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
		
	}
	
	
	
	
}