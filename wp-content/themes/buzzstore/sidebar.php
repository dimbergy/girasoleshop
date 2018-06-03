<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buzz_Store
 */

$post_sidebar = esc_attr( get_post_meta($post->ID, 'buzzstore_page_layouts', true) );

if(!$post_sidebar){
	$post_sidebar = 'rightsidebar';
}

if ( $post_sidebar ==  'nosidebar' ) {
	return;
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