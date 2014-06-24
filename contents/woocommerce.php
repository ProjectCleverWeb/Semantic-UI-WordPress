<?php
/**
 * This is meant to replace the loop on a page. Because of how Woocommerce
 * generates content, you should avoid showing this content on pages with more
 * than one sidebar, or pages with limited space.
 */

if (function_exists('woocommerce_content')) {
	woocommerce_content();
} else {
	echo 'Woocommerce content could not be found! Do you have the plugin installed?';
}
