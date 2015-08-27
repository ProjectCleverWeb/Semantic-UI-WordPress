<?php
/**
 * Initialize all the WordPress integrations.
 * 
 * Keeping these in a seperate file from the function declarations adds a little
 * more organization to the whole process, and makes them easier to find.
 */

$integrations = new \semantic\wp_integrations;

// Alphebetical based on the callback (doesn't effect the order they are called)
add_action('admin_bar_menu',      array($integrations, 'admin_bar_links'), 999);
add_filter('nav_menu_css_class',  array($integrations, 'current_nav'), 10, 1);
add_filter('admin_footer_text',   array($integrations, 'dashboard_footer'));
add_action('init',                array($integrations, 'editor_styles'), 11);
add_action('wp_enqueue_scripts',  array($integrations, 'enqueue'));
add_filter('user_contactmethods', array($integrations, 'google_author'));
add_action('after_setup_theme',   array($integrations, 'init'));
add_action('admin_menu',          array($integrations, 'options'));
add_filter('post_thumbnail_html', array($integrations, 'post_thumbnail'), 10, 3);
add_action('init',                array($integrations, 'register_enqueue'), 10);
add_filter('get_search_form',     array($integrations, 'search_form'));
add_action('widgets_init',        array($integrations, 'widgets_init'));
add_filter('wp_title',            array($integrations, 'wp_title'), 10, 2);
