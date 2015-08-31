<?php
/*
Template Name: First-Run
*/

template_use_part($theme->content_sub_path.'/header', $theme->content_sub_path.'/header', 'none');
template_use_part($theme->content_sub_path.'/footer', $theme->content_sub_path.'/footer', 'none');
template_use_part($theme->content_sub_path.'/modals', $theme->content_sub_path.'/empty');
template_part($theme->layout_sub_path.'/first-run');
