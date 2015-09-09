<?php
/**
 * This template loads in the WordPress Dashboard, but produces an error any
 * time it is loaded by someone without the permissions to "Edit Theme Options"
 */

if (current_user_can('edit_theme_options')) {
	?>
	<div id="theme-options-page" class="ui basic segment" style="max-width:99%;">
		<h1 class="ui huge header">
			Theme Options
		</h1>
		
		<?php template_part($theme->content_sub_path.'/theme-options/page'); ?>
	</div>
	<?php
} else {
	echo 'You do not have permission to edit theme options.';
}
