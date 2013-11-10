<?php
namespace semantic_ui\wp;

/**
 * This handles giving WP additional functionality
 */
class general {
	public function __construct() {
		$this->ref = vars::$ref;
		$this->data_class = vars::$data_class;
	}
	
	/**
	 * This just calls all the callbacks
	 * 
	 * @return void
	 */
	public static function init() {
		$ref   = \semantic_ui\vars::$ref;
		$tools = $ref->tools;
		
		// launching operation cleanup
		add_action( 'init', $tools->obj_callback('wp\general', 'clean_head'));
		// remove WP version from RSS
		add_filter( 'the_generator', function () {return '';} );
		// remove pesky injected css for recent comments widget
		add_filter( 'wp_head', $tools->obj_callback('wp\general', 'widget_recent_comments_style'), 1 );
		// clean up comment styles in the head
		add_action( 'wp_head', 'sui_remove_recent_comments_style', 1 );
		// clean up gallery output in wp
		add_filter( 'gallery_style', 'sui_gallery_style' );
		
		// enqueue base scripts and styles
		add_action( 'wp_enqueue_scripts', 'sui_scripts_and_styles', 999 );
		// ie conditional wrapper
		
		// launching this stuff after theme setup
		sui_theme_support();
		
		// register the widget areas
		add_action( 'widgets_init', $tools->obj_callback('wp\general', 'register_widget_areas'));
		// adding the bones search form (created in functions.php)
		add_filter( 'get_search_form', 'sui_search' );
		
		// cleaning up random code around images
		add_filter( 'the_content', 'sui_filter_ptags_on_images' );
		// cleaning up excerpt
		add_filter( 'excerpt_more', 'sui_excerpt_more' );
		
	}
	
	public static function add_widget_areas($areas_array = FALSE) {
		static $array;
		if (is_array($areas_array)) {
			$array = $areas_array;
		} elseif (!is_array($array)) {
			$array = FALSE;
		}
		return $array;
	}
	
	public function register_widget_areas(){
		$areas_array = self::add_widget_areas();
		
		if (is_array($areas_array)) {
			foreach ($areas_array as $area) {
				register_sidebar(array(
					'id' => $area['id'],
					'name' => $area['name'],
					'description' => $area['desc'],
					'before_widget' => '<div id="%1$s" class="ui stacked blue segment widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h4 class="ui ribbon label widget title">',
					'after_title' => '</h4>',
				));
			}
			return TRUE;
		}
		return FALSE;
	}
	
	public static function clean_head() {
		$ref   = \semantic_ui\vars::$ref;
		$tools = $ref->tools;
		
		// EditURI link
		remove_action( 'wp_head', 'rsd_link' );
		// windows live writer
		remove_action( 'wp_head', 'wlwmanifest_link' );
		// index link
		remove_action( 'wp_head', 'index_rel_link' );
		// previous link
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		// start link
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		// links for adjacent posts
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		// WP version
		remove_action( 'wp_head', 'wp_generator' );
		// remove WP version from css
		add_filter( 'style_loader_src', $tools->obj_callback('wp\general', 'del_wp_version'), 9999 );
		// remove Wp version from scripts
		add_filter( 'script_loader_src', $tools->obj_callback('wp\general', 'del_wp_version'), 9999 );
	}
	
	public static function del_wp_version($src) {
		if (strpos($src,'ver=')){
			$src = remove_query_arg('ver', $src);
		}
		return $src;
	}
	
	public static function widget_recent_comments_style() {
		if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
			remove_filter('wp_head', 'wp_widget_recent_comments_style');
		}
	}
	
	/**
	 * template method
	 */
	public static function _() {
		
	}
}