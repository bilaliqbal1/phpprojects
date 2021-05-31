<?php
function ceylon_demo_setup_get_current_theme_author(){
    $current_theme = wp_get_theme();
    return $current_theme->get('Author');
}
function ceylon_demo_setup_get_current_theme_slug(){
    $current_theme = wp_get_theme();
    return $current_theme->stylesheet;
}
function ceylon_demo_setup_get_theme_screenshot(){
    $current_theme = wp_get_theme();
    return $current_theme->get_screenshot();
}
function ceylon_demo_setup_get_theme_name(){
    $current_theme = wp_get_theme();
    return $current_theme->get('Name');
}

function ceylon_demo_setup_get_templates_lists( $theme_slug ){
    switch ($theme_slug):
        case ("ecommerce-plus" ):
            $demo_templates_lists = array(
                'demo-1' =>array(
                    'title' => __( 'Shop Demo', 'ceylon-demo-installer' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg elementor or other page builders*/
                    'author' => __( 'Ceylon Themes', 'ceylon-demo-installer' ),/*Author Name*/
                    'keywords' => array( 'woocommerce', 'shop' ),/*Search keyword*/
                    'template_url' => array(
                        'content' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.png',/*Screenshot of block*/
                    'demo_url' => 'http://demo.ceylonthemes.com/ecommerce-plus/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce',
                        ),
                        array(
                            'name'      => 'eCommerce theme Extra Functionality',
                            'slug'      => 'ecommerce-extra',
                        ),						
						
                        array(
                            'name'      => 'Elementor Page Builder',
                            'slug'      => 'elementor',
                        ),
                        array(
                            'name'      => 'Product Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist',
                        ),					
						
                        array(
                            'name'      => 'Product Quick View',
                            'slug'      => 'yith-woocommerce-quick-view',
                        ),						
						
                        array(
                            'name'      => 'Product Compare',
                            'slug'      => 'yith-woocommerce-compare',
                        ),						
						                        
						array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
				
               'demo-2' =>array(
                    'title' => __( 'Business Demo (Elementor)', 'ceylon-demo-installer' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg elementor or other page builders*/
                    'author' => __( 'Ceylon Themes', 'ceylon-demo-installer' ),/*Author Name*/
                    'keywords' => array( 'woocommerce', 'shop', 'business' ),/*Search keyword*/
                    'template_url' => array(
                        'content' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.png',/*Screenshot of block*/
                    'demo_url' => 'https://demo.ceylonthemes.com/business-demo/',/*Demo Url*/
                    /**/
                    'plugins' => array(

                        array(
                            'name'      => 'eCommerce theme Extra Functionality',
                            'slug'      => 'ecommerce-extra',
                        ),						
						
                        array(
                            'name'      => 'Elementor Page Builder',
                            'slug'      => 'elementor',
                        ),
						
						array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce',
                        ),
				
						
                        array(
                            'name'      => 'Product Quick View',
                            'slug'      => 'yith-woocommerce-quick-view',
                        ),						
					
						                        
						array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
				
				
				
            );
			
        case ( "shop-starter"):
				$demo_templates_lists = array(
		            'demo-1' =>array(
                    'title' => __( 'Shop Demo', 'ceylon-demo-installer' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg elementor or other page builders*/
                    'author' => __( 'Ceylon Themes', 'ceylon-demo-installer' ),/*Author Name*/
                    'keywords' => array( 'woocommerce', 'shop' ),/*Search keyword*/
                    'template_url' => array(
                        'content' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/content.json',
                        'options' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/options.json',
                        'widgets' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/widgets.json'
                    ),
                    'screenshot_url' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-1/screenshot.png',/*Screenshot of block*/
                    'demo_url' => 'http://demo.ceylonthemes.com/ecommerce-plus/',/*Demo Url*/
                    /**/
                    'plugins' => array(
                        array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce',
                        ),
                        array(
                            'name'      => 'eCommerce theme Extra Functionality',
                            'slug'      => 'ecommerce-extra',
                        ),						
						
                        array(
                            'name'      => 'Elementor Page Builder',
                            'slug'      => 'elementor',
                        ),
                        array(
                            'name'      => 'Product Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist',
                        ),					
						
                        array(
                            'name'      => 'Product Quick View',
                            'slug'      => 'yith-woocommerce-quick-view',
                        ),						
						
                        array(
                            'name'      => 'Product Compare',
                            'slug'      => 'yith-woocommerce-compare',
                        ),						
						                        
						array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
				
               'demo-2' =>array(
                    'title' => __( 'Business Demo (Elementor)', 'ceylon-demo-installer' ),/*Title*/
                    'is_premium' => false,/*Premium*/
                    'type' => 'normal',/*Optional eg elementor or other page builders*/
                    'author' => __( 'Ceylon Themes', 'ceylon-demo-installer' ),/*Author Name*/
                    'keywords' => array( 'woocommerce', 'shop', 'business' ),/*Search keyword*/
                    'template_url' => array(
                        'content' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/content.json',
                        'options' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/options.json',
                        'widgets' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/widgets.json'
                    ),
                    'screenshot_url' => CEYLON_DEMO_SETUP_TEMPLATE_URL.$theme_slug.'/demo-2/screenshot.png',/*Screenshot of block*/
                    'demo_url' => 'https://demo.ceylonthemes.com/business-demo/',/*Demo Url*/
                    /**/
                    'plugins' => array(

                        array(
                            'name'      => 'eCommerce theme Extra Functionality',
                            'slug'      => 'ecommerce-extra',
                        ),						
						
                        array(
                            'name'      => 'Elementor Page Builder',
                            'slug'      => 'elementor',
                        ),
						
						
						array(
                            'name'      => 'WooCommerce',
                            'slug'      => 'woocommerce',
                        ),
				
						
                        array(
                            'name'      => 'Product Quick View',
                            'slug'      => 'yith-woocommerce-quick-view',
                        ),						
					
						                        
						array(
                            'name'      => 'Contact Form 7',
                            'slug'      => 'contact-form-7',
                            'main_file' => 'wp-contact-form-7.php',
                        ),
                    )
                ),
				
            );


			
            break;
        default:
            $demo_templates_lists = array();
    endswitch;

    return $demo_templates_lists;

}