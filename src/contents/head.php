<?php
/**
 * The default content of <head> in the document
 * 
 * @package Semanitic UI for WordPress
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
// Google Fonts (async)
WebFontConfig = {
	google: { families: [
		'Open+Sans:400italic,400,600,700:latin', // Default
		'Roboto:400,700,300,500:latin', // Header
		'Droid+Sans+Mono::latin' // Monospace
	] }
};
</script>
<?php wp_head(); ?>
