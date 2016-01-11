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
class theme extends abstract_base {
	const IDENTIFIER  = 'semantic';
	const TEXT_DOMAIN = 'semantic';
	
	/**
	 * @deprecated
	 */
	const identifier  = 'semantic';
	
	/**
	 * @deprecated
	 */
	const text_domain = 'semantic';
	
	/**
	 * The current theme settings
	 * @var array
	 */
	public $options;
	
	/**
	 * The current templates configured by $this->use_part()
	 * @var array
	 */
	public $template_queue;
	
	/**
	 * The templates used by $this->part()
	 * @var array
	 */
	public $used_templates;
	
	/**
	 * The list of variables to be extracted when a part is included
	 * @var array
	 */
	public $inc_var_list;
	
	/**
	 * Alias to get_template_directory()
	 * @var string
	 */
	public $path;
	
	/**
	 * Alias to get_template_directory_uri()
	 * @var string
	 */
	public $uri;
	
	/**
	 * Path to the asset directory, relative to $this->path
	 * @var string
	 */
	public $asset_sub_path;
	
	/**
	 * Path to the font directory, relative to $this->path
	 * @var string
	 */
	public $font_sub_path;
	
	/**
	 * Path to the image directory, relative to $this->path
	 * @var string
	 */
	public $image_sub_path;
	
	/**
	 * Path to the script directory, relative to $this->path
	 * @var string
	 */
	public $script_sub_path;
	
	/**
	 * Path to the style directory, relative to $this->path
	 * @var string
	 */
	public $style_sub_path;
	
	/**
	 * Path to the content directory, relative to $this->path
	 * @var string
	 */
	public $content_sub_path;
	
	/**
	 * Path to the include directory, relative to $this->path
	 * @var string
	 */
	public $include_sub_path;
	
	/**
	 * Path to the template directory, relative to $this->path
	 * @var string
	 */
	public $template_sub_path;
	
	/**
	 * Absolute path to the asset directory
	 * @var string
	 */
	public $asset_path;
	
	/**
	 * Absolute path to the font directory
	 * @var string
	 */
	public $font_path;
	
	/**
	 * Absolute path to the image directory
	 * @var string
	 */
	public $image_path;
	
	/**
	 * Absolute path to the script directory
	 * @var string
	 */
	public $script_path;
	
	/**
	 * Absolute path to the style directory
	 * @var string
	 */
	public $style_path;
	
	/**
	 * Absolute path to the content directory
	 * @var string
	 */
	public $content_path;
	
	/**
	 * Absolute path to the include directory
	 * @var string
	 */
	public $include_path;
	
	/**
	 * Absolute path to the template directory
	 * @var string
	 */
	public $template_path;
	
	/**
	 * Full URL/URI to the asset directory
	 * @var [type]
	 */
	public $asset_uri;
	
	/**
	 * Full URL/URI to the font directory
	 * @var [type]
	 */
	public $font_uri;
	
	/**
	 * Full URL/URI to the image directory
	 * @var [type]
	 */
	public $image_uri;
	
	/**
	 * Full URL/URI to the script directory
	 * @var [type]
	 */
	public $script_uri;
	
	/**
	 * Full URL/URI to the style directory
	 * @var [type]
	 */
	public $style_uri;
	
	/**
	 * Full URL/URI to the content directory
	 * @var [type]
	 */
	public $content_uri;
	
	/**
	 * Full URL/URI to the include directory
	 * @var [type]
	 */
	public $include_uri;
	
	/**
	 * Full URL/URI to the template directory
	 * @var [type]
	 */
	public $template_uri;
	
	/**
	 * Sets class vars and calls various setup functions
	 */
	public function __construct() {
		// Setup debug before everything else
		new debug();
		
		// Setup globals and query vars
		global $theme;
		$theme = $this;
		set_query_var('theme', $this);
		
		// Base path/uri
		$this->path = realpath(get_template_directory());
		$this->uri  = get_template_directory_uri();
		
		// Build Path Variables
		$this->generate_paths(array(
			// var_name => path
			'asset'     => 'asset',
			'font'      => 'asset/font',
			'image'     => 'asset/image',
			'script'    => 'asset/script',
			'style'     => 'asset/style',
			'content'   => 'content',
			'include'   => 'include',
			'template'  => 'template'
		));
		
		// Theme Options
		$this->options        = $this->fetch_options();
		$this->template_queue = array();
		$this->used_templates = array(); // This is only populated if debug is active
		$this->inc_var_list   = array();
		
		// Check POST for options update (nonce & user are verified)
		$this->update_options_via_post();
		
		/*** Functions (1 per file) ***/
		$this->get_functions();
		
		/*** Initialize all the WordPress integrations ***/
		$this->do_integrations();
		
		/*** Handle First Run ***/
		if ($this->get_option('first_run')) {
			// This is the first run, greet them
			template_use_part($theme->template_sub_path.'/default', $theme->template_sub_path.'/first-run');
		}
		
		parent::__construct();
	}
	
