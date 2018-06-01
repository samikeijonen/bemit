<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bemit
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside class="site-widgets">
	<?php
		// Show subpages.
		bemit_sub_pages_navigation();

		// Show sidebar widgets.
		dynamic_sidebar( 'sidebar-1' );
	?>
</aside><!-- #secondary -->
