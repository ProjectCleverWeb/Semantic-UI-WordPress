<?php
/**
 * The "Sidebar: None" Layout
 * 
 * This layout has no sidebars
 */

get_header();
?>
<main>
	<?php theme::part('loop', 'content', 'loop', get_post_format()); ?>
</main>
<?php
get_footer();