	/**
	 * Set all the path variables based on (array) $sub_paths
	 * 
	 * @param  array $sub_paths [description]
	 * @return void
	 */
	private function generate_paths($sub_paths) {
		// Sub-Paths
		foreach ($sub_paths as $var_name => $path) {
			$path       = str_replace('\\', '/', $path);
			$var        = $var_name.'_sub_path';
			$this->$var = $path;
		}
		// Absolute Paths
		foreach ($sub_paths as $var_name => $path) {
			$path       = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $path);
			$var        = $var_name.'_path';
			$this->$var = realpath($this->path.DIRECTORY_SEPARATOR.$path);
		}
		// URI Paths
		foreach ($sub_paths as $var_name => $path) {
			$path       = str_replace('\\', '/', $path);
			$var        = $var_name.'_uri';
			$this->$var = $this->uri.'/'.$path;
		}
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
		add_action('admin_bar_menu',        array($integrations, 'admin_bar_links'), 999);
		add_action('nav_menu_css_class',    array($integrations, 'current_nav'), 10, 1);
		add_action('admin_footer_text',     array($integrations, 'dashboard_footer'));
		add_action('init',                  array($integrations, 'editor_styles'), 11);
		add_action('wp_enqueue_scripts',    array($integrations, 'enqueue'));
		add_action('user_contactmethods',   array($integrations, 'google_author'));
		add_action('after_setup_theme',     array($integrations, 'init'));
		add_action('admin_menu',            array($integrations, 'options'));
		add_action('login_enqueue_scripts', array($integrations, 'options'));
		add_action('post_thumbnail_html',   array($integrations, 'post_thumbnail'), 10, 3);
		add_action('init',                  array($integrations, 'register_enqueue'), 10);
		add_action('get_search_form',       array($integrations, 'search_form'));
		add_action('widgets_init',          array($integrations, 'widgets_init'));
		add_action('wp_title',              array($integrations, 'wp_title'), 10, 2);
		add_action('template_include',      array($integrations, 'set_post_type'));
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
		$func_dir     = realpath($this->include_path.'/function');
		$func_alt_dir = realpath(get_stylesheet_directory().'/'.$this->include_sub_path.'/function');
		if ($func_alt_dir && is_dir($func_alt_dir)) {
			foreach (scandir($func_alt_dir) as $function_file) {
				// ignore non-php files, check if the file exists, and that there isn't a function with the same name
				if (
					substr($function_file, -4) == '.php'
					&& is_file($func_alt_dir.DIRECTORY_SEPARATOR.$function_file)
					&& !function_exists(substr($function_file, 0, -4))
				) {
					$this->req_once($func_alt_dir.DIRECTORY_SEPARATOR.$function_file, TRUE);
				}
			}
		}
		if ($func_dir != $func_alt_dir) {
			foreach (scandir($func_dir) as $function_file) {
				// ignore non-php files, check if the file exists, and that there isn't a function with the same name
				if (substr($function_file, -4) == '.php'
					&& is_file($func_dir.DIRECTORY_SEPARATOR.$function_file)
					&& !function_exists(substr($function_file, -4))
				) {
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
		$existing = get_option($this::identifier.'_options');
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
	 * @return array The default theme options
	 */
	private function default_options() {
		return array(
			'meta_x_ua_compatible_enabled' => TRUE,
			'meta_x_ua_compatible'         => 'IE=edge,chrome=1',
			'first_run'                    => TRUE,
			'header_text'                  => 'Semantic UI for WordPress: Developer Edition',
			'header_subtext'               => 'The Semantic UI starter/developer theme for WordPress.',
			'mobile_meta'                  => TRUE,
			'meta_favicon_enabled'         => TRUE,
			'meta_favicon'                 => $this->uri.'/logo.png',
			'mobile_size'                  => '450',
			'logo_size'                    => 3,
			'logo_url'                     => $this->uri.'/logo.png'
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
			update_option($this::identifier.'_options', $json);
		}
	}
	
	/**
	 * This function is called when there is POST data in the designated offset.
	 * The new options replace the old if the nonce can be verified.
	 * 
	 * @return void
	 */
	private function update_options_via_post() {
		$post_id = $this::identifier.'_options';
		$user_id = get_current_user_id();
		if (
			isset($_POST[$post_id.'_verify'])
			&&
			wp_verify_nonce($_POST[$post_id.'_verify'], $this::identifier.'_options_'.$user_id)
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
	 * @return string
	 */
	public function option_form_name($name) {
		return sprintf(
			'%1$s[%2$s]',
			$this::identifier.'_options',
			$name
		);
	}
	
	/**
	 * Returns the URI of the theme options page in the WordPress Dashboard
	 * @return string The URI of the theme options page
	 */
	public function options_uri() {
		return admin_url().'themes.php?page='.$this::identifier.'_options';
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
				$this::identifier.'_options_verify',
				wp_create_nonce($this::identifier.'_options_'.$user_id)
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
		
		// Configure Vars
		$var_list['theme'] = $this;
		$var_list['debug'] = $debug;
		$var_list          = $var_list + $this->inc_var_list;
		$this->_inc_path($path);
		
		// Undo the variables set by this function
		unset($path, $is_abs);
		if (!isset($var_list['var_list'])) {
			$var_list['var_list'] = NULL;
		}
		
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
		
		// Configure Vars
		$var_list['theme'] = $this;
		$var_list['debug'] = $debug;
		$var_list          = $var_list + $this->inc_var_list;
		$this->_inc_path($path);
		
		// Undo the variables set by this function
		unset($path, $is_abs);
		if (!isset($var_list['var_list'])) {
			$var_list['var_list'] = NULL;
		}
		
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
		
		// Configure Vars
		$var_list['theme'] = $this;
		$var_list['debug'] = $debug;
		$var_list          = $var_list + $this->inc_var_list;
		$this->_inc_path($path);
		
		// Undo the variables set by this function
		unset($path, $is_abs);
		if (!isset($var_list['var_list'])) {
			$var_list['var_list'] = NULL;
		}
		
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
		
		// Configure Vars
		$var_list['theme'] = $this;
		$var_list['debug'] = $debug;
		$var_list          = $var_list + $this->inc_var_list;
		$this->_inc_path($path);
		
		// Undo the variables set by this function
		unset($path, $is_abs);
		if (!isset($var_list['var_list'])) {
			$var_list['var_list'] = NULL;
		}
		
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
	 * @param  string  $id       The identifier to check for replacements
	 * @param  string  $path     The path to use if their is no replacement
	 * @param  boolean $is_abs   (optional) If the $path is an absolute path, set this to TRUE
	 * @param  boolean $once     (optional) Set to TRUE to use include_once instead of include
	 * @param  array   $var_list (optional) The array of variables you want extracted
	 * @return mixed             (optional) The return value of the file - usually NULL
	 */
	public function part($id, $path, $is_abs = FALSE, $once = FALSE, $var_list = array()) {
		if (isset($this->template_queue[$id])) {
			extract($this->template_queue[$id]);
			unset($this->template_queue[$id]);
		}
		global $debug;
		if ($debug->active) {
			$this->used_templates[] = array(
				'id'       => $id,
				'path'     => $path,
				'is_abs'   => $is_abs,
				'var_list' => array_keys($var_list)
			);
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
	 * via $this->template_queue[$id].
	 * 
	 * @param  string  $id       The identifier to check for replacments
	 * @param  string  $path     The path to use if their is no replacment
	 * @param  boolean $is_abs   (optional) If the $path is an absolute path, set this to TRUE
	 * @param  boolean $once     (optional) Set to TRUE to use include_once instead of include
	 * @param  array   $var_list (optional) The array of variables you want extraced
	 * @return boolean           Returns TRUE if the part was successfully added to the queue, FALSE otherwise
	 */
	public function use_part($id, $path, $is_abs = FALSE, $once = FALSE, $var_list = array()) {
		global $debug;
		if (isset($this->template_queue[$id])) {
			$debug->runtime_checkpoint('[Theme] Action: theme::use_part() failed to set "'.$id.'" to "'.$path.'"');
			return FALSE;
		} else {
			$debug->runtime_checkpoint('[Theme] Action: theme::use_part() set "'.$id.'" to "'.$path.'"');
			$this->template_queue[$id] = array(
				'path'     => $path,
				'once'     => $once,
				'is_abs'   => $is_abs,
				'var_list' => $var_list
			);
			return TRUE;
		}
	}
}
