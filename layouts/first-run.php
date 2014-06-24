<?php
/**
 * The "First-Run" Layout
 */

get_header();
?>
<main>
	<h1 class="ui center aligned dividing header">
		Welcome!
		<?php
		if (current_user_can('edit_theme_options')) {
			?>
			<div class="sub header">This is the first-run page, you can disable it any time on the <a href="<?php echo theme::options_uri(); ?>">Theme Options Page</a>.</div>
			<?php
		}
		?>
	</h1>
	<?php theme::part('content', 'content', 'first-run'); ?>
</main>
<?php
get_footer();
