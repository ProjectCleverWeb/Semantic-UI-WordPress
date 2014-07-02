<div class="ui segment">
	<div class="ui floating info message">
		<i class="close icon"></i>
		<div class="header">
			Notice
		</div>
		<p>This page serves as an example of how to create a "Theme Options" page. Even though this is only an example, the options used in this example do actually work.</p>
	</div>

	<form method="POST" action="<?php echo theme::options_uri(); ?>" class="ui form">
		<div class="inline field">
			<div class="ui toggle checkbox">
				<?php
				printf(
					'<input type="checkbox" value="1" name="%1$s" %2$s>',
					theme::option_form_name('first_run'),
					(theme::get_option('first_run') ? 'checked' : '')
				);
				?>
				<label>Show First-Run</label>
			</div>
		</div>
		<div class="inline field">
			<div class="ui toggle checkbox">
				<?php
				printf(
					'<input type="checkbox" value="1" name="%1$s" %2$s>',
					theme::option_form_name('mobile_meta'),
					(theme::get_option('mobile_meta') ? 'checked' : '')
				);
				?>
				<label>Use Mobile Meta</label>
			</div>
		</div>
		<div class="field">
			<label>Recommended Mobile Screen Width (in pixels without the "px")</label>
			<?php
			printf(
				'<input type="text" placeholder="450" name="%1$s" value="%2$s">',
				theme::option_form_name('mobile_size'),
				theme::get_option('mobile_size')
			);
			?>
		</div>
		<?php
		// This makes sure that the changes will be accepted
		theme::options_update_data();
		?>
		<div class="ui buttons">
			<a class="ui button" href="<?php echo theme::options_uri(); ?>">Cancel</a>
			<button type="submit" class="ui positive submit button">Save</button>
		</div>
	</form>
</div>

<div class="ui segment">
		<h3 class="ui small header">About Theme Options</h3>
		<p>Theme options in Semantic UI for WordPress are stored similarly to the traditional way to store options, with one exception; All of the options are actually stored in a JSON** string as 1 database value (rather than each as a seperate database row). Storing information like this is ideal because it means you can store multi-layer arrays as-is in the database.</p>
		<p>**Since there are few cases where the extra features of <code>serialize()</code> are needed, and the JSON encode/decode functions <a href="http://stackoverflow.com/questions/804045/preferred-method-to-store-php-arrays-json-encode-vs-serialize">are about twice as fast</a>; a JSON string is the default storage method.</p>
	</div>
	<div class="ui segment">
		<h3 class="ui small header">Thank You!</h3>
		<p>Thank you for using Semantic UI for WordPress. If you have any problems or discover any bugs, please let me know in the <a href="https://github.com/ProjectCleverWeb/Semantic-UI-WordPress/issues">Github Issue Tracker</a>.</p>
		<p>If you found this WordPress theme useful, please consider donating: (Paypal)</p>
		<p>
			<?php
			$fmt = '<a class="ui small positive button" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=%2$s">%1$s</a>';
			
			printf($fmt, 'Donate $5', '2WLFNB3UMSELN');
			printf($fmt, 'Donate $10', 'J42MM3FSZTPPQ');
			printf($fmt, 'Custom Donation', 'DPSN8V5VVMHTA');
			
			?>
		</p>
	</div>