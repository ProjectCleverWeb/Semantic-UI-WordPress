<?php
/*
Template Name: Sidebar: Left
*/

theme_header();
?>
<div class="ui stackable grid">
	<div class="five wide column">
		<?php
		$left_sidebar = 'sidebar-widget-area-left';
		if (is_active_sidebar($left_sidebar)) {
			dynamic_sidebar($left_sidebar);
		} else {
			echo 'The left sidebar does not have any widgets!';
		}
		?>
	</div>
	<main class="eleven wide column">
		<?php template_part($theme->content_sub_path.'/loop', $theme->post_type); ?>
	</main>
</div>
<?php
theme_footer();
