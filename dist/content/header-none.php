<?php
/**
 * The theme header without the visible header.
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php template_part($theme->content_sub_path.'/head'); ?>
</head>
<body <?php body_class('public-page'); ?>>
	<div id="page-wrapper">
		<div id="page-container">
			<div class="ui middle aligned page stackable grid" id="main-content-grid">
				<div class="sixteen wide column"><?php
