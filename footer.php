<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thescholarshiphub
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<!--<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'thescholarshiphub' ) ); ?>">-->
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
//				printf( esc_html__( 'Proudly powered by %s', 'thescholarshiphub' ), 'WordPress' );
				?>
			<!--</a>-->
			<!--<span class="sep"> | </span>-->
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
