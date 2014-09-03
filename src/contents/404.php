<div class="ui raised segment entry">
	<h2 class="ui large dividing header entry-title">
		Error 404
		<div class="sub header">The page you requested could not be found</div>
	</h2>
	<section class="ui basic segment entry-content">
		<div class="ui middle aligned stackable grid">
			<div class="one column row">
				<div class="column">
					<div class="ui center aligned header">
						You Can...
					</div>
				</div>
			</div>
			<div class="two column row">
				<div class="center aligned column">
					Try to find page you were looking for: <br>
					<div class="ui basic segment">
						<?php
						/*
						The wrapper is removed from the widget because not only is it not needed, but the bottom
						border of the input tag is invisible on webkit browsers when a parent tag has the class
						"widget"
						*/
						the_widget('WP_Widget_Search', array(), array('before_widget' => '', 'after_widget' => ''));
						?>
					</div>
				</div>
				<div class="center aligned column">
					<div class="ui basic segment">
						Go back to the homepage: <br><br>
						<a class="small medium ui button" href="<?php echo home_url('/'); ?>">Go To Homepage</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>