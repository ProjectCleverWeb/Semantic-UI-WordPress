<?php
/**
 * Semanitic UI for WordPress functions file
 */

// PSR-4 Autoloader
require_once __DIR__.'/includes/autoload.php';

// Put any alias classes here
class theme extends \semantic\theme {}

// Run any init methods here
theme::init();

// Get Custom Functions
theme::part('custom-functions', 'include');

// Initialize WordPress
theme::part('wp-init', 'include');
