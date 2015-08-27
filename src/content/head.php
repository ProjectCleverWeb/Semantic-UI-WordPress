<?php
/**
 * The default content of <head> in the document
 */

?><meta charset="<?php bloginfo( 'charset' ); ?>">

<title><?php wp_title('|'); ?></title>

<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="html5, ui, library, framework, javascript" />
<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
if (theme::get_option('mobile_meta')) {
	?>
	<!-- Mobile Meta -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="<?php echo theme::get_option('mobile_size'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- /Mobile Meta -->
	<?php
}
?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script type="text/javascript">
// Use local jQuery if CDN is unavailable
!window.jQuery && document.write('<script src="<?php echo theme::$scripts_uri.'/jquery-2.1.1.min.js'; ?>"><\/script>');

// Google Fonts (async)
WebFontConfig = {
	google: { families: [
		'Open+Sans:400italic,400,600,700:latin', // Default
		'Roboto:400,700,300,500:latin', // Header
		'Droid+Sans+Mono::latin' // Monospace
	] }
};
</script>
<?php
wp_head();

$background_position = get_theme_mod('background_position_x', get_theme_support('custom-background', 'default-position-x'));
if (!in_array($background_position, array('center', 'right', 'left'))) {
	$background_position = 'left';
}

$background_repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
if (!in_array($background_repeat, array('no-repeat', 'repeat-x', 'repeat-y', 'repeat'))) {
	$background_repeat = 'repeat';
}

$background_attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
if (!in_array($background_attachment, array( 'fixed', 'scroll'))) {
	$background_attachment = 'scroll';
}

printf(
	'<style type="text/css">#main-header-grid, #main-footer-grid { background-image:%1$s; background-position:%2$s; color:%3$s; background-repeat:%4$s; background-attachment:%5$s }</style>',
	'url("'.get_background_image().'")',
	"top $background_position",
	'#'.get_background_color(),
	$background_repeat,
	$background_attachment
);
