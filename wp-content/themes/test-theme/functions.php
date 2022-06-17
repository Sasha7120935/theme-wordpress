<?php
/**
 * Test Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Test_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function test_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Test Theme, use a find and replace
		* to change 'test-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'test-theme', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'test-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'test_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'test_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function test_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'test_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'test_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function test_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'test-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'test-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);
    register_sidebar(
        array(
            'name'          => esc_html__( 'Right Sidebar', 'test-theme' ),
            'id'            => 'sidebar-right',
            'description'   => esc_html__( 'Add widgets here.', 'test-theme' ),
            'before_widget' => '<section id="above_right_footer">',
            'after_widget'  => '</section>',
            'before_title'  => '<div class="box first">',
            'after_title'   => '</div>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__( 'Lower Sidebar', 'test-theme' ),
            'id'            => 'sidebar-lower',
            'description'   => esc_html__( 'Add widgets here.', 'test-theme' ),
            'before_widget' => '<section id="above_footer" style="background: #090909;display: flex;padding: 29px 0px;text-align: end;color: grey;"><div class="wrapper above_footer_boxes page_text"><div class="box">',
            'after_widget'  => '</div></div></section>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__( 'Header Sidebar', 'test-theme' ),
            'id'            => 'sidebar-header',
            'description'   => esc_html__( 'Add widgets here.', 'test-theme' ),
            'before_widget' => '',
            'after_widget'  => '',
        )
    );
}
add_action( 'widgets_init', 'test_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function test_theme_scripts() {
	wp_enqueue_style( 'test-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'reset', get_template_directory_uri() . '/assets/css/reset.css', array(), _S_VERSION );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );
	wp_enqueue_style( 'light', get_template_directory_uri() . '/assets/css/light.css', array(), _S_VERSION );
	wp_enqueue_style( 'dark', get_template_directory_uri() . '/assets/css/dark.css', array(), _S_VERSION );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css', array(), _S_VERSION );
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/assets/css/prettyPhoto.css', array(), _S_VERSION );
	wp_style_add_data( 'test-theme-style', 'rtl', 'replace' );
	wp_enqueue_script( 'test-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script('min', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery','test-theme-navigation'), _S_VERSION, true  );
    wp_enqueue_script('ui', get_template_directory_uri() . '/assets/js/jquery.ui.min.js', array('jquery','min'), _S_VERSION, true  );
    wp_enqueue_script('flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.min.js', array('jquery','ui'), _S_VERSION, true  );
    wp_enqueue_script('prettyphoto', get_template_directory_uri() . '/assets/js/jquery.prettyphoto.min.js', array('jquery','flexslider'), _S_VERSION, true  );
    wp_enqueue_script('stylesheettoggle', get_template_directory_uri() . '/assets/js/jquery.stylesheettoggle.js', array('jquery','prettyphoto'), _S_VERSION, true  );
    wp_enqueue_script('onload', get_template_directory_uri() . '/assets/js/onload.js', array('jquery','stylesheettoggle'), _S_VERSION, true  );
    wp_enqueue_script('quicksand', get_template_directory_uri() . '/assets/js/jquery.quicksand.js', array('jquery','onload'), _S_VERSION, true  );
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery','quicksand'), _S_VERSION, true  );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'test_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Widget Setting
 */
require_once get_template_directory() . '/widgets/widget-about.php';
require_once get_template_directory() . '/widgets/widget-categories.php';
require_once get_template_directory() . '/widgets/widget-posts.php';
require_once get_template_directory() . '/widgets/widget-contact.php';
require_once get_template_directory() . '/widgets/widget.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * add menu
 */
function theme_support_setup(){
    register_nav_menus(array(
        'primary_menu' => __('menu in header'),
        'sidebar_menu' => __('menu in sidebar'),
        'footer_menu' => __('menu in footer')
    ));

}
add_action('after_setup_theme','theme_support_setup');
function misha_my_load_more_scripts() {

    global $wp_query;

    // In most cases it is already included on the page and this line can be removed
    wp_enqueue_script('jquery');

    // register our main script but do not enqueue it yet
    wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/myloadmore.js', array('jquery') );

    // now the most interesting part
    // we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
    // you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
    wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ) );

    wp_enqueue_script( 'my_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );
add_image_size( 'homepage-thumb', 100, 9999, true );
