<?php
/**
 * Initialize all the WordPress integrations.
 * 
 * Keeping these in a seperate file from the function declarations adds a little
 * more organization to the whole process, and makes them easier to find.
 * 
 * @package Semanitic UI for WordPress
 */

add_filter('admin_footer_text',   'semantic_ui_dashboard_footer');
add_action('after_setup_theme',   'semantic_ui_init');
add_action('admin_menu',          'semantic_ui_options');
add_action('admin_bar_menu',      'semantic_ui_admin_bar_links', 999);
add_filter('get_search_form',     'semantic_ui_search_form');
add_action('init',                'semantic_ui_editor_styles');
add_filter('nav_menu_css_class' , 'semantic_ui_current_nav' , 10 , 2);
add_filter('user_contactmethods', 'semantic_ui_google_author');
add_action('widgets_init',        'semantic_ui_widgets_init');
add_action('wp_enqueue_scripts',  'semantic_ui_enqueue');
add_filter('wp_title',            'semantic_ui_wp_title', 10, 2);
