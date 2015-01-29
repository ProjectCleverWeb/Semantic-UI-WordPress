<?php

namespace semantic;

class menu_walker {
	
	
	
	public function display($menu_id, $options = FALSE) {
		
		
		// $locations = get_registered_nav_menus();
		// $menus = wp_get_nav_menus();
		// $menu_locations = get_nav_menu_locations();

		// $location_id = $theme_location;
		// if (isset($menu_locations[ $location_id ])) {
		// 	foreach ($menus as $menu) {
		// 		// If the ID of this menu is the ID associated with the location we're searching for
		// 		if ($menu->term_id == $menu_locations[ $location_id ]) {
		// 			$menu_id = $menu->term_id;
		// 			break;
		// 		}
		// 	}
		// } else {
		// 	// The location that you're trying to search doesn't exist
		// }
		
		$defaults = array(
			'id'          => 'menu-%1$s',
			'class'       => '%1$s',
			'item_id'     => 'id-%1$s',
			'item_class'  => '%1$s',
			'before_text' => '',
			'after_text'  => '',
			'before_item' => '',
			'after_item'  => '',
			'no_target'   => FALSE
		);
		
		if ($options) {
			$conf = array_replace_recursive($defaults, $options);
		} else {
			$conf = $defaults;
		}
		
		$the_id = trim(sprintf($conf['id'],str_replace(' ', '-', $menu_id)));
		$the_class = trim(sprintf($conf['class'], "menu"));
		
		$menu = $this->get_menu($menu_id);
		
		if (!$menu) {
			return FALSE;
		}
		
		$items   = PHP_EOL;
		foreach ($menu as $menu_item) {
			// build attributes
			$classes    = '';
			$id         = $menu_item['ID'];
			$item_id    = trim(sprintf($conf['item_id'], $id));
			$target     = '';
			$text       = '';
			$title      = '';
			$url        = $menu_item['url'];
			
			if (!empty($menu_item['classes']) && is_array($menu_item['classes'])) {
				foreach ($menu_item['classes'] as $class) {
					$class = trim($class);
					if (!empty($class)) {
						$classes .= $class.' ';
					}
				}
				$classes = trim(sprintf($conf['item_class'], trim($classes)));
				
				if (isset($menu_item['children'])) {
					$classes = trim('ui dropdown item '.$classes);
				} else {
					$classes = trim('item '.$classes);
				}
				
				$classes = "class=\"$classes\" ";
			}
			
			if (!$conf['no_target'] && !empty($menu_item['target'])) {
				$target = 'target="'.$menu_item['target'].'" ';
			}
			
			if (!empty($menu_item['attr_title'])) {
				$text = $menu_item['attr_title'];
			} elseif (!empty($menu_item['decription'])) {
				$text = $menu_item['description'];
			} elseif (!empty($menu_item['title'])) {
				$text = $menu_item['title'];
			} elseif (!empty($menu_item['post_title'])) {
				$text = $menu_item['post_title'];
			} elseif (!empty($menu_item['post_excerpt'])) {
				$text = $menu_item['post_excerpt'];
			}
			
			if (!empty($menu_item['attr_title'])) {
				$title = 'title="'.esc_attr__($menu_item['attr_title']).'" ';
			} elseif (!empty($menu_item['decription'])) {
				$title = 'title="'.esc_attr__($menu_item['description']).'" ';
			} elseif (!empty($menu_item['post_excerpt'])) {
				$title = 'title="'.esc_attr__($menu_item['post_excerpt']).'" ';
			} elseif (!empty($menu_item['title'])) {
				$title = 'title="'.esc_attr__($menu_item['title']).'" ';
			} elseif (!empty($menu_item['post_title'])) {
				$title = 'title="'.esc_attr__($menu_item['post_title']).'" ';
			}
			
			$children = '';
			
			if (isset($menu_item['children'])) {
				// handle children
			}
			
			// Build item
			$children = '';
			if (empty($url)) {
				$fmt = '<div %1$s%2$s>'.$conf['before_item'].'<span %3$s>%4$s</span>'.$conf['after_item'].'%5$s</div>';
				if (isset($menu_item['children'])) {
					$children = $this->_display_get_children($menu_item['children'],$conf);
				}
				
				$items .= sprintf($fmt,
					$classes,
					'id="'.$id.'"',
					$title,
					$conf['before_text'].$text.$conf['after_text'],
					$children
				).PHP_EOL;
			} else {
				$link_attr = sprintf('%1$s%2$s%3$s',
					$target,
					$title,
					'href="'.$url.'"'
				);
				
				$fmt = '<div %1$s%2$s>'.$conf['before_item'].'<a %3$s>%4$s</a>'.$conf['after_item'].'%5$s</div>';
				if (isset($menu_item['children'])) {
					$children = $this->_display_get_children($menu_item['children'],$conf);
				}
				
				$items .= sprintf($fmt,
					$classes,
					'id="'.$id.'"',
					$link_attr,
					$conf['before_text'].$text.$conf['after_text'],
					$children
				).PHP_EOL;
			}
		}
		
		// now display
		echo "<div class=\"ui menu\"><nav class=\"$the_class\" id=\"$the_id\" role=\"navigation\">$items</nav></div>".PHP_EOL;
		
	}
	
