<div class="ui three column doubling grid">
	<div class="column">
		<div class="ui segment">
			<h4 class="ui center aligned block header">Mobile Meta</h4>
			<div class="ui form">
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
					<label>Recommended Mobile Screen Width (without the "px")</label>
					<?php
					printf(
						'<input type="text" placeholder="450" name="%1$s" value="%2$s">',
						theme::option_form_name('mobile_size'),
						theme::get_option('mobile_size')
					);
					?>
				</div>
			</div>
		</div>
	</div>
</div>
