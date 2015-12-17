<?php
/**
 * The default theme template
 * 
 * Shows pages as the default template without any sidebars.
 */


theme_header();
?>
<div class="ui stackable grid">
	<main class="eleven wide column">
		<?php template_part($theme->content_sub_path.'/loop', $theme->post_type); ?>
	</main>
	<div class="five wide column">
		<?php
		$right_sidebar = 'sidebar-widget-area-right';
		if (is_active_sidebar($right_sidebar)) {
			dynamic_sidebar($right_sidebar);
		} else {
			echo 'The right sidebar does not have any widgets!';
		}
		?>
	</div>
</div>
<?php
theme_footer();
