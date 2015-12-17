<?php
/**
 * Woocommerce Specific Page.
 * 
 * This page is only used by Woocommerce when it is installed as a plugin. This
 * page is otherwise pointless. This page just replaces the standard loop with
 * the woocommerce content.
 */

template_use_part($theme->content_sub_path.'/loop', $theme->content_sub_path.'/woocommerce');
template_part($theme->template_sub_path.'/default');
