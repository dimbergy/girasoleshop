<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buzz_Store
 */

if( is_singular() ){
	$post_sidebar =  esc_attr( get_theme_mod( 'buzzstore_woocommerce_product_page_layout','rightsidebar' ) );
}else{
	$post_sidebar =  esc_attr( get_theme_mod( 'buzzstore_woocommerce_category_page_layout','rightsidebar' ) );
}

if( $post_sidebar == 'rightsidebar' && is_active_sidebar('buzzsidebarone')){
	?>
		<section id="secondaryright" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'buzzsidebarone' ); ?>
		</section><!-- #secondary -->
	<?php
}

if( $post_sidebar == 'leftsidebar' && is_active_sidebar('buzzsidebartwo')){
	?>
		<section id="secondaryleft" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'buzzsidebartwo' ); ?>
		</section><!-- #secondary -->
	<?php
}