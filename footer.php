				
				
				<footer class="ui segment" id="page-footer" role="contentinfo">
					<div class="stackable ui grid">
						<?php if (is_active_sidebar('footer')) { ?>
						<div class="equal height row">
							<?php dynamic_sidebar('footer'); ?>
						</div>
						<?php } ?>
						<div class="row">
							<div class="eight wide column">
								<div id="copyright">
									&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> - All Rights Reserved
								</div>
							</div>
							<div class="eight wide column">
								<div id="theme-info">
									Proudly powered by <a href="http://wordpress.org">WordPress</a> &amp; <a href="http://semantic-ui.com">Semantic UI</a>
								</div>
							</div>
						</div>
					</div>
				</footer> <!-- /#page-footer -->
				
			</div><!-- /#page-column -->
			<div class="one wide column">&nbsp;</div>
		</div> <!-- /#page-container -->
		
		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>
	</body>
</html>
