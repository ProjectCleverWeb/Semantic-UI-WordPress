<?php
/**
 * The "Sidebar: Right" Layout
 * 
 * This layout has the sidebar on the right side.
 */

get_header();
?>
<div class="ui stackable grid">
	<main class="eleven wide column">
		<?php theme::part('loop', 'content', 'loop', get_post_format()); ?>
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
get_footer();
