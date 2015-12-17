<?php
/*
Template Name: Sidebar: Both
*/

theme_header();
?>
<div class="ui stackable grid">
	<div class="four wide column">
		<?php
		$left_sidebar = 'sidebar-widget-area-left';
		if (is_active_sidebar($left_sidebar)) {
			dynamic_sidebar($left_sidebar);
		} else {
			echo 'The left sidebar does not have any widgets!';
		}
		?>
	</div>
	<main class="eight wide column">
		<?php template_part($theme->content_sub_path.'/loop', $theme->post_type); ?>
	</main>
	<div class="four wide column">
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
