<?php
/**
 * Custom nav menu walker class
 */

namespace semantic\walker;

/**
 * Custom nav menu walker class
 */
class nav_menu extends abstract_nav_menu {
	
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see \Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent  = str_repeat("\t", $depth);
		$output .= "\n$indent<i class=\"dropdown icon\"></i><span class=\"menu\">\n";
	}
	
	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see \Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent  = str_repeat("\t", $depth);
		$output .= "$indent</span>\n";
	}
	
	/**
	 * Start the element output.
	 *
	 * @see \Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		
		$classes   = empty($item->classes) ? array() : (array) $item->classes;
		if (in_array('menu-item-has-children', $classes)) {
			$classes[] = 'ui dropdown';
		}
		$classes[] = 'item';
		$classes[] = 'menu-item-' . $item->ID;
		
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';
		
		$output .= $indent . '<span' . $id . $class_names .'>';
		
		$atts           = array();
		$atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target)     ? $item->target     : '';
		$atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
		$atts['href']   = !empty($item->url)        ? $item->url        : '';
		
		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
		
		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (! empty($value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
	
	/**
	 * Ends the element output, if needed.
	 *
	 * @see \Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_el(&$output, $item, $depth = 0, $args = array()) {
		// $output .= '</a>';
		// $output .= $args->after;
		$output .= "</span>\n";
	}
}
