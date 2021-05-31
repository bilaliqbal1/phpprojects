<?php
/**
 * Layout options
 * @package ceylonthemes
 * @subpackage eCommerce Plus
 * @since 1.0.0
 */
global $ecommerce_plus_options;

// Add sidebar section
$wp_customize->add_section( 'ecommerce_plus_layout', array(
	'title'               => esc_html__('Layout','ecommerce-plus'),
	'description'         => esc_html__( 'Layout options.', 'ecommerce-plus' ),
	'panel'               => 'ecommerce_plus_theme_options_panel',
) );



//Header
$wp_customize->add_setting( 'ecommerce_plus_options[site_header_layout]', array(
	'sanitize_callback'   => 'ecommerce_plus_sanitize_select',
	'default'             => $options['site_header_layout'],
	'type'				=> 'option',
) );


$wp_customize->add_control(  new ecommerce_plus_Custom_Radio_Image_Control ( $wp_customize, 'ecommerce_plus_options[site_header_layout]', array(
	'label'               => esc_html__( 'Site Header Layout', 'ecommerce-plus' ),
	'description'         => esc_html__( '(Edit page and Change Page header layout if changes not effects.)', 'ecommerce-plus' ),
	'section'             => 'ecommerce_plus_layout',
	'choices'			  => ecommerce_plus_header_layout(),
) ) );



// Site layout setting and control.
$wp_customize->add_setting( 'ecommerce_plus_options[site_layout]', array(
	'sanitize_callback'   => 'ecommerce_plus_sanitize_select',
	'default'             => $options['site_layout'],
	'type'				=> 'option',
) );


$wp_customize->add_control(  new ecommerce_plus_Custom_Radio_Image_Control ( $wp_customize, 'ecommerce_plus_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'ecommerce-plus' ),
	'section'             => 'ecommerce_plus_layout',
	'choices'			  => ecommerce_plus_site_layout(),
) ) );


// Checkout page

$wp_customize->add_setting( 'ecommerce_plus_options[two_colum_checkout]', array(
	'default'   		=> true,
	'sanitize_callback' => 'ecommerce_plus_sanitize_checkbox',
	'type'      		=> 'option'
));

$wp_customize->add_control('ecommerce_plus_options[two_colum_checkout]',
	array(
		'section'   => 'ecommerce_plus_layout',
		'label'     => esc_html__( 'WooCommerce Two Colum Checkout Page', 'ecommerce-plus' ),
		'type'      => 'checkbox'
));

//WooCommerce Sidebars

$wp_customize->add_setting( 'ecommerce_plus_options[woo_sidebar_position]', array(
	'sanitize_callback'   	=> 'ecommerce_plus_sanitize_select',
	'default'             	=> $options['sidebar_position'],
	'type'					=> 'option',
));

$wp_customize->add_control(  new ecommerce_plus_Custom_Radio_Image_Control ( $wp_customize, 'ecommerce_plus_options[woo_sidebar_position]', array(
	'label'               => esc_html__( 'WooCommerce Sidebar Layout', 'ecommerce-plus' ),
	'section'             => 'ecommerce_plus_layout',
	'choices'			  => ecommerce_plus_woo_sidebar_position(),
)));

// Post sidebar position setting and control.
$wp_customize->add_setting( 'ecommerce_plus_options[post_sidebar_position]', array(
	'sanitize_callback'   => 'ecommerce_plus_sanitize_select',
	'default'             => $options['post_sidebar_position'],
	'type'      => 'option',
) );

$wp_customize->add_control(  new ecommerce_plus_Custom_Radio_Image_Control ( $wp_customize, 'ecommerce_plus_options[post_sidebar_position]', array(
	'label'               => esc_html__( 'Posts Sidebar Layout', 'ecommerce-plus' ),
	'section'             => 'ecommerce_plus_layout',
	'choices'			  => ecommerce_plus_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'ecommerce_plus_options[page_sidebar_position]', array(
	'sanitize_callback'   => 'ecommerce_plus_sanitize_select',
	'default'             => $options['page_sidebar_position'],
	'type'				=> 'option',
	
) );

$wp_customize->add_control( new ecommerce_plus_Custom_Radio_Image_Control( $wp_customize, 'ecommerce_plus_options[page_sidebar_position]', array(
	'label'               => esc_html__( 'Pages Sidebar Layout', 'ecommerce-plus' ),
	'section'             => 'ecommerce_plus_layout',
	'choices'			  => ecommerce_plus_sidebar_position(),
) ) );