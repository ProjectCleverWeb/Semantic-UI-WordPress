<div class="ui three column doubling grid">
	<div class="column">
		<div class="ui secondary stacked segment">
		<h3 class="ui center aligned dividing header">Mobile Meta</h3>
			<div class="ui form">
				<div class="inline field">
					<div class="ui toggle checkbox">
						<?php
						printf(
							'<input type="checkbox" value="1" name="%1$s" %2$s>',
							$theme->option_form_name('mobile_meta'),
							($theme->get_option('mobile_meta') ? 'checked' : '')
						);
						?>
						<label>Enable Mobile Meta</label>
					</div>
				</div>
				<div class="field">
					<label>Recommended Mobile Screen Width (without the "px")</label>
					<?php
					printf(
						'<input type="text" placeholder="450" name="%1$s" value="%2$s">',
						$theme->option_form_name('mobile_size'),
						$theme->get_option('mobile_size')
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="column">
		<div class="ui secondary stacked segment">
		<h3 class="ui center aligned dividing header">Favicon</h3>
			<div class="ui form">
				<div class="inline field">
					<div class="ui toggle checkbox">
						<?php
						printf(
							'<input type="checkbox" value="1" name="%1$s" %2$s>',
							$theme->option_form_name('meta_favicon_enabled'),
							($theme->get_option('meta_favicon_enabled') ? 'checked' : '')
						);
						?>
						<label>Enable Favicon</label>
					</div>
				</div>
				<div class="field">
					<label>URL to favicon (png, jpg, or ico)</label>
					<?php
					printf(
						'<input type="text" placeholder="/favicon.png" name="%1$s" value="%2$s">',
						$theme->option_form_name('meta_favicon'),
						$theme->get_option('meta_favicon')
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="column">
		<div class="ui secondary stacked segment">
		<h3 class="ui center aligned dividing header">X-UA-Compatible</h3>
			<div class="ui form">
				<div class="inline field">
					<div class="ui toggle checkbox">
						<?php
						printf(
							'<input type="checkbox" value="1" name="%1$s" %2$s>',
							$theme->option_form_name('meta_x_ua_compatible_enabled'),
							($theme->get_option('meta_x_ua_compatible_enabled') ? 'checked' : '')
						);
						?>
						<label>Enable X-UA-Compatible</label>
					</div>
				</div>
				<div class="field">
					<label>Configure:</label>
					<?php
					printf(
						'<input type="text" placeholder="IE=edge,chrome=1" name="%1$s" value="%2$s">',
						$theme->option_form_name('meta_x_ua_compatible'),
						$theme->get_option('meta_x_ua_compatible')
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="column">
		<div class="ui secondary stacked segment">
		<h3 class="ui center aligned dividing header">Keywords</h3>
			<div class="ui form">
				<div class="inline field">
					<div class="ui toggle checkbox">
						<?php
						printf(
							'<input type="checkbox" value="1" name="%1$s" %2$s>',
							$theme->option_form_name('meta_keywords_enabled'),
							($theme->get_option('meta_keywords_enabled') ? 'checked' : '')
						);
						?>
						<label>Enable Keywords</label>
					</div>
				</div>
				<div class="field">
					<label>Comma-delimited list of keywords</label>
					<?php
					printf(
						'<input type="text" placeholder="html5, ui, library, framework, javascript" name="%1$s" value="%2$s">',
						$theme->option_form_name('meta_keywords'),
						$theme->get_option('meta_keywords')
					);
					?>
				</div>
			</div>
		</div>
	</div>
</div>
