<?php get_header(); ?>
				
				<div class="ui stackable grid" id="page-grid" role="main">
					<div class="eleven wide column" id="main-content">
						
						<?php
						$article_count = 0;
						if (have_posts()) : while (have_posts()) : the_post();
						$is_sticky = is_sticky($post->ID);
						
						$article_count++;
						
						?>
						<article id="post id <?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<div <?php
								if($is_sticky) {
									echo "class=\"ui top attached segment\"";
								} else {
									echo "class=\"ui top attached primary segment\"";
								}
								?> >
								<header class="article header">
									<?php
									$post_title = trim(get_the_title());
									$post_has_title = (!empty($post_title));
									
									if ($post_has_title) {
									?>
									<h2 class="ui dividing header" itemprop="headline">
											<?php the_title(); ?>
									</h2>
									<?php
									} else {
									?>
									
									<?php
									}
									?>
									
								</header><!-- /.article.header -->
								
								<section class="article content" itemprop="articleBody">
									<?php
									$post_img = $_sui->post->featured_img();
									if ($post_img) {
										$fstr = '<a href="%2$s"><img class="article featured image" src="%1$s" title="%3$s" ></a>';
										echo sprintf($fstr,$post_img['url'], get_permalink(), the_title_attribute(array('echo' => FALSE)));
										unset($fstr);
									}
									?>
									<p class="the-content"><?php echo $_sui->post->the_content(); ?></p>
								</section><!-- ./article.content -->
							</div>
							
							<footer class="ui bottom attached stacked secondary segment article footer">
								<?php
								if (!$is_sticky && has_tag()) {
								?>
								<p class="article tags">
									Tags:
									<?php
										$fmt = '<a href="%2$s" id="tag-%3$s" title="%4$s"><span class="mini ui button">%1$s</span></a>';
										echo $_sui->post->tags(0,0,' ',0,$fmt);
									?>
								</p>
								<?php } ?>
								<p class="byline vcard">
									<img class="ui avatar image post avatar" src="http://placehold.it/100&text=Avatar">
									<?php
										if ($is_sticky) {
											$fstr = 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>';
										} else {
											$fstr = 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> and filed under %4$s.';
										}
										printf(
											__($fstr, 'bonestheme'),
											get_the_time('Y-m-j'),
											get_the_time(get_option('date_format')),
											sui_get_the_author_posts_link(),
											get_the_category_list(', ')
										);
									?>
								</p>
							</footer> <!-- /.article.footer -->
							<?php comments_template(); // uncomment if you want to use them ?>
						</article> <!-- /article -->
						<?php endwhile;
						
						sui_page_navi();
						
						else : // for IF(have_posts()) ?>
						<article>
							<div class="ui top attached primary segment">
								<header class="article header">
									<h2 class="ui dividing header">
										No Content Found
									</h2>
								</header><!-- /.article.header -->
								
								<section class="article content">
									<h4>
										The content you were looking for could not be found
									</h4>
									<div class="ui two column middle aligned relaxed grid basic segment">
										<div class="center aligned not found column">
											<p class="ui basic segment">
												You can try searching for the page you were looking for:
											</p>
											<?php echo sui_search(); ?>
										</div>
										<div class="ui vertical divider">
											OR
										</div>
										<div class="center aligned not found column">
											<p class="ui basic segment">
												You can go back to the homepage:
											</p>
											<a class="small medium blue ui button" href="<?php echo home_url('/'); ?>">Go To Homepage</a>
										</div>
									</div>
								</section><!-- ./article.content -->
							</div>
							
							<footer class="ui bottom attached stacked secondary segment article footer">
								<p>
									<!-- [comeback] add support email option -->
									If you would like to report an error, you can email us at <a href="mailto:support@localhost.com">support@localhost.com</a>
								</p>
							</footer> <!-- /.article.footer -->
						</article> <!-- /article -->
						<?php endif; // for IF(have_posts()) ?>
						
						
						
						
						
					</div><!-- /#main-content -->
					<div class="five wide column" id="sidebar-content">
						
						
<?php get_sidebar(); ?>
						
						
					</div><!-- /#sidebar-content -->
				</div><!-- /#page-grid -->
				
<?php get_footer(); ?>
