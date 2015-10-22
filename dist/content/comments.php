<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * NOTICE: This page is currently based off of the comments page in "Underscores"
 * and will see a rewrite within the next few commits to incorperate Semantic UI
 * and possibly some additional features.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="ui segment comments-area">
	<?php
	if ( have_comments() ) {
		?>
		<h2 class="comments-title">
			<?php
			printf(
				_nx(
					'One thought on &ldquo;%2$s&rdquo;',
					'%1$s thoughts on &ldquo;%2$s&rdquo;',
					get_comments_number(),
					'comments title',
					'underscores'
				),
				number_format_i18n(get_comments_number()),
				'<span>' . get_the_title() . '</span>'
			);
			?>
		</h2>
		<?php
		if (get_comment_pages_count() > 1 && get_option('page_comments')) {
			?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e('Comment navigation', 'underscores'); ?></h1>
				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'underscores')); ?></div>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'underscores')); ?></div>
			</nav>
			<?php
		}
		?>
		<ol class="comment-list">
			<?php
			wp_list_comments(array(
				'style'      => 'ol',
				'short_ping' => true,
			));
			?>
		</ol>
		<?php
		if (get_comment_pages_count() > 1 && get_option('page_comments')) {
			?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'underscores' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'underscores' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'underscores' ) ); ?></div>
			</nav>
			<?php
		}
	}
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'underscores' ); ?></p>
		<?php
	}
	
	comment_form();
	?>
</div>
