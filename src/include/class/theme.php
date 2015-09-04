<?php
/**
 * This file both declares and initiates the theme class. The init is called at
 * the bottom of this file.
 */

namespace semantic;

/**
 * Theme Class
 * 
 * This class handles various parts of the theme, including common variables,
 * fetching/updating options, and how some parts of the page are generated.
 */
class theme extends base_class {
	// Theme Options
	public $identifier;
	public $text_domain;
	public $options;
	public $template_options;
	public $inc_var_list;
	// Base Path/URI
	public $path;
	public $uri;
	// Sub-Paths
	public $asset_sub_path;
	public $font_sub_path;
	public $image_sub_path;
	public $script_sub_path;
	public $style_sub_path;
	public $content_sub_path;
	public $include_sub_path;
	public $template_sub_path;
	// Absolute Paths
	public $asset_path;
	public $font_path;
	public $image_path;
	public $script_path;
	public $style_path;
	public $content_path;
	public $include_path;
	public $template_path;
	// URI Paths
	public $asset_uri;
	public $font_uri;
	public $image_uri;
	public $script_uri;
	public $style_uri;
	public $content_uri;
	public $include_uri;
	public $template_uri;
	
	/**
	 * Sets class vars and calls various setup functions
	 * 
	 * @return void
	 */
	public function __construct() {
		// Base path/uri
		$this->path          = get_template_directory();
		$this->uri          = get_template_directory_uri();
		// Sub-Paths
		$this->asset_sub_path    = 'asset';
		$this->font_sub_path     = $this->asset_sub_path.'/font';
		$this->image_sub_path    = $this->asset_sub_path.'/image';
		$this->script_sub_path   = $this->asset_sub_path.'/script';
		$this->style_sub_path    = $this->asset_sub_path.'/style';
		$this->content_sub_path  = 'content';
		$this->include_sub_path  = 'include';
		$this->template_sub_path = 'template';
		// Absolute Paths
		$this->asset_path    = realpath($this->path.DIRECTORY_SEPARATOR.$this->asset_sub_path);
		$this->font_path     = realpath($this->path.DIRECTORY_SEPARATOR.$this->font_sub_path);
		$this->image_path    = realpath($this->path.DIRECTORY_SEPARATOR.$this->image_sub_path);
		$this->script_path   = realpath($this->path.DIRECTORY_SEPARATOR.$this->script_sub_path);
		$this->style_path    = realpath($this->path.DIRECTORY_SEPARATOR.$this->style_sub_path);
		$this->content_path  = realpath($this->path.DIRECTORY_SEPARATOR.$this->content_sub_path);
		$this->include_path  = realpath($this->path.DIRECTORY_SEPARATOR.$this->include_sub_path);
		$this->template_path = realpath($this->path.DIRECTORY_SEPARATOR.$this->template_sub_path);
		// URI Paths
		$this->asset_uri    = $this->uri.'/'.$this->asset_sub_path;
		$this->font_uri     = $this->uri.'/'.$this->font_sub_path;
		$this->image_uri    = $this->uri.'/'.$this->image_sub_path;
		$this->script_uri   = $this->uri.'/'.$this->script_sub_path;
		$this->style_uri    = $this->uri.'/'.$this->style_sub_path;
		$this->content_uri  = $this->uri.'/'.$this->content_sub_path;
		$this->include_uri  = $this->uri.'/'.$this->include_sub_path;
		$this->template_uri = $this->uri.'/'.$this->template_sub_path;
		// Theme Options
		$this->identifier       = 'semantic_ui';
		$this->text_domain      = 'semantic-ui';
		$this->options          = $this->fetch_options();
		$this->template_options = array();
		$this->inc_var_list     = array();
		
		// Check POST for options update (nonce & user are verified)
		$this->update_options_via_post();
		
		parent::__construct($this);
	}
	
