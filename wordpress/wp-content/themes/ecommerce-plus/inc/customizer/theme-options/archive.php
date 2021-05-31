<?php
/**
 * Archive options
 *
 * @package ceylonthemes
 * @subpackage eCommerce Plus
 * @since 1.0.0
 */
global $ecommerce_plus_options;

// Add archive section
$wp_customize->add_section( 'ecommerce_plus_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','ecommerce-plus' ),
	'description'       => esc_html__( 'Archive options.', 'ecommerce-plus' ),
	'panel'             => 'ecommerce_plus_theme_options_panel',
) );

// Your latest posts title setting and control.
$wp_customize->add_setting( 'ecommerce_plus_options[your_latest_posts_title]', array(
	'default'           => $options['your_latest_posts_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type'      => 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[your_latest_posts_title]', array(
	'label'             => esc_html__( 'Your Latest Posts Title', 'ecommerce-plus' ),
	'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_archive_section',
	'type'				=> 'text',
	'active_callback'   => 'ecommerce_plus_is_latest_posts'
) );

// Archive date meta setting and control.

$wp_customize->add_setting( 'ecommerce_plus_options[hide_date]', array(
	'default'   => true,
	'type'      => 'option',
	'sanitize_callback' => 'ecommerce_plus_sanitize_checkbox',
 ) );

$wp_customize->add_control('ecommerce_plus_options[hide_date]',
	array(
		'section'   => 'ecommerce_plus_archive_section',
		'label'     => esc_html__( 'Hide Category', 'ecommerce-plus' ),
		'type'      => 'checkbox'
		 )
);


// Archive author category setting and control.
$wp_customize->add_setting( 'ecommerce_plus_options[hide_category]', array(
	'default'   => true,
	'type'      => 'option',
	'sanitize_callback' => 'ecommerce_plus_sanitize_checkbox',
 ) );

$wp_customize->add_control('ecommerce_plus_options[hide_category]',
	array(
		'section'   => 'ecommerce_plus_archive_section',
		'label'     => esc_html__( 'Hide Category', 'ecommerce-plus' ),
		'type'      => 'checkbox'
		 )
);