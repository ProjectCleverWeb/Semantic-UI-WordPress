<?php get_header(); ?>
				
				<div class="ui stackable grid" id="page-grid" role="main">
					<div class="sixteen wide column" id="main-content">
						
						<article>
							<div class="ui top attached primary segment">
								<header class="article header">
									<h2 class="ui dividing header">
										404 - Page Not found
									</h2>
								</header><!-- /.article.header -->
								
								<section class="article content">
									<h4>
										The page you were looking for could not be found
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
					</div><!-- /#main-content -->
				</div><!-- /#page-grid -->
				
<?php get_footer(); ?>
