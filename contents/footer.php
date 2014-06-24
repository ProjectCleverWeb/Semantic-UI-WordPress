<?php
/**
 * The default footer.
 *
 * @package Semanitic UI for WordPress
 */
?>
				</div>
			</div>
			<footer class="ui page stackable grid" id="main-footer-grid">
				<?php
				$footer_sidebar = 'footer-widget-area-footer';
				if (is_active_sidebar($footer_sidebar)) {
					?>
					<div class="row">
						<div class="sixteen wide column">
							<div class="ui three column doubling grid">
								<?php
								dynamic_sidebar($footer_sidebar);
								?>
							</div>
						</div>
					</div>
					<?php
				}
				?>
				<div class="row">
					<div class="sixteen wide column">
						<div class="ui right aligned basic segment">
							&copy; Copyright
							<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
								<a class="inverted" href="https://plus.google.com/114320883244988786602" rel="publisher" itemprop="name">Nicholas Jordon</a>
							</span>
							2014
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	
	<!-- Modals -->
	
	<!-- /Modals -->
	
	
	<?php wp_footer(); ?>
</body>
</html>
