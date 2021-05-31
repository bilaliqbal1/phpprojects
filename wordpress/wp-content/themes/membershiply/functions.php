<?php
/**
 * membershiply functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package membershiply
 */


if ( ! function_exists( 'membershiply_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function membershiply_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on membershiply, use a find and replace
		 * to change 'membershiply' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'membershiply', get_template_directory() . '/languages' );

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
		set_post_thumbnail_size( 300 );

		add_image_size( 'membershiply-grid', 350 , 230, true );
		add_image_size( 'membershiply-slider', 850 );
		add_image_size( 'membershiply-small', 300 , 180, true );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'	=> esc_html__( 'Primary', 'membershiply' ),
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
		add_theme_support( 'custom-background', apply_filters( 'membershiply_custom_background_args', array(
			'default-color' => '#f1f1f1',
			'default-image' => '',
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
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'membershiply_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function membershiply_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'membershiply_content_width', 640 );
}
add_action( 'after_setup_theme', 'membershiply_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function membershiply_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'membershiply' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'membershiply' ),
		'before_widget' => '<section id="%1$s" class="fbox swidgets-wrap widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="sidebar-headline-wrapper"><div class="sidebarlines-wrapper"><div class="widget-title-lines"></div></div><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (1)', 'membershiply' ),
		'id'            => 'footerwidget-1',
		'description'   => esc_html__( 'Add widgets here.', 'membershiply' ),
		'before_widget' => '<section id="%1$s" class="fbox widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="swidget"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (2)', 'membershiply' ),
		'id'            => 'footerwidget-2',
		'description'   => esc_html__( 'Add widgets here.', 'membershiply' ),
		'before_widget' => '<section id="%1$s" class="fbox widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="swidget"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (3)', 'membershiply' ),
		'id'            => 'footerwidget-3',
		'description'   => esc_html__( 'Add widgets here.', 'membershiply' ),
		'before_widget' => '<section id="%1$s" class="fbox widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="swidget"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget (1)', 'membershiply' ),
		'id'            => 'headerwidget-1',
		'description'   => esc_html__( 'Add widgets here.', 'membershiply' ),
		'before_widget' => '<section id="%1$s" class="header-widget widget swidgets-wrap %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="swidget"><div class="sidebar-title-border"><h3 class="widget-title">',
		'after_title'   => '</h3></div></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget (2)', 'membershiply' ),
		'id'            => 'headerwidget-2',
		'description'   => esc_html__( 'Add widgets here.', 'membershiply' ),
		'before_widget' => '<section id="%1$s" class="header-widget widget swidgets-wrap %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="swidget"><div class="sidebar-title-border"><h3 class="widget-title">',
		'after_title'   => '</h3></div></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget (3)', 'membershiply' ),
		'id'            => 'headerwidget-3',
		'description'   => esc_html__( 'Add widgets here.', 'membershiply' ),
		'before_widget' => '<section id="%1$s" class="header-widget widget swidgets-wrap %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="swidget"><div class="sidebar-title-border"><h3 class="widget-title">',
		'after_title'   => '</h3></div></div>',
	) );

	
}




add_action( 'widgets_init', 'membershiply_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function membershiply_scripts() {
	wp_enqueue_style( 'membershiply-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'membershiply-style', get_stylesheet_uri() );
	wp_enqueue_script( 'membershiply-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20170823', true );
	wp_enqueue_script( 'membershiply-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20170823', true );	
	wp_enqueue_script( 'membershiply-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '20150423', true );
	wp_enqueue_script( 'membershiply-script', get_template_directory_uri() . '/js/script.js', array(), '20160720', true );
	wp_enqueue_script( 'membershiply-accessibility', get_template_directory_uri() . '/js/accessibility.js', array(), '20160720', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'membershiply_scripts' );

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

/**
 * Google fonts, credits can be found in readme.
 */

function membershiply_google_fonts() {

	wp_enqueue_style( 'membershiply-google-fonts', '//fonts.googleapis.com/css?family=Noto+Sans+JP:wght@400;500;700&display=swap', false ); 
}

add_action( 'wp_enqueue_scripts', 'membershiply_google_fonts' );


/**
 * Dots after excerpt
 */

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



/**
 * Blog Pagination 
 */
if ( !function_exists( 'membershiply_numeric_posts_nav' ) ) {
	
	function membershiply_numeric_posts_nav() {

		global $wp_query;
		$total = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			if( !$current_page = get_query_var('paged') )
				$current_page = 1;
			if( get_option('permalink_structure') ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}
			echo wp_kses_post(paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				'type' 			=> 'list',
				'prev_text'		=> 'Previous',
				'next_text'		=> 'Next',
			) ));
		}
	}
	
}


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function membershiply_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'membershiply_skip_link_focus_fix' );



require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Free Seo Optimized Responsive Theme for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'membershiply_register_required_plugins' );

