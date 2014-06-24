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
<?php wp_head(); ?>
<script type="text/javascript">
// Google Fonts (async)
WebFontConfig = {
	google: { families: [
		'Open+Sans:400italic,400,600,700:latin', // Default
		'Roboto:400,700,300,500:latin', // Header
		'Droid+Sans+Mono::latin' // Monospace
	] }
};


// Async Script Loading (headjs)
var theme_dir = "<?php echo theme::$scripts_uri; ?>/";
head.js(
	"//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js", // Google Webfont
	"//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", // jQuery
	theme_dir + "semantic.min.js", // Semantic Lib
	theme_dir + "highlight.pack.min.js", // Syntax Highlighter (highlight.js)
	theme_dir + "mousetrap.min.js", // Keyboard Shortcuts Lib (mousetrap.js)
	theme_dir + "main.js" // All Other JS
);
</script>