	public function _display_get_children($children,$conf){
		static $depth;
		if (!$depth) {
			$depth = 0;
		}
		$depth++;
		
		$items   = PHP_EOL;
		foreach ($children as $menu_item) {
			// build attributes
			$classes    = '';
			$id         = $menu_item['ID'];
			$item_id    = trim(sprintf($conf['item_id'], $id));
			$target     = '';
			$text       = '';
			$title      = '';
			$url        = $menu_item['url'];
			
			if (!empty($menu_item['classes']) && is_array($menu_item['classes'])) {
				foreach ($menu_item['classes'] as $class) {
					$class = trim($class);
					if (!empty($class)) {
						$classes .= $class.' ';
					}
				}
				$classes = trim(sprintf($conf['item_class'], trim($classes)));
				
				// if (isset($menu_item['children'])) {
				// 	$classes = trim('ui dropdown item '.$classes);
				// } else {
					$classes = trim('item '.$classes);
				// }
				
				$classes = "class=\"$classes\" ";
			}
			
			if (!$conf['no_target'] && !empty($menu_item['target'])) {
				$target = 'target="'.$menu_item['target'].'" ';
			}
			
			if (!empty($menu_item['attr_title'])) {
				$text = $menu_item['attr_title'];
			} elseif (!empty($menu_item['decription'])) {
				$text = $menu_item['description'];
			} elseif (!empty($menu_item['title'])) {
				$text = $menu_item['title'];
			} elseif (!empty($menu_item['post_title'])) {
				$text = $menu_item['post_title'];
			} elseif (!empty($menu_item['post_excerpt'])) {
				$text = $menu_item['post_excerpt'];
			}
			
			if (!empty($menu_item['attr_title'])) {
				$title = 'title="'.esc_attr__($menu_item['attr_title']).'" ';
			} elseif (!empty($menu_item['decription'])) {
				$title = 'title="'.esc_attr__($menu_item['description']).'" ';
			} elseif (!empty($menu_item['post_excerpt'])) {
				$title = 'title="'.esc_attr__($menu_item['post_excerpt']).'" ';
			} elseif (!empty($menu_item['title'])) {
				$title = 'title="'.esc_attr__($menu_item['title']).'" ';
			} elseif (!empty($menu_item['post_title'])) {
				$title = 'title="'.esc_attr__($menu_item['post_title']).'" ';
			}
			
			$children = '';
			
			if (isset($menu_item['children'])) {
				// handle children
			}
			
			// Build item
			$children = '';
			if (empty($url)) {
				$fmt  = '<div %1$s%2$s>'.$conf['before_item'].'<span %3$s>%4$s</span>'.$conf['after_item'].'%5$s</div>';
				if (isset($menu_item['children'])) {
					$children = $this->_display_get_children($menu_item['children'],$conf);
				}
				
				$items .= sprintf($fmt,
					$classes,
					'id="'.$id.'"',
					$title,
					$conf['before_text'].$text.$conf['after_text'],
					$children
				).PHP_EOL;
			} else {
				$link_attr = sprintf('%1$s%2$s%3$s',
					$target,
					$title,
					'href="'.$url.'"'
				);
				
				$icon = '';
				if (isset($menu_item['children'])) {
					$icon     = '<i class="dropdown icon"></i>';
					$children = $this->_display_get_children($menu_item['children'],$conf);
				}
				$fmt = '<div %1$s%2$s>'.$icon.$conf['before_item'].'<a %3$s>%4$s</a>'.$conf['after_item'].'%5$s</div>';
				
				$items .= sprintf($fmt,
					$classes,
					'id="'.$id.'"',
					$link_attr,
					$conf['before_text'].$text.$conf['after_text'],
					$children
				).PHP_EOL;
			}
		}
		
		
		
		$depth--;
		return PHP_EOL."<div class=\"menu\">$items</div>".PHP_EOL;
	}
	
	
	
	
	
	
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
	
	
	
}