function membershiply_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
    	array(
    		'name'      => 'Superb Helper',
    		'slug'      => 'superb-helper',
    		'required'  => false,
    	),

    	array(
    		'name'      => 'bbPress',
    		'slug'      => 'bbpress',
    		'required'  => false,
    	),

    	array(
    		'name'      => 'Social Share & Follow Buttons',
    		'slug'      => 'superb-social-share-and-follow-buttons',
    		'required'  => false,
    	),

    	array(
    		'name'      => 'ProfileGrid',
    		'slug'      => 'profilegrid-user-profiles-groups-and-communities',
    		'required'           => false,
    	),
    );

    $config = array(
        'id'           => 'membershiply',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );


    tgmpa( $plugins, $config );
}

/**
 * Checkbox sanitization callback example.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function membershiply_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


/**
 * Copyright and License for Upsell button by Justin Tadlock - 2016-2019 © Justin Tadlock. customizer button https://github.com/justintadlock/trt-customizer-pro
 */
require_once( trailingslashit( get_template_directory() ) . 'justinadlock-customizer-button/class-customize.php' );


/**
 * Compare page CSS
 */

function membershiply_comparepage_css($hook) {
	if ( 'appearance_page_membershiply-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'membershiply-custom-style', get_template_directory_uri() . '/css/compare.css' );
}
add_action( 'admin_enqueue_scripts', 'membershiply_comparepage_css' );

/**
 * Compare page content
 */

add_action('admin_menu', 'membershiply_themepage');
function membershiply_themepage(){
	$theme_info = add_theme_page( __('Membershiply Info','membershiply'), __('Membershiply Info','membershiply'), 'manage_options', 'membershiply-info.php', 'membershiply_info_page' );
}

function membershiply_info_page() {
	$user = wp_get_current_user();
	?>
	<div class="wrap about-wrap membershiply-add-css">
		<div>
			<h1>
				<?php echo esc_html__('Welcome to Membershiply!','membershiply'); ?>
			</h1>

			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo esc_html__("Contact Support", "membershiply"); ?></h3>
						<p><?php echo esc_html__("Getting started with a new theme can be difficult, if you have issues with Membershiply then throw us an email.", "membershiply"); ?></p>
						<p><a target="blank" href="https://superbthemes.com/help-contact/" class="button button-primary">
							<?php echo esc_html__("Contact Support", "membershiply"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo esc_html__("View our other themes", "membershiply"); ?></h3>
						<p><?php echo esc_html__("Do you like our concept but feel like the design doesn't fit your need? Then check out our website for more designs.", "membershiply"); ?></p>
						<p><a target="blank" href="https://superbthemes.com/wordpress-themes/" class="button button-primary">
							<?php echo esc_html__("View All Themes", "membershiply"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo esc_html__("Premium Edition", "membershiply"); ?></h3>
						<p><?php echo esc_html__("If you enjoy Membershiply and want to take your website to the next step, then check out our premium edition here.", "membershiply"); ?></p>
						<p><a target="blank" href="https://superbthemes.com/membershiply/" class="button button-primary">
							<?php echo esc_html__("Read More", "membershiply"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php echo esc_html__("Free Vs Premium","membershiply"); ?></h2>
		<div class="membershiply-button-container">
			<a target="blank" href="https://superbthemes.com/membershiply/" class="button button-primary">
				<?php echo esc_html__("Read Full Description", "membershiply"); ?>
			</a>
			<a target="blank" href="https://superbthemes.com/demo/membershiply/" class="button button-primary">
				<?php echo esc_html__("View Theme Demo", "membershiply"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead>
				<tr>
					<th><strong><?php echo esc_html__("Theme Feature", "membershiply"); ?></strong></th>
					<th><strong><?php echo esc_html__("Basic Version", "membershiply"); ?></strong></th>
					<th><strong><?php echo esc_html__("Premium Version", "membershiply"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php echo esc_html__("Custom Background Color", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Background Image", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Header Text & Button", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Header Image", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Header Colors", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Logo Color", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Hide/Show Logo Text", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Favicon", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Full Page Template", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Elementor Support", "membershiply"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Fully SEO Optimized", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Premium Support", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Demo Content", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Copyright Text", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Easy Google Fonts Integration", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Only Show Header On Front Page", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Hide Header Button On Mobile", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Hide Header Tagline On Mobile", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Hide Sidebar on Blog Feed", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Hide Author Name on Blog Feed", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Only Show Upper Widgets On Front Page", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Scroll To Top Button", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Scroll To Top Button Colors", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Upper Widgets Background Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Upper Widgets Title Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Upper Widgets Link Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Upper Widgets Border Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Navigation Logo Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Navigation Background Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Navigation Link Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Navigation Border Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Sidebar Headline Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Sidebar Link Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Text Headline Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Footer Headline Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Text Headline Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Footer Link Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Footer Border Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Footer Background Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Blog Feed Background Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Blog Feed Headline Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Blog Feed Byline Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Blog Feed Text Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Blog Feed Button Text Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Blog Feed Navigation Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Blog Read More Link Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Blog Read More Link Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Post/Page Background Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Post/Page Headline Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Post/Page Byline Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Post/Page Text Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Post/Page Link Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Post/Page Button Background Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Post/Page Button Text Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Customize Post/Page Border Color", "membershiply"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_attr__("No", "membershiply"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_attr__("Yes", "membershiply"); ?>" /></span></td>
				</tr>
				
			</tbody>
		</table>

	</div>
	<?php
}