<?php
/**
 * WordPress integrations class
 */

namespace semantic;

/**
 * WordPress integrations class
 * 
 * This class class holds all the functions that integrate directly with WordPress
 */
class integrations extends abstract_base {
	
	/**
	 * Instance of the theme class
	 * @var theme
	 */
	public $theme;
	
	/**
	 * For whatever reason, we need to make sure it grabs the "right" theme global
	 */
	public function __construct() {
		$this->theme = $GLOBALS['theme'];
		parent::__construct();
	}
	
	/**
	 * Registers various WordPress features
	 * 
	 * @return void
	 */
	public function init() {
		// Set the max content width (used by wordpress)
		global $content_width;
		$theme         = $this->theme;
		$content_width = 1200;
		
		// Tell WordPress what this theme supports
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('woocommerce');
		add_theme_support('html5', array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form'
		));
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'link',
			'quote',
			'video'
		));
		add_theme_support('custom-background', array(
			'default-color'          => '35bdb2',
			'default-repeat'         => 'repeat',
			'default-position-x'     => 'center',
			'default-attachment'     => 'scroll',
		));
		
		// TIP: Use wp_nav_menu(array('theme_location' => 'menu-name')) to fetch these
		register_nav_menus(array(
			'main-menu'   => __('Main Menu', $theme::TEXT_DOMAIN),
			'footer-menu' => __('Footer Menu', $theme::TEXT_DOMAIN)
		));
		
		// The WP file editor is an abomination. May God help you if you or anyone
		// in your company actually uses this.
		if (in_array($GLOBALS['pagenow'], array('theme-editor.php'))) {
			if ($theme->get_option('theme_editor') == FALSE) {
				wp_die('<p>'.__(sprintf(
					'In order to edit this theme, you must first re-enable the theme editor via the <a href="%s">Theme Options</a> page',
					$theme->options_uri()
				), $theme::TEXT_DOMAIN).'</p>');
			}
		}
		
		// Remove WP's emoji
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}
	
	/**
	 * Registers the theme widget areas.
	 * 
	 * @return void
	 */
	public function widgets_init() {
		$theme = $this->theme;
		register_sidebar(array(
			'name'          => __('Right Sidebar Widget Area', $theme::TEXT_DOMAIN),
			'id'            => 'sidebar-widget-area-right',
			'description'   => 'These widgets are only visible when the siderbar is on the right side of the page',
			'before_widget' => '<aside id="%1$s" class="wp-widget sidebar-right-widget %2$s ui basic segment">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="ui dividing header widget-title">',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name'          => __('Left Sidebar Widget Area', $theme::TEXT_DOMAIN),
			'id'            => 'sidebar-widget-area-left',
			'description'   => 'These widgets are only visible when the siderbar is on the left side of the page',
			'before_widget' => '<aside id="%1$s" class="wp-widget sidebar-left-widget %2$s ui basic segment">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="ui dividing header widget-title">',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name'          => __('Footer Widget Area', $theme::TEXT_DOMAIN),
			'id'            => 'footer-widget-area-footer',
			'description'   => 'These widgets are visible in the footer',
			'before_widget' => '<div class="column"><aside id="%1$s" class="wp-widget sidebar-right-widget %2$s ui basic segment">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h4 class="ui dividing header widget-title">',
			'after_title'   => '</h4>'
		));
	}
	
	/**
	 * Registers all the theme styles/scripts
	 * 
	 * @return void
	 */
	public function register_enqueue() {
		// Styles
		wp_register_style('normalize', $this->theme->style_uri.'/normalize.min.css', array(), '3.0.3');
		wp_register_style('semantic', $this->theme->asset_uri.'/semantic-ui/semantic.min.css', array(), '2.1.3');
		wp_register_style('font-awesome', $this->theme->style_uri.'/font-awesome.min.css', array(), '4.1.0');
		wp_register_style('webicons', $this->theme->style_uri.'/webicons.min.css', array(), NULL);
		wp_register_style('highlightjs', $this->theme->style_uri.'/highlight.js/github.min.css', array(), '8.0');
		wp_register_style('main', $this->theme->style_uri.'/main.css', array(), NULL);
		wp_register_style('dashboard', $this->theme->style_uri.'/dashboard.css', array(), NULL);
		wp_register_style('base-concat', $this->theme->style_uri.'/base.concat.min.css', array(), NULL);
		// Scripts
		wp_register_script('webfonts', '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', array(), '2.1.3');
		if (!(is_admin() || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')))) {
			// Use a custom version of jQuery
			wp_deregister_script('jquery');
			wp_register_script('jquery', $this->theme->script_uri.'/jquery-2.1.1.min.js', array(), '2.1.1');
		}
		wp_register_script('semantic', $this->theme->asset_uri.'/semantic-ui/semantic.min.js', array(), '2.1.3');
		wp_register_script('highlight', $this->theme->script_uri.'/highlight.pack.min.js', array('jquery'), '8.0');
		wp_register_script('mousetrap', $this->theme->script_uri.'/mousetrap.min.js', array('jquery'), '1.4.6');
		wp_register_script('main', $this->theme->script_uri.'/main.js', array(), NULL);
		wp_register_script('theme-options', $this->theme->script_uri.'/theme-options.js', array(), NULL);
		wp_register_script('base-concat', $this->theme->script_uri.'/base.concat.min.js', array(), NULL);
	}
	
	/**
	 * Enqueues the theme styles/scripts
	 * 
	 * @return void
	 */
	public function enqueue() {
		// Styles
		// wp_enqueue_style('normalize');
		// wp_enqueue_style('font-awesome');
		// wp_enqueue_style('webicons');
		// wp_enqueue_style('highlightjs');
		wp_enqueue_style('base-concat'); // has: normalize, font-awesome, webicons, highlightjs, semantic
		wp_enqueue_style('semantic');
		wp_enqueue_style('main');
		// Scripts
		wp_enqueue_script('webfonts');
		// wp_enqueue_script('jquery');
		// wp_enqueue_script('highlight');
		// wp_enqueue_script('mousetrap');
		wp_enqueue_script('base-concat'); // has: jquery, semantic, highlight, mousetrap
		wp_enqueue_script('semantic');
		wp_enqueue_script('main');
		if (is_singular()) {
			wp_enqueue_script('comment-reply');
		}
	}
	
	/**
	 * Registers the options page with WordPress, and enqueues style/scripts for
	 * the options page in the dashboard. Only visible to users who can edit theme
	 * options.
	 * 
	 * @return void
	 */
	public function options() {
		$theme = $this->theme;
		wp_enqueue_style('normalize');
		wp_enqueue_style('semantic');
		wp_enqueue_style('font-awesome');
		wp_enqueue_style('dashboard');
		if (current_user_can('edit_theme_options')) {
			if (isset($_GET['page']) && $_GET['page'] == $theme::identifier.'_options') {
				// Styles
				wp_enqueue_style('webicons');
				wp_enqueue_style('highlight');
				// Scripts
				wp_enqueue_script('webfonts');
				wp_enqueue_script('semantic');
				wp_enqueue_script('highlight');
				wp_enqueue_script('mousetrap');
				// There are a few good reasons that you should replace your main.js with
				// the theme-options.js; such as, jQuery is already included in the
				// dashboard and it runs in safe mode.
				wp_enqueue_script('theme-options');
			}
		}
		if (function_exists('add_theme_page')) {
			add_theme_page(
				'Theme Options',
				'Theme Options',
				'edit_theme_options',
				$theme::identifier.'_options',
				array($this, 'options_page')
			);
		}
	}
	
	/**
	 * Displays the options page content when called
	 * 
	 * @return void
	 */
	public function options_page() {
		template_part($this->theme->template_sub_path.'/theme-options');
	}
	
	/**
	 * This adds a "Theme Options" link to the WordPress admin bar under the menu
	 * with the site name. Is only visible to users who can edit theme options.
	 * 
	 * @param  object $wp_admin_bar The wp_admin_bar object as supplied by WordPress
	 * @return void
	 */
	public function admin_bar_links($wp_admin_bar) {
		if (current_user_can('edit_theme_options')) {
			$wp_admin_bar->add_node(array(
				'id'     => 'theme-options',
				'parent' => 'site-name',
				'title'  => 'Theme Options',
				'href'   => $this->theme->options_uri()
			));
		}
	}
	
	/**
	 * Improve the existing wp_title()
	 *
	 * @param  string $title Default HTML page title for current view.
	 * @param  string $sep   [optional] The separator to use.
	 * @return string        The resulting title.
	 */
	public function wp_title($title, $sep = '') {
		global $page, $paged;
		settype($title, 'string');
		settype($sep, 'string');
		$title    = trim(trim(trim($title), $sep));
		$real_sep = trim($sep);
		$sep      = ' '.$real_sep.' ';
		$t_arr    = array();
		
		if (!empty($title)) {
			$t_arr[] = $title;
		}
		
		if (empty($real_sep)) {
			$sep = ' ';
		}
		
		if (is_feed()) {
			return $title;
		}
		
		// Add the blog name
		$t_arr[] = get_bloginfo('name', 'display');
		
		// Add a page number if necessary:
		if (($paged >= 2 || $page >= 2) && !is_404()) {
			$t_arr[] = sprintf('Page %1$s', max($paged, $page));
		}
		
		return implode($sep, $t_arr);
	}
	
	/**
	 * Adds a field to the user profile page so they can add their Google Plus URL
	 * and be correctly marked as an author in posts they create
	 * 
	 * @param  array    $profile_fields The contact fields array as provided by wordpress
	 * @return string[]                 The resulting array after the field has been added.
	 */
	public function google_author($profile_fields) {
		$profile_fields['gplus'] = 'Google+ URL (for authorship)';
		return $profile_fields;
	}
	
	/**
	 * Adds the theme's stylesheets to the post/page editor. This allows the visual
	 * editor to more accurately represent what will be shown on the page.
	 * 
	 * @return void
	 */
	public function editor_styles() {
		add_editor_style($this->theme->style_sub_path.'/semantic.min.css');
		add_editor_style($this->theme->style_sub_path.'/font-awesome.min.css');
		add_editor_style($this->theme->style_sub_path.'/webicons.min.css');
		add_editor_style($this->theme->style_sub_path.'/main.css');
	}
	
	/**
	 * Adds the class "active" to the current menu item
	 * 
	 * @param  array $classes The array of classes as given by WordPress
	 * @return array          The modified array of classes
	 */
	public function current_nav($classes) {
		if(in_array('current-menu-item', $classes)) {
			$classes[] = 'active';
		}
		return $classes;
	}
	
	/**
	 * Replaces the default WordPress search form with one that uses Semantic UI.
	 * 
	 * @return string The resulting form
	 */
	public function search_form() {
		// Avoid extra whitespace when a return goes to WordPress
		$query = get_search_query();
		return sprintf(
			'<form role="search" method="GET" action="%1$s">'.
				'<div class="ui small fluid action input">'.
					'<input type="text" name="s" placeholder="%3$s">'.
					'<div type="submit" class="ui small button">%2$s</div>'.
				'</div>'.
			'</form>',
			home_url('/'),
			'Search',
			(empty($query) ? 'Search...' : $query)
		);
	}
	
	/**
	 * Replaces the default WordPress footer with one that has a paypal donation
	 * link.
	 * 
	 * @return void
	 */
	public function dashboard_footer() {
		?>
		<div class="ui center aligned two column grid inverted segment">
			<div class="column">
				<h2 class="ui inverted header">
					Thank You!
					<div class="sub header">If you found this WordPress theme useful, please consider donating:</div>
				</h2>
				
				<p>
					<?php
					$fmt = '<a class="ui tiny basic inverted blue button" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=%2$s">%1$s</a>'.PHP_EOL;
					
					printf($fmt, 'Donate $5', '2WLFNB3UMSELN');
					printf($fmt, 'Donate $10', 'J42MM3FSZTPPQ');
					printf($fmt, 'Custom Donation', 'DPSN8V5VVMHTA');
					?>
				</p>
			</div>
			<div class="column">
				<h2 class="ui inverted header">
					Having Issues?
					<div class="sub header">If you have any problems or discover any bugs let us know!</div>
				</h2>
				<a class="ui tiny basic inverted blue button" target="_blank" href="https://github.com/ProjectCleverWeb/Semantic-UI-WordPress/issues">Issue Tracker</a>
				<a class="ui tiny basic inverted blue button" target="_blank" href="http://semantic-ui.com/">Semantic UI Docs</a>
				<a class="ui tiny basic inverted blue button" target="_blank" href="http://jsfiddle.net/efp8z6Ln/">Test Code</a>
			</div>
		</div>
		<?php
	}
	
	/**
	 * Replaces the output of the_post_thumbnail()
	 * 
	 * @param  string  $html          The orginal HTML (ignored)
	 * @param  string  $post_id       The Post ID as provided by WordPress
	 * @param  integer $post_image_id The Attachment ID as provided by WordPress
	 * @return string                 The replacement HTML
	 */
	public function post_thumbnail($html, $post_id, $post_image_id) {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id((string) $post_id), 'single-post-thumbnail');
		$alt   = get_post_meta($post_image_id, '_wp_attachment_image_alt');
		
		if (!isset($alt[0])) {
			$alt = array('');
		}
		
		return sprintf(
			'<img itemprop="image" src="%1$s" alt="%2$s">',
			$image[0],
			trim(strip_tags($alt[0]))
		);
	}
	
	/**
	 * Sets theme::$post_type
	 * 
	 * @param  string $template The input string (ignored)
	 * @return string           The input string (ignored)
	 */
	public function set_post_type($template) {
		global $debug, $theme;
		$theme->post_type = get_post_format();
		if (empty($theme->post_type)) {
			$theme->post_type = get_post_type();
		}
		$debug->runtime_checkpoint('[Theme] theme::$post_type set to "'.$theme->post_type.'"');
		return $template;
	}
}
