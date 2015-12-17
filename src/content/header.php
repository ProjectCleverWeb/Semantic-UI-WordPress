<?php
/**
 * The default theme header.
 */

$num_to_eng = array(
	0  => 'zero',
	1  => 'one',
	2  => 'two',
	3  => 'three',
	4  => 'four',
	5  => 'five',
	6  => 'six',
	7  => 'seven',
	8  => 'eight',
	9  => 'nine',
	10 => 'ten',
	11 => 'eleven',
	12 => 'twelve',
	13 => 'thirteen',
	14 => 'fourteen',
	15 => 'fifteen',
	16 => 'sixteen',
);

$logo_width = $num_to_eng[(int) $theme->get_option('logo_size')];
$menu_width = $num_to_eng[(16 - (int) $theme->get_option('logo_size'))];


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php template_part($theme->content_sub_path.'/head'); ?>
</head>
<body <?php body_class('public-page'); ?>>
	<div id="page-wrapper">
		<div id="page-container">
			<header class="ui middle aligned stackable page grid" id="main-header-grid">
				<?php
				if ($logo_width != 'zero') {
					?>
				<div class="<?php echo $logo_width; ?> wide center aligned column">
					<?php
					if ($theme->get_option('logo_url')) {
						?>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<img src="<?php echo $theme->get_option('logo_url'); ?>" alt="company logo">
						</a>
						<?php
					}
					?>
				</div>
				<?php
				} // logo width
				
				if ($menu_width != 'zero') {
					?>
				<div class="<?php echo $menu_width; ?> wide column">
					<?php
					if ($theme->get_option('header_text') || $theme->get_option('header_subtext')) {
						?>
						<h1 class="ui huge inverted center aligned header">
							<?php echo $theme->get_option('header_text'); ?>
							<div class="sub header">
								<?php echo $theme->get_option('header_subtext'); ?>
							</div>
						</h1>
						<?php
					}
					if (has_nav_menu($menu_loc = 'main-menu')) {
						wp_nav_menu(array(
							'theme_location'  => $menu_loc,
							'menu_class'      => 'ui menu',
							'items_wrap'      => '<nav id="%1$s" class="%2$s">%3$s</nav>',
							'depth'           => 2, // currently there is a bug that prevents a depth > 2 from displaying correctly
							'walker'          => new \semantic\walker\nav_menu
						));
					}
					?>
				</div>
			<?php
			} // menu width
			?>
			</header>
			<div class="ui page stackable grid" id="main-content-grid">
				<div class="sixteen wide column"><?php
