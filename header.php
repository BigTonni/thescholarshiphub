<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thescholarshiphub
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<!-- Google Adsense -->
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		 (adsbygoogle = window.adsbygoogle || []).push({
			  google_ad_client: "ca-pub-9269256409081540",
			  enable_page_level_ads: true
		 });
	</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', THEME_DOMAIN ); ?></a>
        <div class="header_wrapper">
            <header id="masthead" class="site-header" role="banner">
                    <div class="site-branding">
                            <?php
                            the_custom_logo();
                            $thescholarshiphub_description = get_bloginfo( 'description', 'display' );
                            if ( $thescholarshiphub_description || is_customize_preview() ) {
                                    ?>
                                    <p class="site-description"><?php echo $thescholarshiphub_description; /* WPCS: xss ok. */ ?></p>
                            <?php } ?>
                    </div><!-- .site-branding -->

                    <nav id="site-navigation" class="main-navigation">
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i>
                                <!-- <?php esc_html_e( 'Primary Menu', THEME_DOMAIN ); ?> -->
                            </button>
                            <?php
                            wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_id'        => 'primary-menu',
                            ) );
                            ?>
                    </nav><!-- #site-navigation -->
                    <div class="searchicon">
                            <i class="fa fa-search"></i>
                    </div>
                    <?php echo get_search_form ( false ); ?>
            </header><!-- #masthead -->
        </div>

        <div id="content" class="site-content">
            