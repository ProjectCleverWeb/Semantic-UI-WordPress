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
						1.0 - Theme Templates
					</a>
					<div class="content menu">
						<a class="item">1.1 - Template Breakdown</a>
						<a class="item">1.2 - How Templates Are Fetched</a>
						<a class="item">1.3 - Designing New Templates</a>
						<a class="item">1.4 - Making Sub-Templates</a>
					</div>
				</div>
				
				<div class="item">
					<a class="title">
						<i class="dropdown icon"></i>
						2.0 - Theme Options Page
					</a>
					<div class="content menu">
						<a class="item">2.1 - Modifying Options</a>
						<a class="item">2.2 - Modifying Tabs</a>
						<a class="item">2.3 - Options And The Database</a>
						<a class="item">2.4 - Security</a>
					</div>
				</div>
				
				<div class="item">
					<a class="title">
						<i class="dropdown icon"></i>
						3.0 - The Theme Class
					</a>
					<div class="content menu">
						<a class="item">3.1 - Overview</a>
						<a class="item">3.2 - Fetching Theme Parts</a>
						<a class="item">3.3 - Identifier</a>
						<a class="item">3.4 - Path Manager</a>
						<a class="item">3.5 - Options Manager</a>
					</div>
				</div>
				
				<div class="item">
					<a class="title">
						<i class="dropdown icon"></i>
						4.0 - The Integration Classes
					</a>
					<div class="content menu">
						<a class="item">4.1 - Overview</a>
						<a class="item">4.2 - wp-init and wp_integrations</a>
						<a class="item">4.3 - Theme Support</a>
						<a class="item">4.4 - Sidebars And Widget Areas</a>
						<a class="item">4.5 - Enqueue</a>
						<a class="item">4.6 - Post Editor Styles</a>
						<a class="item">4.7 - Other</a>
					</div>
				</div>
				
				<div class="item">
					<a class="title">
						<i class="dropdown icon"></i>
						5.0 - Recommendations
					</a>
					<div class="content menu">
						<a class="item">5.1 - Rec 1</a>
						<a class="item">5.2 - Rec 2</a>
						<a class="item">5.3 - Rec 3</a>
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
	// A little script to make the nav menu scroll with the page
	jQuery(document).ready(function(){
		jQuery(this).scroll(function() {
			if (jQuery(this).scrollTop() > 105 && jQuery(this).width() >= 770) {
				jQuery('#notes-menu').css('margin-top', (jQuery(this).scrollTop() - 105));
			} else {
				jQuery('#notes-menu').css('margin-top', 0);
			}
		});
		// If on mobile, no scroll, just sit at the top
		jQuery(this).resize(function() {
			if (jQuery(this).width() < 770) {
				jQuery('#notes-menu').css('margin-top', 0);
			};
		})
	});
</script>