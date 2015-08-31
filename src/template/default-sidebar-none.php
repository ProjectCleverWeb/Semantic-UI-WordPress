<?php
/*
Template Name: Sidebar: None
*/

theme_header();
?>
<main>
	<?php template_part($theme->content_sub_path.'/loop', $theme->post_type); ?>
</main>
<?php
theme_footer();
