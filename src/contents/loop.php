<?php


if (have_posts()) {
	while (have_posts()) {
		the_post();
		?>
		<article itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" <?php post_class('ui raised segment entry'); ?>>
			<h2 itemprop="name" class="ui large dividing header entry-title">
				<?php
				if (is_singular()) {
					the_title();
				} else {
					printf(
						'<a rel="bookmark" href="%1$s">%2$s</a>',
						get_the_permalink(),
						get_the_title()
					);
				}
				
				
				$categories = get_the_category();
				if($categories){
					$cat_i = 0;
					$cat_array = array();
					foreach($categories as $category) {
						if ($cat_i < 3) {
							$cat_array[] = sprintf(
								'<a href="%1$s" title="%2$s">%3$s</a>',
								get_category_link($category->term_id),
								esc_attr(sprintf(__("View all posts in %s", theme::$text_domain), $category->name)),
								$category->cat_name
							);
						} else {
							break;
						}
						$cat_i++;
					}
					printf(
						'<div class="sub header">Filed Under: %1$s</div>',
						implode(', ', $cat_array)
					);
				}
				?>
			</h2>
			<?php
			if (is_singular()) {
				if (has_post_thumbnail($post->ID)) {
					?>
					<div class="ui basic center aligned segment entry-media">
						<?php the_post_thumbnail(); ?>
					</div>
					<?php
				}
				?><section itemprop="articleBody" class="ui basic segment entry-content"><?php
				the_content();
				
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', theme::$text_domain),
					'after'  => '</div>',
				));
				
				?></section><?php
			} else {
				if (has_post_thumbnail($post->ID)) {
					$image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'single-post-thumbnail');
					printf(
						'<div class="entry-media"><img itemprop="image" src="%1$s" alt="%2$s"></div>',
						$image[0],
						the_title_attribute(array('echo' => FALSE))
					);
				}
				?><section itemprop="articleSection" class="ui basic segment entry-summery"><?php
				the_excerpt();
				?></section><?php
			}
			?>
			<div class="ui basic segment">
				<?php
				if (is_singular()) {
					edit_post_link( '<span class="ui tiny black right floated button">'.__( 'Edit This', theme::$text_domain).'</span>');
				} else {
					?><a itemprop="url" href="<?php the_permalink(); ?>" class="ui tiny black right floated button" rel="bookmark">View Post</a><?php
				}
				?>
				<span class="ui circular labels tags-links">
					<?php
					$post_tags = get_the_tags();
					if ($post_tags) {
						$tag_i = 0;
						$tag_str = '';
						foreach ($post_tags as $tag) {
							if ($tag_i < 5) {
								$tag_str .= sprintf(
									'<a class="ui label" id="tag-%2$s" href="%3$s">%1$s</a> ',
									$tag->name,
									$tag->term_id,
									get_tag_link($tag->term_id)
								);
								$tag_i++;
							} else {
								break;
							}
						}
						echo substr($tag_str, 0, -2);
					}
					?>
				</span>
				<div>
					Article created by
					<span class="author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">
						<?php
						$author = get_the_author();
						$author_url = get_the_author_meta('gplus');
						if (!$author_url) {
							$author_url = get_the_author_meta('user_url');
						}
						if ($author_url) {
							printf(
								'<a href="%2$s" class="fn author-with-link" itemprop="name" title="%3$s" rel="nofollow author external">%1$s</a>',
								$author,
								esc_url($author_url),
								esc_attr(sprintf(__("Visit %s&#8217;s website", theme::$text_domain), $author))
							);
						} else {
							printf(
								'<span class="fn author-no-link" itemprop="name">%1$s</span>',
								$author
							);
						}
						?>
					</span>
					on
					<time class="updated" datetime="<?php theme::time('m-d-Y H:i'); ?>" itemprop="datePublished" content="<?php theme::time('c'); ?>">
						<?php theme::time(); ?>
					</time>
				</div>
			</div>
		</article>
		<?php
		
		if (is_singular()) {
			if ( comments_open() || '0' != get_comments_number()) :
				comments_template();
			endif;
		}
		
	}
	?>
	
	<?php
	global $wp_query;
	$pagination = paginate_links(array(
		'base'      => str_replace(9999999, '%#%', esc_url(get_pagenum_link(9999999))),
		'format'    => '?paged=%#%',
		'prev_text' => '<i class="left arrow icon"></i> Previous',
		'next_text' => 'Next <i class="right arrow icon"></i>',
		'end_size'  => 2,
		'current'   => max(1, get_query_var('paged')),
		'total'     => $wp_query->max_num_pages,
		'type'      => 'array'
	));
	
	if (!empty($pagination)) {
		foreach ($pagination as &$link) {
			$link = str_ireplace('page-numbers current', 'item active', $link);
			$link = str_ireplace('page-numbers dots', 'item active', $link);
			$link = str_ireplace('page-numbers', 'item', $link);
		}
		
		printf(
			'<div class="ui basic center aligned segment"><div class="ui borderless pagination menu">%1$s</div></div>',
			implode(' ', $pagination)
		);
	}
	
	
}
