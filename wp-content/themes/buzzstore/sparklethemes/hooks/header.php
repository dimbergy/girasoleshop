<?php
/**
 * Header Section Skip Area
*/
if ( ! function_exists( 'buzzstore_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 */
	function buzzstore_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#content">
			<?php esc_html_e( 'Skip to content', 'buzzstore' ); ?>
		</a>
		<?php
	}
}
add_action( 'buzzstore_header_before', 'buzzstore_skip_links', 5 );


if ( ! function_exists( 'buzzstore_header_before' ) ) {
	/**
	 * Header area
	 * @since  1.0.0
	*/
	function buzzstore_header_before() {
		?>
			<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">		
		<?php
	}
}
add_action( 'buzzstore_header_before', 'buzzstore_header_before', 10 );

/**
 * Top header area
*/
if ( ! function_exists( 'buzzstore_top_header' ) ) {
	
	function buzzstore_top_header() { 
	   		$top_bg_color = esc_attr( get_theme_mod('buzzstore_top_header_background_color') );
	   		$top_header_options = esc_attr( get_theme_mod( 'buzzstore_top_header_display_options','yes' ) );
	   		if($top_header_options =='yes'){ 
	   	?>
	   		<div class="buzz-topheader buzz-clearfix" <?php if(!empty( $top_bg_color )){ ?>style="background-color:<?php echo esc_attr( $top_bg_color ); ?>;"<?php } ?>>
	   			<div class="buzz-container">
	   				
	   				<div class="buzz-topleft">
	   					<?php
	   						$top_left_options = esc_attr( get_theme_mod( 'buzzstore_header_leftside_options', 'topnavmenu' ) );
	   						if($top_left_options =='socialicon'){ 
	   						    buzzstore_social_links();
	   						} else if($top_left_options =='topnavmenu'){ 
	   						    wp_nav_menu( array( 'theme_location' => 'topmenu', 'depth' => 1 ) );
	   						} else if($top_left_options == 'quickinfo'){                            
	   						    buzzstore_quick_contact();
	   						}
	   					?>						
	   				</div><!-- Left section end -->

	   				<div class="buzz-topright">
	   					<ul>
	   					    <?php
	   					        $whislist_options = intval( get_theme_mod( 'buzzstore_display_wishlist', 1 ) );
	   					        $account_options = intval( get_theme_mod('buzzstore_display_myaccount_login', 1 ) );
	   					        if( $whislist_options == 1 ){	   					            
	   					    ?>
	   					    <?php if(function_exists( 'buzzstore_products_wishlist' )) { ?>
	   					        <li>	   					        	
	   					            <?php buzzstore_products_wishlist(); ?>
	   					        </li>
	   					    <?php } }  
	   					    	if( $account_options == 1 ){ 
	   					      	if (is_user_logged_in()) { 
	   					    ?>
	   					        <li>
	   					        	<span class="icon-user"></span>
	   					        	<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php esc_html_e('My Account','buzzstore'); ?></a>
	   					        </li>
	   					        <li>
	   					        	<span class="icon-logout"></span>
	   					        	<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><?php esc_html_e('Logout','buzzstore'); ?></a>
	   					        </li> 
	   					    <?php } else{ ?>
	   					        <li>
	   					        	<span class="icon-login"></span>
	   					        	<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php esc_html_e('Login','buzzstore'); ?></a>
	   					        </li>
	   					        <li>
	   					        	<span class="icon-user"></span>
	   					        	<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php esc_html_e('Create Your Account','buzzstore'); ?></a>
	   					        </li>
	   					    <?php } } ?>                 
	   					</ul>						
	   				</div><!-- Left section end -->	

	   			</div>
	   		</div><!-- Top Header Section -->
	   	<?php } 
	}
}
add_action( 'buzzstore_header', 'buzzstore_top_header', 15 );


/**
 * Main header area
*/
if ( ! function_exists( 'buzzstore_main_header' ) ) {
	
	function buzzstore_main_header() { ?>
			<div class="buzz-main-header">
				<div class="buzz-container buzz-clearfix">
					<div class="buzz-site-branding">
						<div class="buzz-logowrap buzz-clearfix">

							<div class="buzz-logo">
								<?php the_custom_logo(); ?>
							</div>

							<div class="buzz-logo-title site-branding">					
								<h1 class="buzz-site-title site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php bloginfo( 'name' ); ?>
									</a>
								</h1>
								<?php 
									$description = get_bloginfo( 'description', 'display' );
									if ( $description || is_customize_preview() ) { ?>
										<p class="buzz-site-description site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
								<?php } ?>
							</div>

						</div>
					</div><!-- .site-branding -->

					<?php do_action('buzzstore_search'); ?><!-- search section -->
					
					<?php if ( buzzstore_is_woocommerce_activated() ) { ?>
                        <div class="buzz-cart-main">
							<div class="view-cart">
								<?php buzzstore_cart_link(); ?>
							</div>
							<div class="buzz-viewcartproduct">
								<div class="buzz-block-subtitle"><?php esc_html_e('Recently added item(s)','buzzstore'); ?></div>
								<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
							</div>
                        </div>
					<?php  } ?>

				</div>
			</div><!-- Main header section -->	    
		<?php
	}
}
add_action( 'buzzstore_header', 'buzzstore_main_header', 20 );



if ( ! function_exists( 'buzzstore_header_after' ) ) {
	/**
	 * Header area
	 * @since  1.0.0
	*/
	function buzzstore_header_after() {
		?>
			</header><!-- #masthead -->
		<?php
	}
}
add_action( 'buzzstore_header_after', 'buzzstore_header_after', 25 );