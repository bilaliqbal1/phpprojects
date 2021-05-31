<?php
/**
 * @package ceylonthemes
 * @subpackage eCommerce Plus
 * @since 1.0.0
 */
    $shop_starter_options = ecommerce_plus_get_theme_options();
	$copyright_text = $shop_starter_options['copyright_text'];

if (class_exists('WooCommerce') && is_shop()) {

?>

<section id="after-shop-page">
	<div>
		<?php
			
		$shop_starter_args = array( 'post_type' => 'page', 'ignore_sticky_posts' => 1 , 'post__in' => array($shop_starter_options['after_shop']));
		$shop_starter_result = new WP_Query($shop_starter_args);
		while ( $shop_starter_result->have_posts() ) :
			$shop_starter_result->the_post();
			the_content();
		endwhile;
		wp_reset_postdata();

		?>
	</div>
</section>

<?php
}
?>
</div><!-- #content -->
	
<footer id="colophon" class="site-footer" role="contentinfo" style="background-color:<?php echo esc_attr($shop_starter_options['footer_bg_color']); ?>;background-image:url('<?php echo esc_attr($shop_starter_options['footer_image']); ?>')" >

	<div class="container">
		<div class="row">
			<?php require get_template_directory() . '/inc/footer-widgets.php' ;?>		
		</div>		
	</div>


	<div class="site-info">
	
		<div class="container">


		<div class="row">
		<div class="col-sm-12 col-xs-12"> 
        <span>
        	<?php 
        		echo '<a href="https://ceylonthemes.com">'.ecommerce_plus_santize_allowed_html( $copyright_text ).'</a>'; 
			?>
    	</span>
		</div>
		
		</div>
		
		</div><!-- .container -->
    </div><!-- .site-info -->


		<?php
		if ( true === $shop_starter_options['scroll_top_visible'] ) :
		?><div class="backtotop"><?php echo ecommerce_plus_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif; ?>

		</footer>
		<div class="popup-overlay"></div>
		
		
<?php wp_footer(); ?>

</body>
</html>
