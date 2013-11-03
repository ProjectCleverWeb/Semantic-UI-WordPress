<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard.

Author: Nicholas Jordon
*/

/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );    // Right Now Widget
	// remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
	// remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
	// remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget
	
	// remove_meta_box('dashboard_quick_press', 'dashboard', 'core' );  // Quick Press Widget
	// remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
	// remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         //
	// remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       //
	
	// removing plugin dashboard boxes
	// remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );         // Yoast's SEO Plugin Widget
}


// removing the dashboard widgets
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );


/************* CUSTOM LOGIN PAGE *****************/

// the css
function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'login_css', 10 );
add_filter( 'login_headerurl', 'login_url' );
add_filter( 'login_headertitle', 'login_title' );


/************* ADMIN FOOTER *******************/

if (! function_exists('dashboard_footer') ){
	function dashboard_footer () {
		echo 'Thank you for using <a href="http://semantic-ui.com">Semantic UI</a> &mdash; Theme HTML/CSS framework by <a href="https://github.com/jlukic">Jack Lukic</a> &mdash; WordPress theme framework by <a href="https://github.com/ProjectCleverWeb">Nicholas Jordon</a>';
	}
}
add_filter('admin_footer_text', 'dashboard_footer');

