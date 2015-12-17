<?php
/**
 * In most cases it is best to give your users at least 2 options on a 404 page:
 *   - Allow them to search for what they were looking for
 *   - Give them a link to the home page
 */
?><div class="ui basic segment entry">
	<h2 class="ui large dividing header entry-title">
		Error 404
		<div class="sub header">The page you requested could not be found</div>
	</h2>
	<section class="ui basic segment entry-content">
		<div class="ui middle aligned stackable grid">
			<div class="row">
				<div class="one wide column">
					
				</div>
				<div class="six wide center aligned column">
					Try to find page you were looking for: <br><br>
						<?php
						/*
						The wrapper is removed from the widget because not only is it not needed, but the bottom
						border of the input tag is invisible on webkit browsers when a parent tag has the class
						"widget"
						*/
						the_widget('WP_Widget_Search', array(), array('before_widget' => '', 'after_widget' => ''));
						?>
				</div>
				<div class="one wide column">
					
				</div>
				<div class="ui vertical divider">
					OR
				</div>
				<div class="eight wide center aligned column">
					<a class="ui large button" href="<?php echo home_url('/'); ?>">Go To Homepage</a>
				</div>
			</div>
		</div>
	</section>
</div>
