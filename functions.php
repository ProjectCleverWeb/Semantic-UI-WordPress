<?php
/**
 * If you want to add custome functions to SUI, please
 * do so in this file after the below require()
 * 
 * Author: Nicholas Jordon
 */

require_once( __DIR__.'/lib/scripts/init/sui.php' );

/*** Add custom functions below this line ***/




/**
 * Temporary Storage
 * -----------------
 * These are here because the resources that will handle them are not created yet
 * but will be created soon. (most within a few days)
 */


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


/*********************
MENUS & NAVIGATION
*********************/

// the main menu
function sui_main_nav() {
	// display the wp3 menu if available
		wp_nav_menu(array(
			'container'       => false,                                    // remove nav container
			'container_class' => '',                                       // class of container (should you choose to use it)
			'menu'            => __( 'The Main Menu', 'bonestheme' ),      // nav name
			'menu_class'      => 'ui secondary pointing menu',             // adding custom nav class
			'theme_location'  => 'main-nav',                               // where it's located in the theme
			'items_wrap'      => '<div id="%1$s" class="%2$s">%3$s</div>',
			'before'          => '<span class="item">',                    // before the menu
			'after'           => '</span,>',                               // after the menu
			'link_before'     => '',                                       // before each link
			'link_after'      => '',                                       // after each link
			'depth'           => 0,                                        // limit the depth of the nav
			'fallback_cb'     => 'sui_main_nav_fallback'                 // fallback function
	));
} /* end bones main nav */

// the footer menu (should you choose to use one)
function sui_footer_links() {
	// display the wp3 menu if available
		wp_nav_menu(array(
			'container' => '',                              // remove nav container
			'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
			'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
			'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
			'theme_location' => 'footer-links',             // where it's located in the theme
			'before' => '',                                 // before the menu
				'after' => '',                                  // after the menu
				'link_before' => '',                            // before each link
				'link_after' => '',                             // after each link
				'depth' => 0,                                   // limit the depth of the nav
			'fallback_cb' => 'sui_footer_links_fallback'  // fallback function
	));
} /* end footer links */

// this is the fallback for header menu [comeback]
function sui_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
			'menu_class' => 'nav top-nav clearfix',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
				'link_before' => '',                            // before each link
				'link_after' => ''                             // after each link
	) );
}

// this is the fallback for footer menu
function sui_footer_links_fallback() {
	/* you can put a default here if you like */
}


// Related Posts
function sui_related_posts() {
	echo '<ul id="related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) { 
			$tag_arr .= $tag->slug . ',';
		}
				$args = array(
					'tag' => $tag_arr,
					'numberposts' => 5, /* you can change this to show more */
					'post__not_in' => array($post->ID)
			);
				$related_posts = get_posts( $args );
				if($related_posts) {
					foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
							<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach; }
			else { ?>
						<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'bonestheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_query();
	echo '</ul>';
} /* end bones related posts function */

// Numeric Page Navi
function sui_page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 5;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before.'<nav class="ui pagination menu" role="navigation">';
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = __( "First", 'bonestheme' );
		echo '<a class="item" href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a>';
	}
	if ($start_page >= 3) {
		echo '<a class="icon item" href="'.get_pagenum_link(($i-1)).'"><i class="icon left arrow"></i></a>';
	}
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<a class="active item" href="'.get_pagenum_link($i).'">'.$i.'</a>';
		} else {
			echo '<a class="item" href="'.get_pagenum_link($i).'">'.$i.'</a>';
		}
	}
	if ($i != $end_page) {
		echo '<a class="icon item" href="'.get_pagenum_link($i).'"><i class="icon right arrow"></i></a>';
	}
	if ($end_page < $max_page) {
		$last_page_text = __( "Last", 'bonestheme' );
		echo '<a class="item" href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a>';
	}
	echo '</nav>'.$after."";
} /* end page navi */


// This removes the annoying […] to a Read More link
function sui_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="ui mini blue button article read more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read', 'bonestheme' ) . get_the_title($post->ID).'">'. __( 'Continue Reading &raquo;', 'bonestheme' ) .'</a>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function sui_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}