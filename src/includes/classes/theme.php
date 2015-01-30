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
class theme {
	// Theme Options
	public static $identifier;
	public static $text_domain;
	public static $options;
	public static $template_options;
	// Absolute Paths
	public static $path;
	public static $assets_path;
	public static $fonts_path;
	public static $images_path;
	public static $scripts_path;
	public static $styles_path;
	public static $contents_path;
	public static $includes_path;
	public static $layouts_path;
	public static $templates_path;
	// URI Paths
	public static $uri;
	public static $assets_uri;
	public static $fonts_uri;
	public static $images_uri;
	public static $scripts_uri;
	public static $styles_uri;
	public static $contents_uri;
	public static $includes_uri;
	public static $layouts_uri;
	public static $templates_uri;
	
	/**
	 * Sets class vars and calls various setup functions
	 * 
	 * @return void
	 */
	public static function init() {
		// Absolute Paths
		self::$path           = get_template_directory();
		self::$assets_path    = self::$path.'/assets';
		self::$fonts_path     = self::$assets_path.'/fonts';
		self::$images_path    = self::$assets_path.'/images';
		self::$scripts_path   = self::$assets_path.'/scripts';
		self::$styles_path    = self::$assets_path.'/styles';
		self::$contents_path  = self::$path.'/contents';
		self::$includes_path  = self::$path.'/includes';
		self::$layouts_path   = self::$path.'/layouts';
		self::$templates_path = self::$path.'/templates';
		// URI Paths
		self::$uri           = get_template_directory_uri();
		self::$assets_uri    = self::$uri.'/assets';
		self::$fonts_uri     = self::$assets_uri.'/fonts';
		self::$images_uri    = self::$assets_uri.'/images';
		self::$scripts_uri   = self::$assets_uri.'/scripts';
		self::$styles_uri    = self::$assets_uri.'/styles';
		self::$contents_uri  = self::$uri.'/contents';
		self::$includes_uri  = self::$uri.'/includes';
		self::$layouts_uri   = self::$uri.'/layouts';
		self::$templates_uri = self::$uri.'/templates';
		// Theme Options
		self::$identifier       = 'semantic_ui';
		self::$text_domain      = 'semantic-ui';
		self::$options          = self::fetch_options();
		self::$template_options = array();
		
		// Check POST for options update (nonce & user are verified)
		self::update_options_via_post();
	}
	
	/**
	 * Imports the options from WordPress
	 * 
	 * @return mixed
	 */
	private static function fetch_options() {
		$existing = get_option(self::$identifier.'_options');
		if ($existing) {
			$options = json_decode($existing);
		} else {
			// Reset and add them to the database
			$options = self::default_options();
			self::update_options($options);
		}
		return (array) $options;
	}
	
