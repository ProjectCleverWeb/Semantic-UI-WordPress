<div class="ui three column doubling grid">
	<div class="column">
		<div class="ui segment">
			<h4 class="ui center aligned block header">Misc.</h4>
			<div class="ui form">
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
			</div>
		</div>
	</div>
</div>