	/**
	 * Do WordPress theme integrations
	 * 
	 * @return void
	 */
	public function do_integrations() {
		global $debug;
		$debug->runtime_checkpoint('[Theme] Begin WordPress Integrations');
		$integrations = new integrations;
		// Alphebetical based on the callback (doesn't effect the order they are called)
		add_action('admin_bar_menu',      array($integrations, 'admin_bar_links'), 999);
		add_action('nav_menu_css_class',  array($integrations, 'current_nav'), 10, 1);
		add_action('admin_footer_text',   array($integrations, 'dashboard_footer'));
		add_action('init',                array($integrations, 'editor_styles'), 11);
		add_action('wp_enqueue_scripts',  array($integrations, 'enqueue'));
		add_action('user_contactmethods', array($integrations, 'google_author'));
		add_action('after_setup_theme',   array($integrations, 'init'));
		add_action('admin_menu',          array($integrations, 'options'));
		add_action('post_thumbnail_html', array($integrations, 'post_thumbnail'), 10, 3);
		add_action('init',                array($integrations, 'register_enqueue'), 10);
		add_action('get_search_form',     array($integrations, 'search_form'));
		add_action('widgets_init',        array($integrations, 'widgets_init'));
		add_action('wp_title',            array($integrations, 'wp_title'), 10, 2);
		add_action('template_include',    array($integrations, 'set_post_type'));
		if ($debug->active) {
			$debug->runtime_checkpoint('[Theme] Adding Debug WordPress Integrations');
			template_part($this->include_sub_path.'/debug_hooks');
		}
		$debug->runtime_checkpoint('[Theme] Finished WordPress Integrations');
	}
	
	/**
	 * Get all theme functions
	 * 
	 * @return void
	 */
	public function get_functions() {
		global $debug;
		$debug->runtime_checkpoint('[Theme] Begin Including Function Files');
		$func_dir = realpath($this->include_path.'/function');
		$func_alt_dir = realpath(STYLESHEETPATH.'/'.$this->include_sub_path.'/function');
		if ($func_alt_dir && is_dir($func_alt_dir)) {
			foreach (scandir($func_alt_dir) as $function_file) {
				// ignore non-php files, check if the file exists, and that there isn't a function with the same name
				if (substr($function_file, -4) == '.php' && is_file($func_alt_dir.DIRECTORY_SEPARATOR.$function_file) && !function_exists(substr($function_file, 0, -4))) {
					$this->req_once($func_alt_dir.DIRECTORY_SEPARATOR.$function_file, TRUE);
				}
			}
		}
		if ($func_dir != $func_alt_dir) {
			foreach (scandir($func_dir) as $function_file) {
				// ignore non-php files, check if the file exists, and that there isn't a function with the same name
				if (substr($function_file, -4) == '.php' && is_file($func_dir.DIRECTORY_SEPARATOR.$function_file) && !function_exists(substr($function_file, -4))) {
					$this->req_once($func_dir.DIRECTORY_SEPARATOR.$function_file, TRUE);
				}
			}
		}
		$debug->runtime_checkpoint('[Theme] Finished Including Function Files');
	}
	
	/**
	 * Imports the options from WordPress
	 * 
	 * @return mixed
	 */
	private function fetch_options() {
		$existing = get_option($this->identifier.'_options');
		if ($existing) {
			$options = json_decode($existing);
		} else {
			// Reset and add them to the database
			$options = $this->default_options();
			$this->update_options($options);
		}
		return (array) $options;
	}
	
	/**
	 * Simply returns an array of "default" options for the theme
	 * 
	 * @return array The options
	 */
	private function default_options() {
		return array(
			'first_run'   => TRUE,
			'mobile_meta' => TRUE,
			'mobile_size' => '450',
			'logo_url'    => 'http://placehold.it/200x125.png'
		);
	}
	
	/**
	 * Fetches the given option for the theme, returns FALSE when the option
	 * doesn't exist.
	 * 
	 * @param  string $name The option name
	 * @return mixed        The value of the options or FALSE on failure.
	 */
	public function get_option($name) {
		$options = &$this->options;
		if (isset($options[$name])) {
			return $options[$name];
		}
		return FALSE;
	}
	
	/**
	 * Checks if the current user can edit the theme and updates the options
	 * stored in the database if they can.
	 * 
	 * @param  array $options The options to store in the database as a JSON array
	 * @return void
	 */
	public function update_options($options) {
		if (current_user_can('edit_theme_options')) {
			$json = json_encode((array) $options);
			update_option($this->identifier.'_options', $json);
		}
	}
	
