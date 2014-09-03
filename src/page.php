<?php
/**
 * The default page template
 * 
 * Shows pages as the default template without any sidebars.
 * 
 * @package Semanitic UI for WordPress
 */

theme::use_part('layout', 'layout', 'sidebar-none');
theme::part('template', 'template', 'default');
