<?php
namespace semantic_ui;

/**
 * This class allows SUI to interface with WP
 */
class wp implements data_class {
	
	public function __construct() {
		$this->settings = (object) array(
			'general' => (object) array(
				'color'               => 'blue',
				'menu_type'           => 'primary',
				'display_max_tags'    => 10,
				'display_tagline'     => TRUE,
				'display_post_img'    => TRUE,
				'display_post_tags'   => TRUE,
				'display_post_cat'    => TRUE,
				'display_post_author' => TRUE,
			),
			'post' => (object) array(
				'content_type'        => 'excerpt',
				'display_comments'    => TRUE,
				'display_img'         => TRUE,
				'display_tags'        => TRUE,
				'display_all_tags'    => TRUE,
				'display_cat'         => TRUE,
				'display_author'      => TRUE
				
			),
			'page' => (object) array(
				'display_comments'    => FALSE
			)
		);
	}
	
	public function init() {
		$this->load_widgets();
		
		// Finally: load addtional functionality
		require_once (__DIR__.'/semantic_ui-general.class.php');
		require_once (__DIR__.'/semantic_ui-admin.class.php');
		require_once( __DIR__.'/../init/admin.php' );
		require_once( __DIR__.'/../init/general.php' );
		
		// Now make it all work
		add_action( 'after_setup_theme', $tools->obj_callback('wp\general', 'init'), 16 );
	}
	
	public function load_widgets() {
		$tools = vars::$ref->tools;
		
		require_once __DIR__.'/semantic_ui-widget-add_menu.class.php';
		
		// Now load them all
		add_action( 'widgets_init', $tools->obj_callback('wp', '_load_widgets'));
	}
	
	public function _load_widgets() {
		register_widget( '\semantic_ui\widget\add_menu' );
	}
	
	
	public function document_title($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		return get_the_title($id);
	}
	
	public function document_type($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		
		// [comeback] limited for now, add more once a few templates are in.
		if (is_page($id)) {
			return 'PAGE';
		} elseif (is_home($id)) {
			return 'HOME';
		} elseif (is_search($id)) {
			return 'SEARCH';
		} elseif (is_attachment($id)) {
			return 'ATTACHMENT';
		} else {
			return 'POST'; // most common, default until more options added
		}
	}
	
	/**
	 * Interface for _get_threaded_comments() and _get_comments()
	 * 
	 * @return array  The comments
	 */
	public function get_comments() {
		$threaded = FALSE; // [comeback] determined by OF
		if ($threaded) {
			return $this->_get_threaded_comments();
		} else {
			return $this->_get_comments();
		}
	}
	
	/**
	 * Gets comments from wordpress, and returns them in a mutlilayer array
	 * 
	 * @return array  The comments
	 */
	private function _get_threaded_comments() {
		return array();
	}
	
	/**
	 * Gets comments from wordpress, and returns them in a flat array
	 * 
	 * @return array  The comments
	 */
	private function _get_comments() {
		return array();
	}
	
	/**
	 * This gets a menu by its id and returns its items
	 * in a multi-layered array (for menu children).
	 * 
	 * @param  string $menu_id  The menu id
	 * @return array            The menu items array
	 */
	public function get_menu($menu_id) {
		$menu_id = (string) $menu_id;
		if (($menus = get_nav_menu_locations()) && isset($menus[$menu_id])) {
			$menu = wp_get_nav_menu_object($menus[$menu_id]);
			
			// make menu items easier to use:
			// NOTE: magic and dragons ahead
			
			if (!$menu) {
				return FALSE;
			}
			
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			$return = array(); // Asexual Adam
			$parents = array(); // Asexual Children
			foreach ($menu_items as $menu_item_obj) {
				$menu_item = (array) $menu_item_obj;
				$item_parent_id = $menu_item['menu_item_parent'];
				if (isset($prev_item) && (int) $item_parent_id !== 0){
					if ($item_parent_id == $prev_item['ID']) {
						$parent = &$prev_item;
						$ref = &$parent['children'][]; // Make Asexual Babies
					} elseif ($item_parent_id == $prev_parent['ID']) {
						$parent = &$prev_parent;
						$ref = &$parent['children'][];
					} else {
						// search for parent
						if (isset($parents[$item_parent_id])) {
							$parent = &$parents[$item_parent_id];
							$ref = &$parent['children'][];
						} else {
							$ref = &$return[]; // Orphan
							$parent = &$ref;
						}
					}
				} else {
					$ref = &$return[]; // Son Of Adam
					$parent = &$ref;
				}
				
				// Give Birth
				$ref = $menu_item;
				
				$prev_item = &$ref;
				$prev_parent = &$parent;
				if (!isset($parents[$parent['ID']])) {
					$parents[$parent['ID']] = &$parent;
				}
			}
			unset($parents); // Does this make me a serial killer?
			
			return $return;
		} else {
			return FALSE; // doesn't exist
		}
	}
	
	public function page_title($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		return get_the_title($id);
	}
	
	public function post_title($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		return get_the_title($id);
	}
	
	public function page_content($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		return apply_filters( 'the_content', get_the_content($id) );
	}
	
	public function post_content($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		return apply_filters( 'the_content', get_the_content($id) );
	}
	
	public function post_excerpt($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		$excerpt  = get_the_excerpt($id);
		$excerpt .= '<a class="ui mini blue button article read more" href="'.get_permalink($id).'#more-'.$id.'" title="'. __( 'Read', 'semantic_ui' ) . esc_attr("Read '".get_the_title($id)."'").'">'.__( 'Continue Reading &raquo;').'</a>';
		return $excerpt;
	}
	
	public function post_has_img($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
	}
	
	/**
	 * This function returns a detailed array of
	 * information for a post's featured image if it
	 * exists. If the post does not have a featured
	 * image, returns FALSE;
	 * 
	 * @param  int $id  The post id
	 * @return [type]   Information array OR false
	 */
	public function post_img_info($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		if (has_post_thumbnail($id)) {
			$img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
			$img_info = array(
				'url'     => $img[0],
				'width'   => $img[1],
				'height'  => $img[2],
				'resized' => $img[3]
			);
			$parsed_url = parse_url($img[0]);
			$pathinfo = pathinfo($parsed_url['path']);
			
			return $img_info + $parsed_url + $pathinfo;
		} else {
			return FALSE;
		}
	}
	
	public function post_tags($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		
		return get_the_tags($id);
		
	}
	
	public function page_comments($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		comments_template();
	}
	
	public function post_comments($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		comments_template();
	}
	
	/**
	 * function template
	 */
	public function _($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		
	}
	
}