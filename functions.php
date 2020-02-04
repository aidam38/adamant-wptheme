<?php
/**
 * adamant functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package adamant
 */

if ( ! function_exists( 'adamant_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function adamant_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on adamant, use a find and replace
		 * to change 'adamant' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'adamant', get_template_directory() . '/languages' );

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
        add_image_size('thumbnail', 200, 200, true); // Large Thumbnail
        add_image_size('post-thumbnail', 200, 200, true); // Large Thumbnail
        add_image_size('large', 700, '', true); // Large Thumbnail
        add_image_size('medium', 250, '', true); // Medium Thumbnail
        add_image_size('small', 120, '', true); // Small Thumbnail
        add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Hlavní menu', 'adamant' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'adamant_custom_background_args', array(
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
endif;
add_action( 'after_setup_theme', 'adamant_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function adamant_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'adamant_content_width', 640 );
}
add_action( 'after_setup_theme', 'adamant_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function adamant_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'adamant' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'adamant' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'adamant_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function adamant_scripts() {
	wp_enqueue_style( 'adamant-style', get_stylesheet_uri() );

	wp_enqueue_script( 'adamant-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'adamant-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'adamant_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/layouts/content-sidebar.css',false,'1.1','all');

wp_register_script('jquery_script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
wp_enqueue_script('jquery_script'); // Enqueue it!

function include_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'include_jquery');

function mytheme_customize_css()
{
    ?>
         <style type="text/css">
             .site {
                 background: <?php echo get_theme_mod('adamant_site_color', '#657F6F'); ?>;
             }
             .site-footer, .site-footer a {
                 color: <?php echo get_theme_mod('adamant_site_color', '#657F6F'); ?>;
             }
             h1 {
                 color: <?php echo get_theme_mod('adamant_primary_font_color', '#F6EBD8'); ?>;
             }
             h2, h3, h4, h5, p {
                color: <?php echo get_theme_mod('adamant_secondary_font_color', '#ECDCAF'); ?>;
             }
             a {
                 color: <?php echo get_theme_mod('adamant_link_color', '#ECDCAF'); ?>;
             }
         </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');


function prefix_disable_comment_url($fields) { 
    unset($fields['url']);
    $fields['author']='<p class="comment-form-author">' . '<label for="author">' . 'Jméno' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>';
    return $fields;
}
add_filter('comment_form_default_fields','prefix_disable_comment_url');
