<?php
/**
 * The default page template
 * 
 * Shows pages as the default template without any sidebars.
 */

template_use_part($theme->layout_sub_path.'/sidebar-right', $theme->layout_sub_path.'/sidebar-none');
template_part($theme->template_sub_path.'/default');
