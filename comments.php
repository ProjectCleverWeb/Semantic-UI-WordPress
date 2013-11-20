<?php
/*
The comments page, [comback]
*/

// Do not delete these lines
	if ( ! empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
	<div class="ui warning message">
		<p>You must enter the password to see comments.</p>
	</div>
	<?php
		return;
	}
?>

<div class="ui top attached secondary segment">
	<img class="ui avatar image" src="http://placehold.it/100&text=Avatar"> Commenting as <a href="/user">&lt;username&gt;</a> | <a href="/logout">Logout</a>
</div>
<div class="ui bottom attached segment">
	<form class="ui reply form">
		<div class="field">
			<textarea></textarea>
		</div>
		<div class="ui fluid blue labeled submit icon button">
			<i class="icon edit"></i> Add Reply
		</div>
	</form>
</div>
<div class="ui stacked segment">
	<div class="ui top attached label">21 Comments</div>
	<div class="ui comments">
		<div class="comment">
			<a class="avatar">
				<img src="http://placehold.it/100&text=Avatar">
			</a>
			<div class="content">
				<a class="author">Dog Doggington</a>
				<div class="metadata">
					<div class="date">2 days ago</div>
				</div>
				<div class="text">
					I think this is a great idea and i am voting on it
				</div>
				<div class="actions">
					<a class="reply">Reply</a>
					<a class="delete">Delete</a>
				</div>
			</div>
		</div>
		<div class="comment">
			<a class="avatar">
				<img src="http://placehold.it/100&text=Avatar">
			</a>
			<div class="content">
				<a class="author">Pawfin Dog</a>
				<div class="metadata">
					<div class="date">1 day ago</div>
				</div>
				<div class="text">
					I think this is a great idea and i am voting on it
				</div>
				<div class="actions">
					<a class="reply">Reply</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php return; ?>



<?php
$reply_options = array(
	'author',
	'author_img',
	'author_url'
);

if (comments_open()) {
	if (have_comments()) {
		$_sui->model->fetch('comment_reply', $reply_options);
		$_sui->model->fetch('comments');
	} else {
		?>
		<div class="ui icon message">
			<i class="chat icon"></i>
			<div class="content">
				<div class="header">
					No comments yet
				</div>
				<p>You can be the first to comment on this!</p>
			</div>
		</div>
		<?php
		$_sui->model->fetch('comment_reply', $reply_options);
	}
} else { // comments are closed
	if (have_comments()) {
		$_sui->model->fetch('comments');
	}
	// don't display anyting if they are closed and no comments exist
}



?>




<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments" class="h2"><?php comments_number( __( '<span>No</span> Responses', 'bonestheme' ), __( '<span>One</span> Response', 'bonestheme' ), _n( '<span>%</span> Response', '<span>%</span> Responses', get_comments_number(), 'bonestheme' ) );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<nav id="comment-nav">
		<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
		</ul>
	</nav>

	<ol class="commentlist">
		<?php wp_list_comments( 'type=comment&callback=bones_comments' ); ?>
	</ol>

	<nav id="comment-nav">
		<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
		</ul>
	</nav>

	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>

	<!-- If comments are closed. -->
	<!--p class="nocomments"><?php _e( 'Comments are closed.', 'bonestheme' ); ?></p-->

	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<section id="respond" class="respond-form">

	<h3 id="comment-form-title" class="h2"><?php comment_form_title( __( 'Leave a Reply', 'bonestheme' ), __( 'Leave a Reply to %s', 'bonestheme' )); ?></h3>

	<div id="cancel-comment-reply">
		<p class="small"><?php cancel_comment_reply_link(); ?></p>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<div class="alert alert-help">
			<p><?php printf( __( 'You must be %1$slogged in%2$s to post a comment.', 'bonestheme' ), '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>' ); ?></p>
		</div>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( is_user_logged_in() ) : ?>

	<p class="comments-logged-in-as"><?php _e( 'Logged in as', 'bonestheme' ); ?> <a href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e( 'Log out of this account', 'bonestheme' ); ?>"><?php _e( 'Log out', 'bonestheme' ); ?> <?php _e( '&raquo;', 'bonestheme' ); ?></a></p>

	<?php else : ?>

	<ul id="comment-form-elements" class="clearfix">

		<li>
			<label for="author"><?php _e( 'Name', 'bonestheme' ); ?> <?php if ($req) _e( '(required)'); ?></label>
			<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e( 'Your Name*', 'bonestheme' ); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		</li>

		<li>
			<label for="email"><?php _e( 'Mail', 'bonestheme' ); ?> <?php if ($req) _e( '(required)'); ?></label>
			<input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e( 'Your E-Mail*', 'bonestheme' ); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
			<small><?php _e("(will not be published)", 'bonestheme' ); ?></small>
		</li>

		<li>
			<label for="url"><?php _e( 'Website', 'bonestheme' ); ?></label>
			<input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e( 'Got a website?', 'bonestheme' ); ?>" tabindex="3" />
		</li>

	</ul>

	<?php endif; ?>

	<p><textarea name="comment" id="comment" placeholder="<?php _e( 'Your Comment here...', 'bonestheme' ); ?>" tabindex="4"></textarea></p>

	<p>
		<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e( 'Submit', 'bonestheme' ); ?>" />
		<?php comment_id_fields(); ?>
	</p>

	<div class="alert alert-info">
		<p id="allowed_tags" class="small"><strong>XHTML:</strong> <?php _e( 'You can use these tags', 'bonestheme' ); ?>: <code><?php echo allowed_tags(); ?></code></p>
	</div>

	<?php do_action( 'comment_form', $post->ID ); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
</section>

<?php endif; // if you delete this the sky will fall on your head ?>
