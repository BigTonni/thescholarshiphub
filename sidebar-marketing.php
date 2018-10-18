<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thescholarshiphub
 */

if ( ! is_active_sidebar( 'marketing' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'marketing' ); ?>
</aside><!-- #secondary -->
