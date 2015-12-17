<?php
/**
 * Template Name: Login Page
 */

if (is_user_logged_in()) {
	$loc = home_url();
	if (!empty($_REQUEST['redirect'])) {
		$loc = $_REQUEST['redirect'];
	}
	wp_redirect($loc);
	exit;
}

theme_header('none');
?>
<div class="ui middle aligned center aligned stackable grid" id="login-container">
	<main class="five wide column">
		<?php
		template_part($theme->content_sub_path.'/login-form', $theme->post_type);
		?>
	</main>
</div>
<style type="text/css">
	html {
		height: 100% !important;
	}
	html, body, #page-wrapper, #page-container, #main-content-grid {
		height: 100%;
		background: #EFEFEF;
	}
	#login-container {
		height: 100%;
	}
</style>
<?php
theme_footer('none');
