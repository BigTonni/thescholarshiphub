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
$options = get_option('TheScholarshipHub');

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="first_title_footer">
                                            <?php dynamic_sidebar( 'tsh_footer_1' ); ?>
                                        </div>
                                        <ul class="tsh_social_icons">
                                            <?php
                                            if( !empty($options) ){
                                                $url_fb = !empty($options['25']) ? $options['25'] : false;
                                                $url_tw = !empty($options['26']) ? $options['26'] : false;
                                                $url_gp = !empty($options['27']) ? $options['27'] : false;
                                            }else{
                                                $url_tw = $url_fb = $url_gp = false;
                                            }
                                            if( $url_fb ){
                                                echo '<li><a class="fa fa-facebook" href="'. $url_fb .'" target="_blank"></a></li>';
                                            }if( $url_tw ){
                                                echo '<li><a class="fa fa-twitter" href="'. $url_tw .'" target="_blank"></a></li>';
                                            }if( $url_gp ){
                                                echo '<li><a class="fa fa-google-plus" href="'. $url_gp .'" target="_blank"></a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-5">
                                        <?php dynamic_sidebar( 'tsh_footer_2' ); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7"><?php dynamic_sidebar( 'tsh_footer_3' ); ?></div>
                                    <div class="col-md-5"><?php dynamic_sidebar( 'tsh_footer_4' ); ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>                                    
                                    <div class="col-md-9">
                                        <div class="phone_btn_link_wrap">
                                            <a class="phone_btn_link" href="#">
                                                <span><?php echo !empty($options['51']) ? $options['51'] : ''; ?></span>
                                                <span><img class="phone_btn_img" src="<?php echo THEME_DIR_URI ?>/assets/img/email-icon.png" alt="lady"></span>                                            
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- .container -->
		</div><!-- .site-info -->
                <div class="footer_bottom_wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6"><?php printf( '<p>%1$s &#169; 2012-%2$s The ScholarshipHub</p>', __( 'Copyright', THEME_DOMAIN ), date('Y') ); ?></div>
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
