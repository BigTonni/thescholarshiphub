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
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', THEME_DOMAIN ); ?></a>
        <div class="header_wrapper">
            <header id="masthead" class="site-header" role="banner">
                    <div class="site-branding">
                            <?php
                            the_custom_logo();
                            if ( is_front_page() || is_home() ) {
                                    ?>
                                    <!--<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>-->
                                    <?php
                            } else {
                                    ?>
                                    <!--<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>-->
                                    <?php
                            }
                            $thescholarshiphub_description = get_bloginfo( 'description', 'display' );
                            if ( $thescholarshiphub_description || is_customize_preview() ) {
                                    ?>
                                    <p class="site-description"><?php echo $thescholarshiphub_description; /* WPCS: xss ok. */ ?></p>
                            <?php } ?>
                    </div><!-- .site-branding -->

                    <nav id="site-navigation" class="main-navigation">
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', THEME_DOMAIN ); ?></button>
                            <?php
                            wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_id'        => 'primary-menu',
                            ) );
                            ?>
                    </nav><!-- #site-navigation -->
                    <!--<i class="far fa-search"></i>-->
                    <div class="searchicon">
                            <i class="fa fa-search"></i>
                    </div>
                    <?php echo get_search_form( false ); ?>
            </header><!-- #masthead -->
        </div>

	<div id="content" class="site-content">
