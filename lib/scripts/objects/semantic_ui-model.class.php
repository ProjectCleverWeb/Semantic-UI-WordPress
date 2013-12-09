<?php
namespace semantic_ui;

/**
 * This class manages models
 * 
 * Models are pre-created sub-layouts that can be used
 * any number of times on any page. Some models can be
 * passed arguments to fill in content.
 */
class model {
	
	public $ref; // top level class (semantic_ui-main.class.php)
	public $data_class; // the data_class (default: semantic_ui-wp.class.php)
	public $settings;
	private $models;
	
	public function __construct(&$settings) {
		$this->settings = &$settings;
		$this->ref = vars::$ref;
		$this->data_class = vars::$data_class;
	}
	
	/**
	 * Registers all the default models
	 * 
	 * @return void
	 */
	public function init() {
		$path = realpath(__DIR__.'/../models');
		$ls = scandir($path);
		
		foreach ($ls as $file) {
			$id = strtolower(str_replace(array(
				// extensions
				'.php', '.html',
				// characters
				' ', '(', ')', '[', ']', '{', '}', '<', '>', ',', '|', '~'
			), '', $file));
			$this->register($path.'/'.$file, $id); // register checks if it is actually a file
		}
	}
	
	/**
	 * Gets a register model by $id and applies any arguments
	 * 
	 * @param  string  $id   The model ID
	 * @param  array/object  $args The arguments to apply (optional)
	 * @param  array/object  $args The default arguments to apply (optional)
	 * @return mixed         The resulting model (string) or FALSE otherwise
	 */
	public function fetch($id, $args = FALSE, $defaults = FALSE) {
		$ref = &$this->ref;
		$settings = &$this->settings;
		
		if (!is_string($id) || !isset($this->models[$id])) {
			return FALSE;
		}
		$model = $this->models[$id];
		
		if (empty($args) && empty($defaults)) {
			return $model;
		} else {
			if (!is_array($args) && !is_object($args)) {
				$args = array();
			}
			if (!is_array($defaults) && !is_object($defaults)) {
				$defaults = array();
			}
			return $ref->tools->fmts_translate($model, $args, $defaults);
		}
	}
	
	/**
	 * Gets a models file and import the contents
	 * 
	 * @param  string $file  The path to the file
	 * @param  string $id    The id to assign the model to
	 * @return bool          TRUE on success, FALSE otherwise
	 */
	public function register($file, $id) {
		if (!is_string($file) || !is_string($id)) {
			return FALSE;
		}
		
		if (file_exists($file) && is_file($file) && is_readable($file)) {
			$handle = fopen($file, "r");
			$contents = fread($handle, filesize($file));
			fclose($handle);
		} else {
			return FALSE;
		}
		
		$this->models[$id] = $contents;
		return TRUE;
	}
	
	
}