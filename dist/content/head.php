<?php
/**
 * The default content of <head> in the document
 */

?><meta charset="<?php bloginfo( 'charset' ); ?>">

<title><?php wp_title('|'); ?></title>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
if ($theme->get_option('meta_keywords_enabled') && !empty($theme->get_option('meta_keywords'))) {
	?>
	<meta name="keywords" content="<?php esc_attr_e($theme->get_option('meta_keywords')); ?>">
	<?php
}
if ($theme->get_option('meta_favicon_enabled') && !empty($theme->get_option('meta_favicon'))) {
	?>
	<link rel="shortcut icon" href="<?php esc_attr_e($theme->get_option('meta_favicon')); ?>">
	<?php
}
if ($theme->get_option('meta_x_ua_compatible_enabled') && !empty($theme->get_option('meta_x_ua_compatible'))) {
	?>
	<meta http-equiv="X-UA-Compatible" content="<?php esc_attr_e($theme->get_option('meta_x_ua_compatible')); ?>">
	<?php
}
if ($theme->get_option('mobile_meta') && !empty($theme->get_option('mobile_size'))) {
	?>
	<!-- Mobile Meta -->
	<meta name="HandheldFriendly" content="true">
	<meta name="MobileOptimized" content="<?php esc_attr_e($theme->get_option('mobile_size')); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- /Mobile Meta -->
	<?php
}
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
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
	'<style type="text/css">#main-header-grid, #main-footer-grid { background-image:%1$s; background-position:%2$s; background-color:%3$s; background-repeat:%4$s; background-attachment:%5$s }</style>',
	'url("'.get_background_image().'")',
	"top $background_position",
	'#'.get_background_color(),
	$background_repeat,
	$background_attachment
);
