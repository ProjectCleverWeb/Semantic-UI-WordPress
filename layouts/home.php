<?php
/**
 * The "Home Page" Layout
 * 
 * This layout allows the home page layout to be different from the rest of
 * the site. By default it is identical to the "default" layout.
 */

get_header();
?>
<div class="ui stackable grid">
	<main class="eleven wide column">
		<?php theme::part('loop', 'content', 'loop'); ?>
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
