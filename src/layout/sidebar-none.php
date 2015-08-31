<?php
/**
 * The "Sidebar: None" Layout
 * 
 * This layout has no sidebars
 */

theme_header();
?>
<main>
	<?php template_part($theme->content_sub_path.'/loop', get_post_format()); ?>
</main>
<?php
theme_footer();
