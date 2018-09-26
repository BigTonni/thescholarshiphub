<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package thescholarshiphub
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tsh_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'tsh_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function tsh_pingback_header() {
	if (is_singular() && pings_open()) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'tsh_pingback_header' );

function tsh_login_logout_register_menu($items, $args) {
    if ($args->theme_location != 'primary') {
        return $items;
    }

    if (is_user_logged_in()) {
        $items .= '<li><a href="' . wp_logout_url() . '">' . __('Log Out', THEME_DOMAIN) . '</a></li>';
    } else {
        $items .= '<li><a href="' . wp_login_url() . '">' . __('Login', THEME_DOMAIN) . '</a></li>';
        $items .= '<li><a href="' . wp_registration_url() . '">' . __('Register', THEME_DOMAIN) . '</a></li>';
    }

    return $items;
}

add_filter('wp_nav_menu_items', 'tsh_login_logout_register_menu', 199, 2);
