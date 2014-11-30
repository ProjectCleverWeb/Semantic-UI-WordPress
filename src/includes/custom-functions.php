<?php
/**
 * These functions add general functionality to every page, and shouldn't have
 * a corresponding call via add_filter() or add_action() in wp-init.php
 * 
 * NOTE: It would be a good idea to put functions that add functionality to a
 * specific page or set of pages in a seperate file in the includes directory.
 * That way they can be loaded on the specifc page(s) they were meant for, and
 * not on every page.
 */


/**
 * [UNFINISHED] Generates a breadcrumb or the current page.
 * 
 * @return string The breadcrumb HTML
 */
function get_the_breadcrumb() {
	global $post;
	$str = '<ul id="breadcrumbs">';
	if (!is_home()) {
		$str .= sprintf(
			'<li><a href="%1$s">Home</a></li><li class="separator"> / </li>',
			home_url('/')
		);
		if (is_category() || is_single()) {
			$categories = get_the_category();
			if($categories){
				$cats = array();
				foreach(array_slice($categories, 0, 3) as $category) {
					$cats[] = sprintf(
						'<li><a href="%1$s">%2$s</a></li>',
						get_category_link($category->term_id),
						$category->cat_name
					);
				}
				$str .= implode('<li class="separator"> / </li>', $cats);
			}
			
			
			if (is_single()) {
				$str .= '<li class="separator"> / </li><li>'.get_the_title().'</li>';
			}
		} elseif (is_page()) {
			if($post->post_parent){
				$anc = get_post_ancestors( $post->ID );
				$title = get_the_title();
				foreach ( $anc as $ancestor ) {
					$output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator">/</li>';
				}
				$str .= $output;
				$str .= '<strong title="'.$title.'
				"> '.$title.'</strong>';
			} else {
				$str .= '<li><strong> '.get_the_title().'</strong></li>';
			}
		}
	} elseif (is_tag()) {
		single_tag_title();
	} elseif (is_day()) {
		$str .= "<li>Archive for ";
		theme::time('F jS, Y');
		$str .= '</li>';
	} elseif (is_month()) {
		$str .= "<li>Archive for ";
		theme::time('F, Y');
		$str .= '</li>';
	} elseif (is_year()) {
		$str .= "<li>Archive for ";
		theme::time('Y');
		$str .= '</li>';
	} elseif (is_author()) {
		$str .= "<li>Author Archive";
		$str .= '</li>';
	} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		$str .= "<li>Blog Archives";
		$str .= '</li>';
	} elseif (is_search()) {
		$str .= "<li>Search Results";
		$str .= '</li>';
	}
	$str .= '</ul>';
}
