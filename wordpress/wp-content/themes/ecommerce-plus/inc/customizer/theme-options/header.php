<?php
/**
 * @package ceylonthemes
 * @subpackage eCommerce Plus
 * @since 1.0.0
 */
global $ecommerce_plus_options;

$wp_customize->add_section( 'ecommerce_plus_header', array(
	'title'             => esc_html__( 'Header','ecommerce-plus' ),
	'description'       => esc_html__( 'Edit Header layout and other options. You can create transparent header for each page by editing page and selecting transparent header option from right panel.', 'ecommerce-plus' ),
	'panel'             => 'ecommerce_plus_theme_options_panel',
) );



// menu button
$wp_customize->add_setting( 'ecommerce_plus_options[topbar_login_register_enable]', array(
	'default'   => $ecommerce_plus_options['topbar_login_register_enable'] ,
	'sanitize_callback' => 'ecommerce_plus_sanitize_checkbox',
	'type'      => 'option'
 ) );

$wp_customize->add_control('ecommerce_plus_options[topbar_login_register_enable]',
	array(
		'section'   => 'ecommerce_plus_header',
		'label'     => esc_html__( 'Display Header Button', 'ecommerce-plus' ),
		'type'      => 'checkbox'
		 )
);

// login setting and control
$wp_customize->add_setting( 'ecommerce_plus_options[topbar_login_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['topbar_login_label'],
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[topbar_login_label]', array(
	'label'           	=> esc_html__( 'Button Label', 'ecommerce-plus' ),
	'section'        	=> 'ecommerce_plus_header',
	'type'				=> 'text',
	'active_callback'	=> 'ecommerce_plus_is_login_register_meta_section_enable',
) );


// login url setting and control
$wp_customize->add_setting( 'ecommerce_plus_options[topbar_login_url]', array(
	'sanitize_callback' => 'esc_url_raw',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[topbar_login_url]', array(
	'label'           	=> esc_html__( 'Url [Link]', 'ecommerce-plus' ),
	'section'        	=> 'ecommerce_plus_header',
	'type'				=> 'url',
	'active_callback'	=> 'ecommerce_plus_is_login_register_meta_section_enable',
) );


// menu background colour
$wp_customize->add_setting(
	'ecommerce_plus_options[header_bg_color]',
	array(
		'default'     => $options['header_bg_color'],
		'type'        => 'option',
		'transport'   => 'refresh',				
		'sanitize_callback' => 'ecommerce_plus_sanitize_rgba_color',
	)
);

$wp_customize->add_control(
	new Ecommerce_Plus_Alpha_Color_Control(
		$wp_customize,
		'ecommerce_plus_options[header_bg_color]',
		array(
			'label'         =>  __('Header Background','ecommerce-plus' ),
			'section'       => 'ecommerce_plus_header',					
			'settings'      => 'ecommerce_plus_options[header_bg_color]',
			'description'   =>  __('Drag alpha slider for transparency.', 'ecommerce-plus'),
			'show_opacity'  => true,
		)
	)
);		


// menubar colors

$wp_customize->add_setting(
	'ecommerce_plus_options[store_menu_color]',
	array(
		'default'     => $options['store_menu_color'],
		'type'        => 'option',
		'transport'   => 'refresh',				
		'sanitize_callback' => 'ecommerce_plus_sanitize_rgba_color',
	)
);

$wp_customize->add_control(
	new Ecommerce_Plus_Alpha_Color_Control(
		$wp_customize,
		'ecommerce_plus_options[store_menu_color]',
		array(
			'label'         =>  __('Menu Text Color(Header Storefront Style Menu)','ecommerce-plus' ),
			'section'       => 'ecommerce_plus_header',					
			'settings'      => 'ecommerce_plus_options[store_menu_color]',
			'description'   =>  __('(Header storefron style menu)', 'ecommerce-plus'),
			'show_opacity'  => true,
		)
	)
);

//
$wp_customize->add_setting(
	'ecommerce_plus_options[store_menubar_color]',
	array(
		'default'     => $options['store_menubar_color'],
		'type'        => 'option',
		'transport'   => 'refresh',				
		'sanitize_callback' => 'ecommerce_plus_sanitize_rgba_color',
	)
);

$wp_customize->add_control(
	new Ecommerce_Plus_Alpha_Color_Control(
		$wp_customize,
		'ecommerce_plus_options[store_menubar_color]',
		array(
			'label'         =>  __('Menu Background Color(Header Storefront Style Menu)','ecommerce-plus' ),
			'section'       => 'ecommerce_plus_header',					
			'settings'      => 'ecommerce_plus_options[store_menubar_color]',
			'description'   =>  __('(Header storefront style menu)', 'ecommerce-plus'),
			'show_opacity'  => true,
		)
	)
);

//
$wp_customize->add_setting( 'ecommerce_plus_options[menubar_border_height]', array(
	'sanitize_callback' => 'absint',
	'default'			=> $options['menubar_border_height'],
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[menubar_border_height]', array(
	'label'           	=> esc_html__( 'Menubar Line Height(Header storefront style menu)', 'ecommerce-plus' ),
	'section'        	=> 'ecommerce_plus_header',
	'type'				=> 'number',
) );


//
$wp_customize->add_setting(
	'ecommerce_plus_options[menubar_border_color]',
	array(
		'default'     => $options['menubar_border_color'],
		'type'        => 'option',
		'transport'   => 'refresh',				
		'sanitize_callback' => 'ecommerce_plus_sanitize_rgba_color',
	)
);

$wp_customize->add_control(
	new Ecommerce_Plus_Alpha_Color_Control(
		$wp_customize,
		'ecommerce_plus_options[menubar_border_color]',
		array(
			'label'         =>  __('Menu Border Color(Header Storefront Style Menu)','ecommerce-plus' ),
			'section'       => 'ecommerce_plus_header',					
			'settings'      => 'ecommerce_plus_options[menubar_border_color]',
			'description'   =>  __('(Header storefront style menu)', 'ecommerce-plus'),
			'show_opacity'  => true,
		)
	)
);