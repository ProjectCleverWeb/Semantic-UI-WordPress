<?php
/**
 * The "Sidebar: Left" Layout
 * 
 * This layout has the sidebar on the left side.
 */

get_header();
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
		<?php theme::part('loop', 'content', 'loop', get_post_format()); ?>
	</main>
</div>
<?php
get_footer();
