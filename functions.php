<?php
/**
 * If you want to add custome functions to SUI, please
 * do so in this file after the below require()
 * 
 * Author: Nicholas Jordon
 */

require_once( __DIR__.'/lib/scripts/init/sui.php' );

/*** Add custom functions below this line ***/




/*** Temporary Storage ***/

// Comment Layout
function sui_comments( $comment, $args, $depth ) {
	$ref = \semantic_ui\vars::$ref;
	return $ref->model->fetch('comments', array(
		// Pass arguments
		'comment' => $comment,
		'args'    => $args,
		'depth'   => $depth
	));
}

// Search Form
function sui_search() {
	$form = '
<form role="search" method="get" id="searchform" class="search bar" action="%2$s" >
	<div class="ui icon input">
		<input type="text" value="%1$s" name="s" id="s" placeholder="%3$s">
		<button type="submit" id="searchsubmit" class="ui icon button"><i class="search icon"></i></input>
	</div>
</form>
';
	return sprintf($form,get_search_query(),home_url( '/' ),esc_attr__( 'Search...', 'bonestheme' ));
}



