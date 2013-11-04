<?php
namespace semantic_ui;

/**
 * This class allows SUI to interface with WP
 */
class wp implements data_class {
	
	public function __construct() {
		
		
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
		} elseif (is_attachment($id)) {
			return 'ATTACHMENT';
		} else {
			return 'POST'; // most common, default until more options added
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
		return get_the_content($id);
	}
	
	public function post_content($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		return get_the_content($id);
	}
	
	public function post_excerpt($id = FALSE) {
		if (!$id) {
			$id = get_the_id();
		}
		return get_the_excerpt($id);
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