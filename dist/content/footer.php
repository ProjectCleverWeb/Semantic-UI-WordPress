<?php
/**
 * The default footer.
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
				if (has_nav_menu($menu_loc = 'footer-menu')) {
					?>
					<div class="row">
						<div class="sixteen wide column">
							<?php
							wp_nav_menu(array(
								'theme_location'  => $menu_loc,
								'menu_class'      => 'ui menu',
								'items_wrap'      => '<nav id="%1$s" class="%2$s">%3$s</nav>',
								'depth'           => 2, // currently there is a bug that prevents a depth > 2 from displaying correctly
								'walker'          => new \semantic\walker\nav_menu
							));
							?>
						</div>
					</div>
					<?php
				}
				?>
				<div class="row">
					<div class="eight wide column">
						<div class="ui center aligned basic segment">
							<?php
							if ($theme->get_option('powered_by')) {
								?>Proudly Powered By <a class="inverted" href="http://wordpress.org/">WordPress</a> &amp; <a class="inverted" href="http://semantic-ui.com/">Semantic UI</a>.<?php
							}
							?>
						</div>
					</div>
					<div class="eight wide column">
						<div class="ui center aligned basic segment">
							&copy; Copyright
							<?php
							$copyright_holder     = $theme->get_option('copyright_holder');
							$copyright_holder_url = $theme->get_option('copyright_holder_url');
							$copyright_year       = $theme->get_option('copyright_year');
							
							if ($copyright_holder) {
								if ($copyright_holder_url) {
									printf('<a class="inverted" href="%1$s">%2$s</a> ', $copyright_holder_url, $copyright_holder);
								} else {
									echo $copyright_holder.' ';
								}
								if ((int) $copyright_year) {
									settype($copyright_year, 'integer');
								} else {
									$copyright_year = (int) date('Y');
								}
							} else {
								?>
								<a href="https://github.com/ProjectCleverWeb" >Nicholas Jordon</a>
								<?php
								$copyright_year = 2014;
							}
							if ($copyright_year == (int) date('Y')) {
								echo $copyright_year;
							} else {
								echo $copyright_year.' - '.date('Y');
							}
							if ($theme->get_option('copyright_extra')) {
								echo ' - All Rights Reserved';
							}
							?>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	
	<!-- Modals -->
	<?php template_part($theme->content_sub_path.'/modals'); ?>
	<!-- /Modals -->
	
	
	<?php wp_footer(); ?>
</body>
</html>
