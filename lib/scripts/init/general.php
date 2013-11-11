<?php
/**
 * This handles giving WP additional functionality
 * and allows you to easily modify/disable/enable
 * individual features
 * 
 * Author: Nicholas Jordon
 */

use \semantic_ui\wp\general as general;
$ref   = \semantic_ui\vars::$ref;
$tools = $ref->tools;

$widget_areas = array(
	array(
		'id'   => 'sidebar',
		'name' => 'Sidebar Widgets',
		'desc' => 'The sidebar widget area.',
	),
	array(
		'id'   => 'footer',
		'name' => 'Footer Widgets',
		'desc' => 'The footer widget area.',
	)
);

general::add_widget_areas($widget_areas);



?>
