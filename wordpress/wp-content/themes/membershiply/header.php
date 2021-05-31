<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package membershiply
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'membershiply' ); ?></a>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'membershiply' ); ?></a>

		<header id="masthead" class="sheader site-header clearfix">
			<nav id="primary-site-navigation" class="primary-menu main-navigation clearfix">

				<a href="#" id="pull" class="smenu-hide toggle-mobile-menu menu-toggle" aria-controls="secondary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'membershiply' ); ?></a>
				<div class="top-nav-wrapper">
					<div class="content-wrap">
						<div class="logo-container"> 
							<?php if ( has_custom_logo() ) : ?>
								<?php the_custom_logo(); ?>
								<?php else : ?>
									<a class="logofont" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								<?php endif; ?>

							</div>
							<div class="center-main-menu">
								<?php
								wp_nav_menu( array(
									'theme_location'	=> 'menu-1',
									'menu_id'			=> 'primary-menu',
									'menu_class'		=> 'pmenu'
								) );
								?>
							</div>
						</div>
					</div>
				</nav>

				<div class="super-menu clearfix">
					<div class="super-menu-inner">
						
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
							<?php else : ?>
								<a class="logofont" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							<?php endif; ?>
						</a>
						<a href="#" id="pull" class="toggle-mobile-menu menu-toggle" aria-controls="secondary-menu" aria-expanded="false"></a>
					</div>
				</div>
				<div id="mobile-menu-overlay"></div>
			</header>

			<!-- Header img -->
			<?php if ( get_header_image() ) : ?>
				<div class="bottom-header-wrapper">
					<div class="bottom-header-text">
						<?php if (get_theme_mod('header_img_text') ) : ?>
							<div class="content-wrap">
								<div class="bottom-header-title"><?php echo esc_html(get_theme_mod('header_img_text')) ?></div>
							</div>
						<?php endif; ?>
						<?php if (get_theme_mod('header_img_text_tagline') ) : ?>
							<div class="content-wrap">
								<div class="bottom-header-paragraph"><?php echo esc_html(get_theme_mod('header_img_text_tagline')) ?></div>
							</div>
						<?php endif; ?>

						<!-- Button start -->
						<?php if (get_theme_mod('header_img_button_text') ) : ?>
							<div class="header-button-wrap">
								<a href="<?php echo esc_url(get_theme_mod('header_img_button_link')) ?>"><?php echo esc_html(get_theme_mod('header_img_button_text')) ?></a>
							</div>
						<?php endif; ?>
						<!-- Button end -->

					</div>
					<img src="<?php echo esc_url(( get_header_image()) ); ?>" alt="<?php echo esc_attr(( get_bloginfo( 'title' )) ); ?>" />
				</div>
			<?php endif; ?>
			<!-- / Header img -->


			<div class="content-wrap">


				<!-- Upper widgets -->
				<div class="header-widgets-wrapper">
					<?php if ( is_active_sidebar( 'headerwidget-1' ) ) : ?>
						<div class="header-widgets-three header-widgets-left">
							<?php dynamic_sidebar( 'headerwidget-1' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'headerwidget-2' ) ) : ?>
						<div class="header-widgets-three header-widgets-middle">
							<?php dynamic_sidebar( 'headerwidget-2' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'headerwidget-3' ) ) : ?>
						<div class="header-widgets-three header-widgets-right">
							<?php dynamic_sidebar( 'headerwidget-3' ); ?>				
						</div>
					<?php endif; ?>
				</div>
				<!-- / Upper widgets -->

			</div>

			<div id="content" class="site-content clearfix">
				<?php
				$container_class = !is_page_template('elementor_header_footer') ? 'content-wrap' : 'content-none';
				?>
				<div class="<?php echo $container_class; ?>">
