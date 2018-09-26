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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <?php dynamic_sidebar( 'tsh_footer_1' ); ?>
                                <ul class="tsh_social_icons">
                                        <li><a class="fa fa-facebook-square" href="#" target="_blank"></a></li>
                                        <li><a class="fa fa-twitter-square" href="#" target="_blank"></a></li>
                                        <li><a class="fa fa-google-plus-square" href="#" target="_blank"></a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <?php dynamic_sidebar( 'tsh_footer_2' ); ?>
                            </div>
                            <div class="col-md-3">
                                <?php
                                dynamic_sidebar( 'tsh_footer_3' );
                                ?>
                            </div>
                            <div class="col-md-3">
                                <?php
                                dynamic_sidebar( 'tsh_footer_4' );                                
                                ?>
                            </div>
                        </div>

   
                    </div><!-- .container -->
		</div><!-- .site-info -->
                <div class="footer_bottom_wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6"><p>Copyright &#169; <?php echo date('Y');?> The Scholarship Hub</p></div>
                            <div class="col-md-6">
                                <?php wp_nav_menu( array(
                                        'theme_location' => 'footer_bottom',
                                        'menu_id'        => 'footer_menu_bottom',
                                ) );
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
