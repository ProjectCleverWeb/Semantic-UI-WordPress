<div class="ui secondary pointing menu theme-options-menu" style="display:none" id="theme-options-menu">
		<a class="general item" href="javascript: theme_options_display('general');">
			<i class="wrench icon"></i>
			General
		</a>
		<a class="meta-tags item" href="javascript: theme_options_display('meta-tags');">
			<i class="setting icon"></i>
			Meta Tags
		</a>
		<a class="about item" href="javascript: theme_options_display('about');">
			<i class="book icon"></i>
			About
		</a>
</div>

<form method="POST" action="<?php echo theme::options_uri(); ?>">
	<?php
	// This makes sure that the changes will be accepted
	theme::options_update_data();
	?>
	<section class="theme-options-section default" id="theme-options-general">
		<h3 class="ui inverted black block header section-header">General</h3>
		<?php theme::part('content-general', 'content', 'theme-options-general'); ?>
	</section>
	<section class="theme-options-section" id="theme-options-meta-tags">
		<h3 class="ui inverted black block header section-header">Meta Tags</h3>
		<?php theme::part('content-meta-tags', 'content', 'theme-options-meta-tags'); ?>
	</section>
	<section class="theme-options-section" id="theme-options-about">
		<h3 class="ui inverted black block header section-header">About</h3>
		<?php theme::part('content-about', 'content', 'theme-options-about'); ?>
	</section>
	
	<br>
	
	<div class="ui buttons">
		<a class="ui button" href="<?php echo theme::options_uri(); ?>">Cancel</a>
		<button type="submit" class="ui positive submit button">Save All</button>
	</div>
</form>