	/**
	 * This function is called when there is POST data in the designated offset.
	 * The new options replace the old if the nonce can be verified.
	 * 
	 * @return void
	 */
	private function update_options_via_post() {
		$post_id = $this->identifier.'_options';
		$user_id = get_current_user_id();
		if (
			isset($_POST[$post_id.'_verify'])
			&&
			wp_verify_nonce($_POST[$post_id.'_verify'], $this->identifier.'_options_'.$user_id)
			&&
			current_user_can('edit_theme_options')
			&&
			isset($_POST[$post_id])
			&&
			is_array($_POST[$post_id])
		) {
			$this->update_options($_POST[$post_id]);
			
			// Now redirect to clear POST and show changes
			header('Location: '.$this->options_uri());
		}
	}
	
	/**
	 * Prints the input name for a value on the options page (form)
	 * 
	 * @param  string $name The name to use
	 * @return void
	 */
	public function option_form_name($name) {
		return sprintf(
			'%1$s[%2$s]',
			$this->identifier.'_options',
			$name
		);
	}
	
	/**
	 * Returns the URI of the theme options page in the WordPress Dashboard
	 * @return string The URI of the theme options page
	 */
	public function options_uri() {
		return admin_url().'themes.php?page='.$this->identifier.'_options';
	}
	
	/**
	 * This ensures that the data sent via POST is actually valid by printing a
	 * special hidden form data entry.
	 * 
	 * @return void
	 */
	public function options_update_data() {
		$user_id = get_current_user_id();
		if ($user_id) {
			printf(
				'<input type="hidden" name="%1$s" value="%2$s">',
				$this->identifier.'_options_verify',
				wp_create_nonce($this->identifier.'_options_'.$user_id)
			);
		}
	}
	
	/**
	 * Works like `include $theme_dir.'/'.$path`
	 * 
	 * @param  String  $path     The path to the file you want to include
	 * @param  boolean $is_abs   Is this an absolute path? Defaults to FALSE
	 * @param  array   $var_list List of variables to extract()
	 * @return mixed             Value of the file included
	 */
	public function inc($path, $is_abs = FALSE, $var_list = array()) {
		if (!$is_abs) {
			$path = $this->path.DIRECTORY_SEPARATOR.$path;
		}
		
		global $debug;
		$debug->runtime_checkpoint('[Theme] Include: '.str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $path));
		
		$var_list = $var_list + $this->inc_var_list;
		$this->_inc_path($path);
		
		// Undo the variables set by this function
		unset($path, $is_abs);
		if (!isset($var_list['var_list'])) {
			$var_list['var_list'] = NULL;
		}
		
