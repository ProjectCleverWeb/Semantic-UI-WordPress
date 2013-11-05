<?php
namespace semantic_ui;

/**
 * This basically runs SUI
 * 
 * @since 1.0.0
 * @author NJ
 */
class main {
	
	/**
	 * This object is an interface to the Options Framework.
	 * 
	 * @var object
	 * @since 1.0.0
	 */
	public $settings;
	
	/**
	 * This allows the data source to be changed without recoding the theme framework
	 * 
	 * @var object
	 * @since  1.0.0
	 */
	public $data_class;
	
	public $post;
	public $page;
	
	public function __construct(&$ref, &$data_class){
		// why have $this when you can have $t
		$t = $this;
		$ref = $t;
		$t->data_class = $data_class;
		
		// quick way to do multi-layer stdClass's
		$t->settings = (object) array(
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
		
		// no global declaring these, makes it easier to swap the top level var
		require_once __DIR__.'/semantic_ui-tools.class.php';
		$t->tools = new tools($t->settings->general,$t);
		require_once __DIR__.'/semantic_ui-menu.class.php';
		$t->menu = new menu($t->settings->general,$t);
		require_once __DIR__.'/semantic_ui-post.class.php';
		$t->post = new post($t->settings->post,$t);
		require_once __DIR__.'/semantic_ui-page.class.php';
		$t->page = new page($t->settings->page,$t);
		
	}
	
	/**
	 * Anything that needs to be done right after SUI is loaded goes in here
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function init() {
		
	}
	
	
	
	/**
	 * Returns all info for a post from wordpress
	 * 
	 * @param  int $id  The post to get
	 * @return object   The post info
	 * 
	 * @since  1.0.0
	 */
	public function post_info($id = FALSE) {
		$t = $this;
		
		$array = array(
			'title'     => $t->post->the_title($id), // str
			'content'   => $t->post->the_content($id), // html str
			'is_sticky' => $t->post->is_sticky($id), // bool
			'image'     => $t->post->featured_img($id), // array
		);
		
		return (object) $array;
	}
	
	/**
	 * Returns all info for a page from wordpress
	 * 
	 * @param  int $id  The page to get
	 * @return object   The page info
	 * 
	 * @since  1.0.0
	 */
	public function page_info($id = FALSE) {
		$t = $this;
		
		$array = array(
			'title'     => $t->page->the_title($id), // str
			'content'   => $t->page->the_content($id), // html str
		);
		
		return (object) $array;
	}
	
	
	
	/**
	 * Function template
	 */
	public function _() {
		$t = $this;
		
	}
	
	
	
	
	
}

