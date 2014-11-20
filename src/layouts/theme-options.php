<div id="theme-options-page" class="ui basic segment" style="max-width:99%;">
	<div class="ui basic segment">
		<h1 class="ui huge header">
			Theme Options
		</h1>
		
		<!-- <div class="ui nag" id="issue-tracker-nag">
			<span class="title">
				If you have any problems or discover any bugs, please let me know in the <a href="https://github.com/ProjectCleverWeb/Semantic-UI-WordPress/issues">Github Issue Tracker</a>.
			</span>
			<i class="close icon"></i>
		</div> -->
		
		<?php theme::part('content', 'content', 'theme-options'); ?>
	</div>
	<div class="ui inverted segment">
		<h2 class="ui inverted header">
			Thank You!
			<div class="sub header">Thank you for using Semantic UI for WordPress. If you found this WordPress theme useful, please consider donating:</div>
		</h2>
		
		<p>
			<?php
			$fmt = '<a class="ui small basic inverted blue button" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=%2$s">%1$s</a>'.PHP_EOL;
			
			printf($fmt, 'Donate $5', '2WLFNB3UMSELN');
			printf($fmt, 'Donate $10', 'J42MM3FSZTPPQ');
			printf($fmt, 'Custom Donation', 'DPSN8V5VVMHTA');
			?>
		</p>
		<h4 class="ui inverted header">
			<i class="lock icon"></i>
			<div class="content">
				All transactions secured through Paypal
			</div>
		</h4>
	</div>
</div>
