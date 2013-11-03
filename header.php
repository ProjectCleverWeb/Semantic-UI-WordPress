<?php
require_once __DIR__.'/lib/scripts/sui.php';
?><!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		
		<title><?php wp_title(); ?></title>
		
		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="450">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans|Droid+Sans+Mono|Roboto:400,300,100' rel='stylesheet' type='text/css'>
		
		<!-- wp_head() -->
		<?php wp_head(); ?>
		<!-- /wp_head() -->
		
		<!-- head.js -->
		<script type="text/javascript">
			var theme_dir = "<?php echo get_template_directory_uri(); ?>";
			
			head.js(
				// dependencies
				"//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js",
				theme_dir + "/lib/javascript/modernizr.custom.js",
				
				// main
				theme_dir + "/lib/javascript/semantic.min.js",
				theme_dir + "/lib/javascript/mousetrap.min.js",
				
				function() { // Scripts are loaded, but the page may not be ready yet
					// don't show invalid images, but reserve the area if the demensions are set
					$("img").error(function () { 
						$(this).css({visibility:"hidden"}); 
					});
					
					// Semantic UI inits
					$('.ui.accordion').accordion();
					$('.ui.dropdown').dropdown();
					$('.ui.checkbox').checkbox();
					$('.ui.modal').modal();
					$('.ui.popup').popup();
					$('.ui.rating').rating();
					$('.shape').shape();
					$('.ui.sidebar').sidebar();
				}
			);
			
			head.ready(function() { // pade is ready
				
			});
		</script>
		<!-- /head.js -->
		
		<!-- Google Analytics -->
		<script type="text/javascript">
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			ga('create', 'UA-42805415-4', 'gopagoda.com');
			ga('send', 'pageview');
		</script>
		<!-- /Google Analytics -->
		
	</head>
	
	<body <?php body_class(); ?>>
		<div class="ui grid" id="page-container">
			<div class="one wide column">&nbsp;</div>
			<div class="fourteen wide column" id="page-column">
				
				<header class="ui segment" id="page-header" role="banner">
					<div class="stackable ui grid">
						<div class="row">
							<div class="sixteen wide column">
								<a href="<?php echo home_url(); ?>" rel="nofollow">
									<h1 id="blog-title"><?php bloginfo('name'); ?><br><small id="blog-desc"><?php bloginfo('description'); ?></small></h1>
								</a>
							</div>
						</div>
					</div>
					
					
					<nav role="navigation">
						<div class="ui inverted blue menu" id="main-nav">
							
							<?php
							// [comeback] this menu implementation sucks =/
							if (($locations = get_nav_menu_locations()) && isset($locations['main-nav'])) {
								$menu = wp_get_nav_menu_object($locations['main-nav']);
								
								foreach (wp_get_nav_menu_items($menu->term_id) as $menu_item) {
									if (!empty($menu_item->post_name) || !empty($menu_item->title)){
										if (empty($menu_item->title)) {
											$item_name = ucwords($menu_item->post_name);
										} else {
											$item_name = ucwords($menu_item->title);
										}
										$attr_title = '';
										if (!empty($menu_item->attr_title)){
											$attr_title = ' title="'.$menu_item->attr_title.'"';
										}
										if ($post->ID == $menu_item->object_id) {
											echo '<a class="item active"'.$attr_title.' alt="'.$item_name.'" href="'.$menu_item->url.'" >'.$item_name.'</a>';
										} else {
											echo '<a class="item"'.$attr_title.' alt="'.$item_name.'" href="'.$menu_item->url.'" >'.$item_name.'</a>';
										}
									}
								}
								
								
							}
							?>
							
							<div class="right menu">
								<a class="item" href="#">Search <i class="search link icon"></i></a>
							</div>
						</div><!-- /#main-nav -->
						
						<?php // bones_main_nav(); ?>
					</nav>
					
				</header> <!-- /#page-header -->
				