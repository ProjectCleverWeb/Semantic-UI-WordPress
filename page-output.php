<?php
/*
Template Name: Output Function/Method
*/

// This page just tests the output of functions/methods

require_once __DIR__.'/lib/scripts/init/sui.php';
?>
<code>
<pre>
<?php

$_sui->tools->rating(99, 1, array(
	'max_rating' => 5
));

// $output = $comment;

// print_r($output);
// var_dump($output);
?>
</pre>
</code>