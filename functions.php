<?php
/**
 * thescholarshiphub functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thescholarshiphub
 */

if ( ! function_exists( 'thescholarshiphub_setup' ) ) {
    
define("THEME_DIR", get_template_directory());
define("THEME_DIR_URI", get_template_directory_uri());
define("THEME_INCLUDES", THEME_DIR . "/inc");
define("THEME_INCLUDES_URI", THEME_DIR_URI . "/inc");
define("THEME_DOMAIN", 'thescholarshiphub');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function thescholarshiphub_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on thescholarshiphub, use a find and replace
         * to change 'thescholarshiphub' to the name of your theme in all the template files.
         */
        load_theme_textdomain( THEME_DOMAIN, THEME_DIR . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
                'primary' => esc_html__( 'Primary', THEME_DOMAIN ),
                'footer_links' => esc_html__( 'Footer Links', THEME_DOMAIN ),
                'footer_scholarship' => esc_html__( 'Footer Scholarship', THEME_DOMAIN ),
                'footer_bottom' => esc_html__( 'Footer Bottom Bar', THEME_DOMAIN ),
                'mobile_primary' => esc_html__( 'Mobile Primary', THEME_DOMAIN ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
        ) );
                /*
        * Enable support for Post Formats.
        * See https://developer.wordpress.org/themes/functionality/post-formats/
        */
       add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'thescholarshiphub_custom_background_args', array(
                'default-color' => 'ffffff',
                'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
        ) );
}
}
add_action( 'after_setup_theme', 'thescholarshiphub_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thescholarshiphub_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'thescholarshiphub_content_width', 640 );
}
add_action( 'after_setup_theme', 'thescholarshiphub_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thescholarshiphub_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Post Sidebar', THEME_DOMAIN ),
		'id'            => 'sidebar_single',
		'description'   => esc_html__( 'Add widgets here.', THEME_DOMAIN ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', THEME_DOMAIN ),
		'id'            => 'page',
		'description'   => esc_html__( 'Add widgets here.', THEME_DOMAIN ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        register_sidebar( array(
		'name'          => esc_html__( 'Home Sidebar', THEME_DOMAIN ),
		'id'            => 'sidebar_home',
		'description'   => esc_html__( 'Add widgets here.', THEME_DOMAIN ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        register_sidebar( array( 
            'name'  => __( 'Footer Sidebar 1', THEME_DOMAIN ),
            'id'    => 'tsh_footer_1',
            'class' => 'tsh_footer_1',
            'before_widget' => '',
            'after_widget'  => '',
        ) );
        register_sidebar( array( 
            'name'  => __( 'Footer Sidebar 2', THEME_DOMAIN ),
            'id'    => 'tsh_footer_2',
            'class' => 'tsh_footer_2',
            'before_widget' => '',
            'after_widget'  => '',
        ) );
        register_sidebar( array( 
            'name'  => __( 'Footer Sidebar 3', THEME_DOMAIN ),
            'id'    => 'tsh_footer_3',
            'class' => 'tsh_footer_3',
            'before_widget' => '',
            'after_widget'  => '',
        ) );
        register_sidebar( array( 
            'name'  => __( 'Footer Sidebar 4', THEME_DOMAIN ),
            'id'    => 'tsh_footer_4',
            'class' => 'tsh_footer_4',
            'before_widget' => '',
            'after_widget'  => '',
        ) );
        
        // Register and load the widget for Recent Posts
        register_widget( 'WP_TSH_Widget_Recent_Posts' );
        
        register_widget( 'WP_TSH_Widget_Find_Scholarship' );
        
        register_widget( 'WP_TSH_Widget_List_Post_Types' );
}
add_action( 'widgets_init', 'thescholarshiphub_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thescholarshiphub_scripts() {
	wp_enqueue_style( 'thescholarshiphub-style', get_stylesheet_uri() );
                
	wp_enqueue_style( 'fontawesome', THEME_DIR_URI . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'mini-bootstrap', THEME_DIR_URI . '/assets/css/mini-bootstrap.css' );
	wp_enqueue_style( 'tsh_carousel', THEME_DIR_URI . '/assets/css/owl.carousel.min.css' );        
	wp_enqueue_style( 'responsive', THEME_DIR_URI . '/assets/css/responsive.css' );
        
        if( is_front_page() ){
            wp_enqueue_style( 'home', THEME_DIR_URI . '/assets/css/home.css' );
        }
        if(is_home() ){
            wp_enqueue_style( 'blog', THEME_DIR_URI . '/assets/css/blog.css' );
        }
        if( is_page_template('templates/template-student-calculator.php') ){
            wp_enqueue_style( 'student-calculator', THEME_DIR_URI . '/assets/css/calculator.css' );
        }

	wp_enqueue_script( 'thescholarshiphub-navigation', THEME_DIR_URI . '/assets/js/navigation.js', array(), '20180925', true );

	wp_enqueue_script( 'thescholarshiphub-skip-link-focus-fix', THEME_DIR_URI . '/assets/js/skip-link-focus-fix.js', array(), '20180925', true );        
        
        wp_enqueue_script( 'tsh_libs', THEME_DIR_URI . '/assets/js/libs.min.js', array(), '', true );
        
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', THEME_DIR_URI . '/assets/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
        
        $params = array(
//                'ajax_url'          => admin_url( 'admin-ajax.php' ),
        );

        wp_enqueue_script( 'tsh_front', THEME_DIR_URI . '/assets/js/front.js', array('jquery', 'tsh_libs'), '', true );
        wp_localize_script( 'tsh_front', 'TSHParams', $params );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thescholarshiphub_scripts' );

/**
 * Implement the Custom Header feature.
 */
require_once THEME_INCLUDES . '/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once THEME_INCLUDES . '/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once THEME_INCLUDES . '/template-functions.php';

/**
 * Customizer additions.
 */
require_once THEME_INCLUDES . '/customizer.php';

require_once THEME_INCLUDES .'/tsh_ajax.php';
require_once THEME_INCLUDES .'/tsh_shortcodes.php';

/**
 * Widgets.
 */
require_once THEME_INCLUDES . '/class-wp-tsh-widget-recent-posts.php';
require_once THEME_INCLUDES . '/class-wp-tsh-widget-find-scholarship.php';
require_once THEME_INCLUDES . '/class-wp-tsh-widget-list-post-types.php';

if( is_admin() ){
        /**
        * Theme options.
        */
        require_once THEME_INCLUDES . '/options/theme-options.php';
	require_once THEME_INCLUDES . '/admin/class-tsh-admin.php';
	require_once THEME_INCLUDES . '/admin/class-tsh-location.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once THEME_INCLUDES . '/jetpack.php';
}
