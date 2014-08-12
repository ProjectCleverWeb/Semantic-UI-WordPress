<?php
/**
 * The "First-Run" Layout
 */
?>
<h1 class="ui dividing header">
	Developer Notes
	<div class="sub header">aka The "Getting Started" Page</div>
</h1>
<div class="ui basic segment">
	
	<div class="ui stackable grid">
		<div class="four wide column">
			
			<div class="ui basic fluid vertical accordion menu" id="notes-menu">
				<div class="header item">Navigation Menu</div>
				
				<div class="item">
					<a class="title">
						<i class="dropdown icon"></i>
						Theme Options Page
					</a>
					<div class="content menu">
						<a class="item">Template Breakdown</a>
						<a class="item">Modifying Options</a>
						<a class="item">Modifying Tabs</a>
					</div>
				</div>
				
				<div class="item">
					<a class="title">
						<i class="dropdown icon"></i>
						Theme Templates
					</a>
					<div class="content menu">
						<a class="item">Template Breakdown</a>
						<a class="item">Modifying Options</a>
						<a class="item">Modifying Tabs</a>
					</div>
				</div>
			</div>
			
			
		</div>
		<div class="twelve wide column">
			
			<?php theme::part('content', 'content', 'dev-notes'); ?>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function(){
		jQuery(document).scroll(function() {
			if (jQuery(this).scrollTop() > 105 && jQuery(document).width() >= 770) {
				jQuery('#notes-menu').css('margin-top', (jQuery(this).scrollTop() - 105));
			} else {
				jQuery('#notes-menu').css('margin-top', 0);
			}
		});
		jQuery(document).resize(function() {
			if (jQuery(document).width() < 770) {
				jQuery('#notes-menu').css('margin-top', 0);
			};
		})
	});
</script>