<div id="theme-options-page" class="ui basic segment" style="max-width:99%;">
	<div class="ui segment">
		<h1 class="ui huge header">
			Theme Options
		</h1>
		
		<?php theme::part('content', 'content', 'theme-options'); ?>
	</div>
	<div class="ui segment">
		<h3 class="ui small header">Thank You!</h3>
		<p>Thank you for using Semantic UI for WordPress. If you have any problems or discover any bugs, please let me know in the <a href="https://github.com/ProjectCleverWeb/Semantic-UI-WordPress/issues">Github Issue Tracker</a>.</p>
		<p>If you found this WordPress theme useful, please consider donating: (Paypal)</p>
		<p>
			<?php
			$fmt = '<a class="ui small blue button" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=%2$s">%1$s</a>'.PHP_EOL;
			
			printf($fmt, 'Donate $5', '2WLFNB3UMSELN');
			printf($fmt, 'Donate $10', 'J42MM3FSZTPPQ');
			printf($fmt, 'Custom Donation', 'DPSN8V5VVMHTA');
			?>
		</p>
	</div>
</div>