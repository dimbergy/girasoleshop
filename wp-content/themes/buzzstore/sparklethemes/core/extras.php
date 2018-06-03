<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Buzz_Store
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function buzzstore_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	//Web Layout
	if( get_theme_mod( 'buzzstore_webpage_layout_options', 'fullwidth' ) == 'boxed') {
		$classes[] = 'boxed';
	}

	if( is_singular( array( 'post','page' ) ) ){
		global $post;
		$post_sidebar = esc_attr( get_post_meta($post->ID, 'buzzstore_page_layouts', true) );
		if(!$post_sidebar){
			$post_sidebar = 'rightsidebar';
		}
		$classes[] = $post_sidebar;
	}

	if( is_home() || is_search() || is_category() || is_tag() || is_attachment() ){
		$classes[] = 'rightsidebar';
	}

	if ( buzzstore_is_woocommerce_activated() ) {
	    
	    if( is_product_category() || is_shop() ) {
	        $woo_page_layout = esc_attr( get_theme_mod( 'buzzstore_woocommerce_category_page_layout','rightsidebar' ) );
	        if(!$woo_page_layout){
	            $woo_page_layout = 'rightsidebar';
	        }
	        $classes[] = $woo_page_layout;
	    }

	    if( is_singular('product') ) {
	        $woo_page_layout = esc_attr( get_theme_mod( 'buzzstore_woocommerce_product_page_layout','rightsidebar' ) );
	        if(!$woo_page_layout){
	            $woo_page_layout = 'rightsidebar';
	        }
	        $classes[] = $woo_page_layout;
	    }

	    $classes[] = 'woocommerce';
	}

	return $classes;
}
add_filter( 'body_class', 'buzzstore_body_classes' );