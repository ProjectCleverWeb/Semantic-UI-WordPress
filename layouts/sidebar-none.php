<?php
/**
 * The "Sidebar: None" Layout
 * 
 * This layout has no sidebars
 */

get_header();
?>
<main>
	<?php theme::part('loop', 'content', 'loop'); ?>
</main>
<?php
get_footer();
