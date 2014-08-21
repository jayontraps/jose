<?php
/**
 * jose functions and definitions
 *
 * @package jose
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'jose_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jose_setup() {


	// override default jQuery version (1.8.2) 
	if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
	function my_jquery_enqueue() {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js", false, null);
	   wp_enqueue_script('jquery');
	}



	// register portfolio post-type
	add_action('init', 'cptui_register_my_cpt_portfolio');
	function cptui_register_my_cpt_portfolio() {
	register_post_type('portfolio', array(
	'label' => 'Portfolio',
	'description' => '',
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'capability_type' => 'post',
	'map_meta_cap' => true,
	'hierarchical' => false,
	'rewrite' => array('slug' => 'portfolio', 'with_front' => true),
	'query_var' => true,
	'supports' => array('title','editor','page-attributes','post-formats', 'custom-fields', 'thumbnail'),
	'labels' => array (
	  'name' => 'Portfolio',
	  'singular_name' => 'Portfolio Item',
	  'menu_name' => 'Portfolio',
	  'add_new' => 'Add Portfolio Item',
	  'add_new_item' => 'Add New Portfolio Item',
	  'edit' => 'Edit',
	  'edit_item' => 'Edit Portfolio Item',
	  'new_item' => 'New Portfolio Item',
	  'view' => 'View Portfolio Item',
	  'view_item' => 'View Portfolio Item',
	  'search_items' => 'Search Portfolio',
	  'not_found' => 'No Portfolio Found',
	  'not_found_in_trash' => 'No Portfolio Found in Trash',
	  'parent' => 'Parent Portfolio Item',
	)
	) ); }	 
	

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on jose, use a find and replace
	 * to change 'jose' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'jose', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'jose' ),
		'footer' => __( 'Footer Menu', 'jose' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'jose_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );
}
endif; // jose_setup
add_action( 'after_setup_theme', 'jose_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function jose_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'jose' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'jose_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jose_scripts() {

	wp_enqueue_style('jose-fontsdotcom', 'http://fast.fonts.net/cssapi/6d7687f4-16fc-4c67-aea7-bab36c3d5397.css');

	wp_enqueue_style( 'jose-google-fonts', 'http://fonts.googleapis.com/css?family=Sorts+Mill+Goudy|News+Cycle');

	wp_enqueue_style( 'jose-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jose-modenizr', get_template_directory_uri() . '/js/modernizr-2.8.0.min.js', array(), false);

	// wp_enqueue_script( 'jose-Picturefill', get_template_directory_uri() . '/js/picturefill.min.js', array(), false);
	// wp_enqueue_script( 'jose-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	// wp_enqueue_script( 'jose-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'jose-jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '20120206', true );

	// combined above:
	wp_enqueue_script( 'jose-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20120206', true );

	wp_enqueue_script( 'jose-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '20140808', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jose_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
