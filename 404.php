<?php
/**
 * Display a standard page with the loop replaced by the 404 page content
 *
 * @package Semanitic UI for WordPress
 */

theme::use_part('loop', 'content', '404');
theme::part('template', 'template', 'default');
