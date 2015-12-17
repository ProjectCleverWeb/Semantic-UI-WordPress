<?php
/**
 * Theme Options Page Tabbing
 * ==========================
 * Creating tabs here is pretty straight forward:
 *   1. Create a tab menu link with an appropriate data-tab attribute
 *   2. Create a tab section with the matching data-tab attribute
 * 
 * That's it.
 */
?><div id="theme-options-tabs">
	
	<!-- Tab Menu -->
	<div class="ui top attached tabular menu">
		<a class="item active" data-tab="first"><i class="wrench icon"></i> General</a>
		<a class="item" data-tab="second"><i class="setting icon"></i> Meta Tags</a>
		<a class="item" data-tab="third"><i class="book icon"></i> About</a>
	</div>
	<!-- /Tab Menu -->
	
	<form class="ui bottom attached segment" method="POST" action="<?php echo $theme->options_uri(); ?>">
		<?php
		// This makes sure that the changes will be accepted
		$theme->options_update_data();
		?>
		
		<!-- Tab Sections -->
		<section class="ui tab active" data-tab="first">
			<?php template_part($theme->content_sub_path.'/theme-options/general'); ?>
		</section>
		<section class="ui tab" data-tab="second">
			<?php template_part($theme->content_sub_path.'/theme-options/meta-tags'); ?>
		</section>
		<section class="ui tab" data-tab="third">
			<?php template_part($theme->content_sub_path.'/theme-options/about'); ?>
		</section>
		<!-- /Tab Sections -->
		
		<br>
		
		<button type="submit" class="ui positive submit button">Save All Options</button>
		<a class="ui button" href="<?php echo $theme->options_uri(); ?>">Cancel</a>
	</form>
</div>
