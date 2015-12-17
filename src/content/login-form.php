<?php
/**
 * This is a simplified example of how to create a login page for WordPress.
 */
?><div class="ui center aligned container">
	<img src="<?php echo site_url('/wp-admin/images/wordpress-logo.svg'); ?>" class="image">
</div>
<form class="ui form" action="<?php echo esc_url(wp_login_url()); ?>" method="post">
	<?php
	if (!empty($_REQUEST['redirect'])) {
		printf('<input type="hidden" name="redirect_to" value="%s" />', esc_url($_REQUEST['redirect']));
	}
	?>
	<div class="ui raised top attached segment">
		<div class="field">
			<div class="ui left icon input">
				<i class="user icon"></i>
				<input type="text" name="log" placeholder="Username">
			</div>
		</div>
		<div class="field">
			<div class="ui left icon input">
				<i class="lock icon"></i>
				<input type="password" name="pwd" placeholder="Password">
			</div>
		</div>
		<div class="field">
			<div class="ui checkbox">
				<input name="rememberme" type="checkbox" tabindex="0" class="hidden" value="forever">
				<label>Remember Me</label>
			</div>
		</div>
	</div>
	<div class="ui two bottom attached buttons">
		<a href="<?php echo esc_url(home_url('/')); ?>" class="ui black button">Cancel</a>
		<button type="submit" name="wp-submit" class="ui blue submit button">Login</button>
	</div>
</form>
<div class="ui horizontal bulleted link list basic center aligned segment">
	<?php
		if (get_option('users_can_register')) {
			printf('<a class="item" href="%s">%s</a>', esc_url(wp_registration_url()), 'Register');
		}
	?>
	<a class="item" href="<?php echo esc_url(wp_lostpassword_url()); ?>">
		Lost your password?
	</a>
</div>
