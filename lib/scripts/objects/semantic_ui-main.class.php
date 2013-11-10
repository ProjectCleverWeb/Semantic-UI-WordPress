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
		
		$t->data_class = $t->get_data_class();
		
		// quick way to do multi-layer stdClass's
		$t->settings = $data_class->settings;
		
		// no global declaring these, makes it easier to swap the top level var
		require_once __DIR__.'/semantic_ui-vars.class.php';
		new vars($t);
		require_once __DIR__.'/semantic_ui-tools.class.php';
		$t->tools = new tools($t->settings->general);
		require_once __DIR__.'/semantic_ui-menu.class.php';
		$t->menu = new menu($t->settings->general);
		require_once __DIR__.'/semantic_ui-post.class.php';
		$t->post = new post($t->settings->post);
		require_once __DIR__.'/semantic_ui-page.class.php';
		$t->page = new page($t->settings->page);
		require_once __DIR__.'/semantic_ui-widget.class.php';
		new widget($t->settings->page);
	}
	
	/**
	 * Anything that needs to be done right after SUI is loaded goes in here
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function init() {
		$this->data_class->init();
	}
	
	/**
	 * This determines which $data_class to get
	 * 
	 * Currently only supports WordPress
	 * 
	 * @return void
	 */
	private function get_data_class() {
		require_once __DIR__.'/semantic_ui-data_class.interface.php';
		require_once __DIR__.'/semantic_ui-wp.class.php';
		return new \semantic_ui\wp;
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

