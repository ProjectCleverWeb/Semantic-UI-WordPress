<?php
/**
 * The theme header without the visible header.
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php theme::part('head', 'content', 'head'); ?>
</head>
<body <?php body_class('public-page'); ?>>
	<div id="page-wrapper">
		<div id="page-container">
			<div class="ui page stackable grid" id="main-content-grid">
				<div class="sixteen wide column"><?php
