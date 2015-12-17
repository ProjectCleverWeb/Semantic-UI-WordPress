<?php
/**
 * Here we are using Semantic UI forms
 * 
 * @see http://semantic-ui.com/collections/form.html
 */
?><div class="ui three column doubling grid">
	<div class="column">
		<div class="ui secondary stacked segment">
		<h3 class="ui center aligned dividing header">Header</h3>
			<div class="ui form">
				<div class="field">
					<label>Header Text</label>
					<?php
					printf(
						'<input type="text" placeholder="My Site Name" name="%1$s" value="%2$s">',
						$theme->option_form_name('header_text'),
						$theme->get_option('header_text')
					);
					?>
				</div>
				<div class="field">
					<label>Header Sub-Text</label>
					<?php
					printf(
						'<input type="text" placeholder="My Slogan" name="%1$s" value="%2$s">',
						$theme->option_form_name('header_subtext'),
						$theme->get_option('header_subtext')
					);
					?>
				</div>
				<div class="field">
					<label>Logo URL</label>
					<?php
					printf(
						'<input type="text" placeholder="http://example.com/logo.png" name="%1$s" value="%2$s">',
						$theme->option_form_name('logo_url'),
						$theme->get_option('logo_url')
					);
					?>
				</div>
				<label>Logo Size</label>
				<div class="ui stackable grid">
					<div class="doubling two column row">
						<?php
						$logo_sizes = range(0,16);
						
						foreach ($logo_sizes as $value) {
							$checked = '';
							if ($theme->get_option('logo_size') == (string) $value) {
								$checked = 'checked';
							}
							?>
							<div class="column">
								<div class="ui radio checkbox">
									<input id="size-<?php echo $value; ?>" value="<?php echo $value; ?>" type="radio" name="<?php echo $theme->option_form_name('logo_size'); ?>" <?php echo $checked; ?>>
									<label for="size-<?php echo $value; ?>">
										<?php
										if ($value == 0) {
											echo 'No Logo';
										} elseif ($value == 16) {
											echo 'Full Width';
										} else {
											echo $value.'/16';
										}
										?>
									</label>
								</div>
							</div>
							
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="column">
		<div class="ui secondary stacked segment">
		<h3 class="ui center aligned dividing header">Footer</h3>
			<div class="ui form">
				<div class="field">
					<label>Copyright Holder</label>
					<?php
					printf(
						'<input type="text" placeholder="Person or Company Name" name="%1$s" value="%2$s">',
						$theme->option_form_name('copyright_holder'),
						$theme->get_option('copyright_holder')
					);
					?>
				</div>
				<div class="field">
					<label>Copyright Holder URL</label>
					<?php
					printf(
						'<input type="text" placeholder="http://example.com/" name="%1$s" value="%2$s">',
						$theme->option_form_name('copyright_holder_url'),
						$theme->get_option('copyright_holder_url')
					);
					?>
				</div>
				<div class="field">
					<div class="ui toggle checkbox">
						<?php
						printf(
							'<input type="checkbox" value="1" name="%1$s" %2$s>',
							$theme->option_form_name('copyright_extra'),
							($theme->get_option('copyright_extra') ? 'checked' : '')
						);
						?>
						<label>Show "All Rights Reserved" <small>(see <a target="_blank" href="http://en.wikipedia.org/wiki/All_rights_reserved">this</a>)</small></label>
					</div>
				</div>
				<h4 class="ui center aligned header">
					Copyright Start Year
					<div class="sub header">The year that your copyright started. If set to "This Year" then the year will update as the years go by. If a standard year is selected, then a range of years will be used in the copyright.</div>
				</h4>
				<div class="ui center aligned basic segment">
					<div class="ui selection dropdown">
						<input type="hidden" name="<?php echo $theme->option_form_name('copyright_year'); ?>" value="<?php echo $theme->get_option('copyright_year'); ?>">
						<div class="default text">This Year</div>
						<i class="dropdown icon"></i>
						<div class="menu">
							<?php
							$selected = '';
							if ((int) $theme->get_option('copyright_year') == 0) {
								$selected=' active';
							}
							printf('<div class="item%2$s" data-value="%1$s">This Year</div>'.PHP_EOL, 0, $selected);
							foreach (range((int) date("Y"), 1900) as $year) {
								$selected = '';
								if ((int) $theme->get_option('copyright_year') == $year) {
									$selected=' active';
								}
								printf('<div class="item%2$s" data-value="%1$s">%1$s</div>'.PHP_EOL, $year, $selected);
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="column">
		<div class="ui secondary stacked segment">
		<h3 class="ui center aligned dividing header">Misc.</h3>
			<div class="ui form">
				<div class="field">
					<div class="ui toggle checkbox">
						<?php
						printf(
							'<input type="checkbox" value="1" name="%1$s" %2$s>',
							$theme->option_form_name('first_run'),
							($theme->get_option('first_run') ? 'checked' : '')
						);
						?>
						<label>Show First-Run</label>
					</div>
				</div>
				<div class="field">
					<div class="ui toggle checkbox">
						<?php
						printf(
							'<input type="checkbox" value="1" name="%1$s" %2$s>',
							$theme->option_form_name('powered_by'),
							($theme->get_option('powered_by') ? 'checked' : '')
						);
						?>
						<label>Show "Powered By" Message</label>
					</div>
				</div>
				<div class="ui top attached secondary inverted segment">
					
					<h4 class="ui center aligned header">WordPress Theme Editor</h4>
				</div>
				<div class="ui bottom attached stacked segment">
					<strong>WARNING:</strong> Editing a theme via WordPress's file editor is <strong>very dangerious!</strong>
					<br><br>
					Modifying a theme's files without knowing the proper programming languages can often lead to your site going down.
					If you <i>must</i> edit this theme's files, it is highly recommended that you use an IDE.
					<br><br>
					<div class="field">
						<div class="ui toggle checkbox">
							<?php
							printf(
								'<input type="checkbox" value="1" name="%1$s" %2$s>',
								$theme->option_form_name('theme_editor'),
								($theme->get_option('theme_editor') ? 'checked' : '')
							);
							?>
							<label>Allow Theme Editor</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