		extract($GLOBALS);
		extract($var_list);
		return include $this->_inc_path();
	}
	
	/**
	 * Works like `include_once $theme_dir.'/'.$path`
	 * 
	 * @param  String  $path     The path to the file you want to include
	 * @param  boolean $is_abs   Is this an absolute path? Defaults to FALSE
	 * @param  array   $var_list List of variables to extract()
	 * @return mixed             Value of the file included
	 */
	public function inc_once($path, $is_abs = FALSE, $var_list = array()) {
		if (!$is_abs) {
			$path = $this->path.DIRECTORY_SEPARATOR.$path;
		}
		
		global $debug;
		$debug->runtime_checkpoint('[Theme] Include Once: '.str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $path));
		
		$var_list = $var_list + $this->inc_var_list;
		$this->_inc_path($path);
		
		// Undo the variables set by this function
		unset($path, $is_abs);
		if (!isset($var_list['var_list'])) {
			$var_list['var_list'] = NULL;
		}
		
		extract($GLOBALS);
		extract($var_list);
		return include_once $this->_inc_path();
	}
	
	/**
	 * Works like `require $theme_dir.'/'.$path`
	 * 
	 * @param  String  $path     The path to the file you want to include
	 * @param  boolean $is_abs   Is this an absolute path? Defaults to FALSE
	 * @param  array   $var_list List of variables to extract()
	 * @return mixed             Value of the file included
	 */
	public function req($path, $is_abs = FALSE, $var_list = array()) {
		if (!$is_abs) {
			$path = $this->path.DIRECTORY_SEPARATOR.$path;
		}
		
		global $debug;
		$debug->runtime_checkpoint('[Theme] Require: '.str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $path));
		
		$var_list = $var_list + $this->inc_var_list;
		$this->_inc_path($path);
		
		// Undo the variables set by this function
		unset($path, $is_abs);
		if (!isset($var_list['var_list'])) {
			$var_list['var_list'] = NULL;
		}
		
		extract($GLOBALS);
		extract($var_list);
		return require $this->_inc_path();
	}
	
	/**
	 * Works like `require_once $theme_dir.'/'.$path`
	 * 
	 * @param  String  $path     The path to the file you want to include
	 * @param  boolean $is_abs   Is this an absolute path? Defaults to FALSE
	 * @param  array   $var_list List of variables to extract()
	 * @return mixed             Value of the file included
	 */
	public function req_once($path, $is_abs = FALSE, $var_list = array()) {
		if (!$is_abs) {
			$path = $this->path.DIRECTORY_SEPARATOR.$path;
		}
		
		global $debug;
		$debug->runtime_checkpoint('[Theme] Require Once: '.str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $path));
		
		$var_list = $var_list + $this->inc_var_list;
		$this->_inc_path($path);
		
		// Undo the variables set by this function
		unset($path, $is_abs);
		if (!isset($var_list['var_list'])) {
			$var_list['var_list'] = NULL;
		}
		
		extract($GLOBALS);
		extract($var_list);
		return require_once $this->_inc_path();
	}
	
	/**
	 * Simple function to temporarily hold a path string. Empties the storage when
	 * called without a path to store
	 * 
	 * @param  string $path Path to store
	 * @return string       The stored path or an empty string
	 */
	private function _inc_path($path = '') {
		static $spath;
		if (!empty($path)) {
			$spath = $path;
			$tpath = $path;
		} else {
			$tpath = $spath;
			$spath = '';
		}
		return $tpath;
	}
	
	/**
	 * Includes a theme part into the current page. Uses an id to identify which
	 * part of the theme is currently trying to be included. This allows the
	 * template file to determine what parts of the page are replaced when the page
	 * is generated. (via $this->use_part())
	 * 
	 * @param  string  $id       The identifier to check for replacments
	 * @param  string  $path     The path to use if their is no replacment
	 * @param  boolean $is_abs   (optional) If the $path is an absolute path, set this to TRUE
	 * @param  boolean $once     (optional) Set to TRUE to use include_once instead of include
	 * @param  array   $var_list (optional) The array of variables you want extraced
	 * @return mixed             (optional) The return value of the file - usually NULL
	 */
	public function part($id, $path, $is_abs = FALSE, $once = FALSE, $var_list = array()) {
		if (isset($this->template_options[$id])) {
			extract($this->template_options[$id]);
		}
		if ($once) {
			return $this->inc_once($path, $is_abs, $var_list);
		}
		return $this->inc($path, $is_abs, $var_list);
	}
	
	/**
	 * Allows the template file to override what parts are used throughout the
	 * page. This method also checks if the theme part has already been replaced.
	 * If it has already been replaced, then the input is ignored and this method
	 * returns FALSE. To override this functionallity set the variable manually
	 * via $this->template_options[$id].
	 * 
	 * @param  string  $id       The identifier to check for replacments
	 * @param  string  $path     The path to use if their is no replacment
	 * @param  boolean $is_abs   (optional) If the $path is an absolute path, set this to TRUE
	 * @param  boolean $once     (optional) Set to TRUE to use include_once instead of include
	 * @param  array   $var_list (optional) The array of variables you want extraced
	 * @return mixed             (optional) The return value of the file - usually NULL
	 */
	public function use_part($id, $path, $is_abs = FALSE, $once = FALSE, $var_list = array()) {
		global $debug;
		if (isset($this->template_options[$id])) {
			$debug->runtime_checkpoint('[Theme] Action: theme::use_part() failed to set "'.$id.'" to "'.$path.'"');
			return FALSE;
		} else {
			$debug->runtime_checkpoint('[Theme] Action: theme::use_part() set "'.$id.'" to "'.$path.'"');
			$this->template_options[$id] = array(
				'path'     => $path,
				'once'     => $once,
				'is_abs'   => $is_abs,
				'var_list' => $var_list
			);
			return TRUE;
		}
	}
}
