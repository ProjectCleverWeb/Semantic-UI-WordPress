<?php
/**
 * Woocommerce Specific Page.
 * 
 * This page is only used by Woocommerce when it is installed as a plugin. This
 * page is otherwise pointless. This page just replaces the standard loop with
 * the woocommerce content.
 */

theme::use_part('loop', 'content', 'woocommerce');
theme::part('template', 'template', 'default');
