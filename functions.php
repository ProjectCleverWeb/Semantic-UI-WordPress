<?php
/*
Author: Nicholas Jordon
*/

require_once( __DIR__.'/lib/scripts/general.php' );
require_once( __DIR__.'/lib/scripts/admin.php' );


// Sidebars & Widgetizes Areas
function sui_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar Widgets', 'bonestheme' ),
		'description' => __( 'The sidebar widget area.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="ui stacked blue segment widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="ui ribbon label widget title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Footer Widgets', 'bonestheme' ),
		'description' => __( 'The footer widget area.', 'bonestheme' ),
		'before_widget' => '<div class="four wide column"><div id="%1$s" class="ui stacked blue segment widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="ui label widget title">',
		'after_title' => '</h4>',
	));
	// To call the sidebar in your template, you can just copy
	// the sidebar.php file and rename it to your sidebar's name.
	// So using the above example, it would be:
	// sidebar-sidebar2.php
}

// Comment Layout [comeback]
function sui_comments( $comment, $args, $depth ) {
	 $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<!-- end custom gravatar call -->
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!


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
} // don't remove this bracket!


/*** WordPress Replacements ***/

// [comeback]
// require_once __DIR__.'/lib/scripts/functions/sui_paginate_links.php';



require_once __DIR__.'/lib/scripts/sui.php';