<?php
/**
 * Buzz Store functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Buzz_Store
 */

if ( ! function_exists( 'buzzstore_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function buzzstore_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Buzz Store, use a find and replace
	 * to change 'buzzstore' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'buzzstore', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// WooCommerce Plugins Support
	add_theme_support( 'woocommerce' );

	// Set up the WordPress Gallery Lightbox
	add_theme_support('wc-product-gallery-lightbox');
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	*/
	add_theme_support( 'custom-logo', array(
		'width'       => 190,
		'height'      => 60,
		'flex-width'  => true,				
		'flex-height' => true,
		'header-text' => array( '.site-title', '.site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );
	add_image_size('buzzstore-banner-image', 1350, 485, true); // banner
    add_image_size('buzzstore-news-image', 370, 285, true); // Home Blog
	add_image_size('buzzstore-news-details-image', 850, 385, true); // Details Blog
	add_image_size('buzzstore-cat-image', 275, 370, true);
			

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'topmenu' => esc_html__( 'Top Menu', 'buzzstore' ),
		'primary' => esc_html__( 'Primary', 'buzzstore' ),
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
	add_theme_support( 'custom-background', apply_filters( 'buzzstore_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // buzzstore_setup
add_action( 'after_setup_theme', 'buzzstore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'buzzstore_widgets_init' ) ) {
	function buzzstore_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'buzzstore_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'buzzstore_content_width', 0 );
}
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( ! function_exists( 'buzzstore_widgets_init' ) ) {
	function buzzstore_widgets_init() {
		//sidebar-1
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar Widget Area', 'buzzstore' ),
			'id'            => 'buzzsidebarone',
			'description'   => esc_html__( 'Add widgets here.', 'buzzstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title wow fadeInUp" data-wow-delay="0.3s">',			
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar Widget Area', 'buzzstore' ),
			'id'            => 'buzzsidebartwo',
			'description'   => esc_html__( 'Add widgets here.', 'buzzstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title wow fadeInUp" data-wow-delay="0.3s">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Buzz : Home Main Widget Area', 'buzzstore' ),
			'id'            => 'buzzstorehomearea',
			'description'   => esc_html__( 'Add widgets here. (Note :- Buzz : Home Main Widget only wroking when you are create a new page & select PageTemplate: Front Page & set In Front Page, that you created', 'buzzstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title wow fadeInUp" data-wow-delay="0.3s">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area One', 'buzzstore' ),
			'id'            => 'buzzstorefooterone',
			'description'   => esc_html__( 'Add widgets here.', 'buzzstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area Two', 'buzzstore' ),
			'id'            => 'buzzstorefootertwo',
			'description'   => esc_html__( 'Add widgets here.', 'buzzstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area Three', 'buzzstore' ),
			'id'            => 'buzzstorefooterthree',
			'description'   => esc_html__( 'Add widgets here.', 'buzzstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area Four', 'buzzstore' ),
			'id'            => 'buzzstorefooterfour',
			'description'   => esc_html__( 'Add widgets here.', 'buzzstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
	add_action( 'widgets_init', 'buzzstore_widgets_init' );
}
/*****************************************************************
** Enqueue scripts and styles.                                  **
******************************************************************/
function buzzstore_scripts() {

		$buzzstore_theme = wp_get_theme();
		$theme_version = $buzzstore_theme->get( 'Version' );

		/* BuzzStore Google Font */
		$buzzstore_font_args = array(
	        'family' => 'Open+Sans:700,600,800,400|Poppins:400,300,500,600,700|Montserrat:400,500,600,700,800',
	    );
	    wp_enqueue_style('buzzstore-google-fonts', add_query_arg( $buzzstore_font_args, "//fonts.googleapis.com/css" ) );
		
	    /* BuzzStore Font Awesome */
	    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', $theme_version );

	    /* BuzzStore Simple Line Icons */
	    wp_enqueue_style( 'simple-line-icons', get_template_directory_uri() . '/assets/library/simple-line-icons/css/simple-line-icons.css', $theme_version );	    
	   
	   	/*BuzzStore Owl Carousel CSS*/
	   	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/library/owlcarousel/css/owl.carousel.css', $theme_version );
	   	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/assets/library/owlcarousel/css/owl.theme.css', $theme_version );

	   	/*BuzzStore Bxslider CSS*/
	   	wp_enqueue_style( 'jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/css/jquery.bxslider.min.css', $theme_version );

	    /* BuzzStore Main Style */
	    wp_enqueue_style( 'buzzstore-style', get_stylesheet_uri() );

	    if ( has_header_image() ) {
	    	$custom_css = '.buzz-main-header{ background-image: url("' . esc_url( get_header_image() ) . '"); background-repeat: no-repeat; background-position: center center; background-size: cover; }';
	    	wp_add_inline_style( 'buzzstore-style', $custom_css );
	    }

	    /*BuzzStore Animation */
    	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/library/animate/animate.css', $theme_version );
	  	
 		/*BuzzStore Owl Carousel JS*/
 		wp_enqueue_script('owl-carousel-min', get_template_directory_uri() . '/assets/library/owlcarousel/js/owl.carousel.min.js', array('jquery'), $theme_version, true);
 	
 		/*BuzzStore Bxslider*/
 		wp_enqueue_script('jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/js/jquery.bxslider.min.js', array('jquery'), '4.2.5', 1);
  	
	    /* BuzzStore html5 */
	    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), $theme_version, false);
	    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	    /* BuzzStore Respond */
	    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), $theme_version, false);
	    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    	/*BuzzStore Wow */
    	wp_enqueue_script('wow', get_template_directory_uri() . '/assets/library/wow/js/wow.min.js', array('jquery'), $theme_version, true);
    	
	    /* BuzzStore Jquery Section Start */
	    wp_enqueue_script( 'buzzstore-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), $theme_version, true );

	    wp_enqueue_script( 'buzzstore-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), $theme_version, true );

	    /* BuzzStore Isotope */
	    wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri() . '/assets/library/isotope/js/isotope.pkgd.min.js', array(), $theme_version, true );

	    /* BuzzStore Imagesloaded */
	    wp_enqueue_script( 'imagesloaded' );

	    /* BuzzStore Sidebar Widget Ticker */
    	wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/assets/library/theia-sticky-sidebar/js/theia-sticky-sidebar.min.js', array('jquery'), esc_attr( $theme_version ), true);


	    /* BuzzStore SmoothScroll */
	    wp_enqueue_script( 'SmoothScroll', get_template_directory_uri() . '/assets/library/smoothscroll/js/SmoothScroll.min.js', $theme_version, true );
		
	    /* BuzzStore Theme Custom js */
	    wp_enqueue_script('buzzstore-custom', get_template_directory_uri() . '/assets/js/buzzstore-custom.js', array('jquery'), $theme_version, 'ture');

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
}
add_action( 'wp_enqueue_scripts', 'buzzstore_scripts' );


/**
 * Admin Enqueue scripts and styles.
*/
if ( ! function_exists( 'buzzstore_media_scripts' ) ) {
    function buzzstore_media_scripts($hook) {

    	if( 'widgets.php' != $hook )
        return;
        wp_register_script('buzzstore-media-uploader', get_template_directory_uri() . '/assets/js/buzzstore-admin.js', array('jquery') );
        wp_enqueue_script('buzzstore-media-uploader');
        wp_localize_script('buzzstore-media-uploader', 'buzzstore_widget_img', array(
            'upload' => esc_html__('Upload', 'buzzstore'),
            'remove' => esc_html__('Remove', 'buzzstore')
        ));
        wp_enqueue_style( 'buzzstore-admin-style', get_template_directory_uri() . '/assets/css/buzzstore-admin.css');    
    }
}
add_action('admin_enqueue_scripts', 'buzzstore_media_scripts');


/**
 * Require init.
*/
require  trailingslashit( get_template_directory() ).'sparklethemes/init.php';


function buzzstore_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
 }
 add_action( 'wp_head', 'buzzstore_pingback_header' );
 

if ( isset( $wp_customize->selective_refresh ) ) {

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title',
		'container_inclusive' => false,
		'render_callback' => 'buzzstore_customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'container_inclusive' => false,
		'render_callback' => 'buzzstore_customize_partial_blogdescription',
	) );

	
	$wp_customize->selective_refresh->add_partial( 'buzzstore_header_leftside_options', array(
		'selector' => '.buzz-topleft',
		'container_inclusive' => false,
	) );

	$wp_customize->selective_refresh->add_partial( 'buzzstore_social_facebook', array(
		'selector' => '.buzz-socila-link',
		'container_inclusive' => false,
	) );

	$wp_customize->selective_refresh->add_partial( 'paymentlogo_image_two', array(
		'selector' => '.footer-payments',
		'container_inclusive' => false,
	) );

	$wp_customize->selective_refresh->add_partial( 'buzzstore_search_options', array(
		'selector' => '.header-search',
		'container_inclusive' => false,
	) );

	$wp_customize->selective_refresh->add_partial( 'buzzstore_display_wishlist', array(
		'selector' => '.buzz-topright',
		'container_inclusive' => false,
	) );

	$wp_customize->selective_refresh->add_partial( 'buzzstore_icon_block_section', array(
		'selector' => '.buzz-services',
		'container_inclusive' => false,
	) );	
			
	$wp_customize->selective_refresh->add_partial( 'buzzstore_woocommerce_enable_disable_section', array(
		'selector' => '.breadcrumbswrap',
		'container_inclusive' => false,
	) );
	
	$wp_customize->selective_refresh->add_partial( 'buzzstore_footer_buttom_copyright_setting', array(
		'selector' => '.footer_copyright',
		'container_inclusive' => false,
	) );

}

function buzzstore_customize_partial_blogname() {
	bloginfo( 'name' );
}
function buzzstore_customize_partial_blogdescription() {
	bloginfo( 'description' );
}