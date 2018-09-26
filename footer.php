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
                    <ul class="spndng_footer_sidebar_widgets" style="list-style:none;margin:0;padding:0;">
                            <?php dynamic_sidebar( 'spndng_footer_sidebar' ); ?>
                    </ul>
			<!--<a href="<?php echo esc_url( __( 'https://wordpress.org/', THEME_DOMAIN ) ); ?>">-->
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
//				printf( esc_html__( 'Proudly powered by %s', THEME_DOMAIN ), 'WordPress' );
				?>
			<!--</a>-->
			<!--<span class="sep"> | </span>-->
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				?>
		</div><!-- .site-info -->
                <div class="footer_bottom_wrap">
                        <div class="spndng_left_side">
                                <h3><span class="spndng_orange_text">Copyright &#169;<?php echo date('Y');?> The ScholarshipHub</h3>
                        </div>
<!--                        <div class="spndng_right_side">
                                <ul class="spndng_social_icons_block">
                                        <li><a class="fa fa-facebook-square" href="//www.facebook.com/Spandango.net" target="_blank"></a></li>
                                        <li><a class="fa fa-twitter-square" href="//twitter.com/SpandangoDoug" target="_blank"></a></li>
                                        <li><a class="fa fa-google-plus-square" href="//plus.google.com/+SpandangoNet/posts" target="_blank"></a></li>
                                </ul>
                                <div class="clear"></div>
                                <p class="spndng_contact_info">
                                        <span><?php // _e('601 Mission St, Suite 802, San Francisco, CA, 94110', 'fct'); ?></span><br>
                                        <span><?php // _e('145 Botsford St. Moncton, NB, E1A4P7', 'fct'); ?></span>
                                </p>
                        </div>-->
                </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
