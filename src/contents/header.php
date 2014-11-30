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

$logo_width = $num_to_eng[(int) theme::get_option('logo_size')];
$menu_width = $num_to_eng[(16 - (int) theme::get_option('logo_size'))];


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php theme::part('head', 'content', 'head'); ?>
</head>
<body <?php body_class('public-page'); ?>>
	<div id="page-wrapper">
		<div id="page-container">
			<header class="ui page stackable grid" id="main-header-grid">
				<?php
				if ($logo_width != 'zero') {
					?>
				<div class="<?php echo $logo_width; ?> wide center aligned column">
					<?php
					if (theme::get_option('logo_url')) {
						?>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<img src="<?php echo theme::get_option('logo_url'); ?>">
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
					<h1 class="ui huge inverted center aligned header">
						<?php echo get_bloginfo('name'); ?>
						<div class="sub header">
							<?php echo bloginfo('description'); ?>
						</div>
					</h1>
					<?php
					/*
					 * A simple but effective way to display a menu as a Semantic UI menu
					 */
					$main_menu_loc = 'main-menu';
					if (has_nav_menu($main_menu_loc)) {
						$main_menu = wp_nav_menu(array(
							'theme_location'  => $main_menu_loc,
							'container'       => 'div',
							'menu_class'      => 'ui secondary inverted pointing centered menu nav-menu',
							'echo'            => false,
							'items_wrap'      => '<nav id="%1$s" class="%2$s">%3$s</nav>',
							'depth'           => 1,
						));
						$main_menu = str_replace('menu-item ', 'menu-item item ', $main_menu);
						$main_menu = str_replace('><a href="', ' href="', $main_menu);
						$main_menu = str_replace("</a></li>\n<li ", "</a>\n<a ", $main_menu);
						$main_menu = str_replace('"><li ', '"><a ', $main_menu);
						$main_menu = str_replace("</li>\n</ul>", "</a>\n</nav>", $main_menu);
						echo $main_menu;
					}
					?>
				</div>
			<?php
			} // menu width
			?>
			</header>
			<div class="ui page stackable grid" id="main-content-grid">
				<div class="sixteen wide column"><?php
