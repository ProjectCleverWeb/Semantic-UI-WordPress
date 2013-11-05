<?php
/*
Template Name: Output Function/Method
*/

// This page just tests the output of functions/methods

require_once __DIR__.'/lib/scripts/sui.php';
?>
<code>
<pre>
<?php

$output = $_sui->menu->display('main-nav');

// print_r($output);
// var_dump($output);
?>
</pre>
</code>