	/**
	 * Simply returns an array of "default" options for the theme
	 * 
	 * @return array The options
	 */
	private static function default_options() {
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
	public static function get_option($name) {
		$options = &self::$options;
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
	public static function update_options($options) {
		if (current_user_can('edit_theme_options')) {
			$json = json_encode((array) $options);
			update_option(self::$identifier.'_options', $json);
		}
	}
	
	/**
	 * This function is called when there is POST data in the designated offset.
	 * The new options replace the old if the nonce can be verified.
	 * 
	 * @return void
	 */
	private static function update_options_via_post() {
		$post_id = self::$identifier.'_options';
		$user_id = get_current_user_id();
		if (
			isset($_POST[$post_id.'_verify'])
			&&
			wp_verify_nonce($_POST[$post_id.'_verify'], self::$identifier.'_options_'.$user_id)
			&&
			current_user_can('edit_theme_options')
			&&
			isset($_POST[$post_id])
			&&
			is_array($_POST[$post_id])
		) {
			self::update_options($_POST[$post_id]);
			
			// Now redirect to clear POST and show changes
			header('Location: '.self::options_uri());
		}
	}
	
	/**
	 * Prints the input name for a value on the options page (form)
	 * 
	 * @param  string $name The name to use
	 * @return void
	 */
	public static function option_form_name($name) {
		return sprintf(
			'%1$s[%2$s]',
			self::$identifier.'_options',
			$name
		);
	}
	
	/**
	 * Returns the URI of the theme options page in the WordPress Dashboard
	 * @return string The URI of the theme options page
	 */
	public static function options_uri() {
		return admin_url().'themes.php?page='.self::$identifier.'_options';
	}
	
	/**
	 * This ensures that the data sent via POST is actually valid by printing a
	 * special hidden form data entry.
	 * 
	 * @return void
	 */
	public static function options_update_data() {
		$user_id = get_current_user_id();
		if ($user_id) {
			printf(
				'<input type="hidden" name="%1$s" value="%2$s">',
				self::$identifier.'_options_verify',
				wp_create_nonce(self::$identifier.'_options_'.$user_id)
			);
		}
	}
	
	/**
	 * Includes a theme part into the current page. Uses slugs to identify which
	 * part of the theme is currently trying to be included. This allows the
	 * template file to determine what parts of the page are replaced when the page
	 * is generated. (via self::use_part())
	 * 
	 * @param  string $slug The identifier of the current theme part being included
	 * @param  string $type Can be: content, include, layout, template (or there plural equivalent)
	 * @param  string $part The part name, in respect to the part's filename
	 * @param  string $sub  [optional] The specific sub part identifier.
	 * @return bool         True on success, false otherwise.
	 */
	public static function part($slug, $type, $part = '', $sub = '') {
		if (isset(self::$template_options[$slug])) {
			extract(self::$template_options[$slug]);
		}
		if (empty($part)) {
			$part = $slug;
		}
		$path = self::$path.'/';
		settype($type, 'string');
		settype($part, 'string');
		settype($sub, 'string');
		$type = strtolower($type);
		$part = strtolower($part);
		$sub  = strtolower($sub);
		$tsub = trim($sub);
		if (!empty($tsub)) {
			$dsub = '-'.$sub;
		} else {
			$dsub = '';
		}
		
		switch ($type) {
			case 'content':
			case 'contents':
				$type = 'contents';
				break;
			
			case 'include':
			case 'includes':
				$type = 'includes';
				break;
			
			case 'layout':
			case 'layouts':
				$type = 'layouts';
				break;
			
			case 'template':
			case 'templates':
				$type = 'templates';
				break;
			
			default:
				return FALSE; // invalid type
		}
		
		$full_path = $path.$type.'/'.$part.$dsub;
		$alt_path  = $path.$type.'/'.$part;
		
		// get_template_part() adds hooks
		if (file_exists($full_path.'.php') && is_file($full_path.'.php')) {
			get_template_part($type.'/'.$part, $sub);
		} elseif (file_exists($alt_path.'.php') && is_file($alt_path.'.php')) {
			get_template_part($type.'/'.$part);
		} elseif (file_exists($path.$part.$dsub.'.php') && is_file($path.$part.$dsub.'.php')) {
			get_template_part($part, $sub);
		} elseif (file_exists($path.$part.'.php') && is_file($path.$part.'.php')) {
			get_template_part($part);
		} else {
			return FALSE; // 404
		}
		
		return TRUE; // Success
	}
	
	/**
	 * Allows the template file to override what parts are used throughout the
	 * page. This method also checks if the theme part has already been replaced.
	 * If it has already been replaced, then the input is ignored and this method
	 * returns FALSE. To override this functionallity set the variable manually
	 * via self::$template_options[$slug].
	 * 
	 * @param  string $slug The identifier of the theme part being replaced
	 * @param  string $type Can be: content, include, layout, template (or there plural equivalent)
	 * @param  string $part The part name, in respect to the part's filename
	 * @param  string $sub  [optional] The specific sub part identifier.
	 * @return bool         Returns TRUE on success, FALSE otherwise.
	 */
	public static function use_part($slug, $type, $part = '', $sub = '') {
		if (isset(self::$template_options[$slug])) {
			return FALSE;
		} else {
			if (empty($part)) {
				$part = $slug;
			}
			self::$template_options[$slug] = array(
				'type' => $type,
				'part' => $part,
				'sub'  => $sub
			);
			return TRUE;
		}
	}
	
	/**
	 * Extends get_the_date()
	 * 
	 * @param  string $fmt [optional] The date format to use
	 * @return string      The date
	 */
	public static function get_date($fmt = '') {
		settype($fmt, 'string');
		
		if (empty($fmt)) {
			$fmt = get_option('date_format');
		}
		
		return get_the_date($fmt);
	}
	
	/**
	 * Extends get_the_time()
	 * 
	 * @param  string $fmt [optional] The time format to use
	 * @return string      The time
	 */
	public static function get_time($fmt = '') {
		settype($fmt, 'string');
		
		if (empty($fmt)) {
			$fmt = get_option('time_format');
		}
		
		return get_the_time($fmt);
	}
	
	/**
	 * Extends the_date()
	 * 
	 * @param  string $fmt [optional] The date format to use
	 * @return void
	 */
	public static function date($fmt = '') {
		settype($fmt, 'string');
		
		if (empty($fmt)) {
			$fmt = get_option('date_format');
		}
		
		the_date($fmt);
	}
	
	/**
	 * Extends the_time()
	 * 
	 * @param  string $fmt [optional] The time format to use
	 * @return void
	 */
	public static function time($fmt = '') {
		settype($fmt, 'string');
		
		if (empty($fmt)) {
			$fmt = get_option('time_format');
		}
		
		the_time($fmt);
	}
}
