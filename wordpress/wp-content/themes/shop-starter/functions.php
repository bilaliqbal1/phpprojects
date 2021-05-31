<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;



add_filter('ecommerce_plus_default_theme_options', 'shop_starter_default_settings');

function shop_starter_default_settings($ecommerce_plus_default_options){
		

	$ecommerce_plus_default_options['before_shop'] = 0;
	$ecommerce_plus_default_options['after_shop'] = 0;
	
		
	$ecommerce_plus_default_options['primary_color'] = '#ffe404';
	$ecommerce_plus_default_options['accent_color'] = '#e66d02';
	
	$ecommerce_plus_default_options['header_title_color'] = '#4c4c4c';
	
	$ecommerce_plus_default_options['store_menu_color'] = '#333333';
	$ecommerce_plus_default_options['store_menubar_color'] = '#ffef00';
	
	$ecommerce_plus_default_options['menubar_border_height'] = 0;

	$ecommerce_plus_default_options['heading_font'] = 'Google Sans';	
	$ecommerce_plus_default_options['body_font'] = 'Google Sans';	
	
	$ecommerce_plus_default_options['header_title_color'] = '#793106';
	
	//home
	$ecommerce_plus_default_options['product_section_1_product_feature']	= '';
	$ecommerce_plus_default_options['product_section_1_slider']				= true;
	$ecommerce_plus_default_options['product_section_1_type']				= 0;
	$ecommerce_plus_default_options['product_section_1_num_products']		= 8;
	$ecommerce_plus_default_options['product_section_1_title']				= esc_html__('Product Category', 'shop-starter');
		
	$ecommerce_plus_default_options['product_section_2_product_feature'] 	= 'on-sale';
	$ecommerce_plus_default_options['product_section_2_slider']				= true;
	$ecommerce_plus_default_options['product_section_2_type']				= 1;
	$ecommerce_plus_default_options['product_section_2_num_products']		= 8;
	$ecommerce_plus_default_options['product_section_2_colums']				= 'col-md-3 col-sm-3 col-lg-3 col-xs-6';
	$ecommerce_plus_default_options['product_section_2_title']				= esc_html__('Products On Sale', 'shop-starter');
		
	$ecommerce_plus_default_options['product_section_3_product_feature'] 	= 'featured';
	$ecommerce_plus_default_options['product_section_3_slider']				= true;
	$ecommerce_plus_default_options['product_section_3_type']				= 1;
	$ecommerce_plus_default_options['product_section_3_num_products']		= 8;
	$ecommerce_plus_default_options['product_section_3_title']				= esc_html__('Featured Products', 'shop-starter');
	
	
	$ecommerce_plus_default_options['product_section_4_product_feature'] 	= 'latest';
	$ecommerce_plus_default_options['product_section_4_slider']				= true;
	$ecommerce_plus_default_options['product_section_4_type']				= 1;
	$ecommerce_plus_default_options['product_section_4_num_products']		= 8;
	$ecommerce_plus_default_options['product_section_4_title']				= esc_html__('New Arrivals', 'shop-starter');
	
	
	return $ecommerce_plus_default_options;
}



// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'shop_starter_locale_css' ) ):
    function shop_starter_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'shop_starter_locale_css' );

if ( !function_exists( 'shop_starter_parent_css' ) ):
    function shop_starter_parent_css() {
        wp_enqueue_style( 'shop_starter_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'shop_starter_parent_css', 10 );

// END ENQUEUE PARENT ACTION


require_once (get_stylesheet_directory() . '/inc/actions.php');

add_action( 'customize_register', 'shop_starter_customizer_settings' );

function shop_starter_customizer_settings( $wp_customize ) {

	global $ecommerce_plus_options;	
	
	$wp_customize->add_section( 'ecommerce_plus_woo_options', array(
		'title'             => esc_html__( 'Shop Page','shop-starter' ),
		'description'       => esc_html__( 'WooCommerce plugin related options.', 'shop-starter' ),
		'panel'             => 'ecommerce_plus_theme_options_panel',
		'priority'   		=> 6,
	) );

		
	//shop pages 1
	$wp_customize->add_setting('ecommerce_plus_options[before_shop]' , array(
		'default'    		=> $ecommerce_plus_options['before_shop'],
		'sanitize_callback' => 'absint',
		'type'				=>'option',

	));

	$wp_customize->add_control('ecommerce_plus_options[before_shop]' , array(
		'label' 	=> __('Before Shop', 'shop-starter' ),
		'section' 	=> 'ecommerce_plus_woo_options',
		'type'		=> 'dropdown-pages',
	) );	

	
	//shop pages 2
	$wp_customize->add_setting('ecommerce_plus_options[after_shop]' , array(
		'default'    		=> $ecommerce_plus_options['after_shop'],
		'sanitize_callback' => 'absint',
		'type'				=>'option',

	));

	$wp_customize->add_control('ecommerce_plus_options[after_shop]' , array(
		'label' => __('After Shop', 'shop-starter' ),
		'section' => 'ecommerce_plus_woo_options',
		'type'=> 'dropdown-pages',
	) );
	

	// banner image
	$wp_customize->add_setting( 'ecommerce_plus_options[banner_image]' , 
		array(
			'default' 		=> '',
			'capability'     => 'edit_theme_options',
			'type'				=>'option',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'ecommerce_plus_options[banner_image]' ,
		array(
			'label'         => __( 'Header Banner Image', 'shop-starter' ),
			'description'	=> __('Upload banner image', 'shop-starter'),
			'settings'  	=> 'ecommerce_plus_options[banner_image]',
			'section'       => 'ecommerce_plus_header',
		))
	);
	
	//
	$wp_customize->add_setting('ecommerce_plus_options[banner_link]' , array(
		'default'    => '#',
		'sanitize_callback' => 'esc_url_raw',
		'type'				=>'option',
	));
	
	$wp_customize->add_control('ecommerce_plus_options[banner_link]' , array(
		'label'   => __('Header Banner Link', 'shop-starter' ),
		'section' => 'ecommerce_plus_header',
		'type'    => 'url',
	) );
	


}// end customizer


		

