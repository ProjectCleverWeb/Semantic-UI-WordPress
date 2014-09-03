<?php
/**
 * The "First-Run" Layout
 */

get_header();
?>
<main>
	
	<div class="empty size-10">&nbsp;</div>
	
	<h1 class="ui center aligned dividing header">
		Welcome to Semantic UI for WordPress!
		<?php
		if (current_user_can('edit_theme_options')) {
			?>
			<div class="sub header">This is the first-run page, you can disable it from the <a href="<?php echo theme::options_uri(); ?>">Theme Options</a> page.</div>
			<?php
		} else {
			?>
			<div class="sub header">This is the first-run page, <strong>once you login</strong>, you can disable it from the Theme Options page.</div>
			<?php
		}
		?>
	</h1>
	<div class="ui basic segment">
		<?php theme::part('content', 'content', 'first-run'); ?>
	</div>
</main>
<?php
get_footer();
