<?php
add_action('shop_starter_banner', 'shop_starter_banner');

function shop_starter_banner(){

$shop_starter_options  = ecommerce_plus_get_theme_options(); 


	if($shop_starter_options['banner_image'] !='') { 
	
	?>
		<section id="top-banner">
			<div class="text-center">
				<?php 
					echo '<a href="'.esc_url($shop_starter_options['banner_link']).'" ><img src="'.esc_url($shop_starter_options['banner_image']).'" /></a>';	
				?>
			</div>
		</section>
	<?php	
	}


}