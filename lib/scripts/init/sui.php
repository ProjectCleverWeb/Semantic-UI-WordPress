<?php
/**
 * This file sets up SUI
 * 
 * $_sui->__constuct() and $_sui->init() do most of the heavy lifting.
 */


// data class
require_once __DIR__.'/../objects/semantic_ui-data_class.interface.php';
require_once __DIR__.'/../objects/semantic_ui-wp.class.php';
$data_class = new \semantic_ui\wp;

require_once __DIR__.'/../objects/semantic_ui-main.class.php';
global $_sui;
new \semantic_ui\main($_sui, $data_class); // made with love & magic
$_sui->init();
