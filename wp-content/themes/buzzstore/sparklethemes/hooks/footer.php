<?php
/**
 * Footer Area Before
*/
if ( ! function_exists( 'buzzstore_footer_before' ) ) {
	function buzzstore_footer_before(){ ?>
		<footer id="footer" class="footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php
	}
}
add_action( 'buzzstore_footer_before', 'buzzstore_footer_before', 5 );

/**
 * Footer Area Goto Top
*/
if ( ! function_exists( 'buzzstore_footer_gototop' ) ) {
	function buzzstore_footer_gototop(){ ?>
		<a class="goToTop" href="#" id="scrollTop">
			<i class="fa fa-angle-up"></i>
			<span><?php esc_html_e('Top','buzzstore'); ?></span>
		</a>
	<?php
	}
}
add_action( 'buzzstore_footer_before', 'buzzstore_footer_gototop', 6 );

/**
 * buzzstore Footer Widget Area
*/
if ( ! function_exists( 'buzzstore_footer_widget_area' ) ) {
	function buzzstore_footer_widget_area(){ 
		$top_footer_options = esc_attr( get_theme_mod( 'buzzstore_footer_area_two_enable_disable_section','enable' ) );
		$top_footer_bg = esc_attr( get_theme_mod( 'buzzstore_footer_area_two_background_color','#222222' ) );
		if(!empty( $top_footer_options ) && $top_footer_options =='enable' ) { ?>
			<div class="buzz-footerwpra" <?php if(!empty( $top_footer_bg )) { ?>style="background-color:<?php echo esc_attr( $top_footer_bg ); ?>;"<?php } ?>>
				<div class="buzz-container">
					<div class="buzz-footerwrap  buzz-clearfix">
						<?php if ( is_active_sidebar( 'buzzstorefooterone' ) ) { ?>
							<div class="footer-widget wow fadeInLeft" data-wow-delay="0.3s">					
								<?php dynamic_sidebar( 'buzzstorefooterone' ); ?>
							</div>
						<?php } ?>
						
						<?php if ( is_active_sidebar( 'buzzstorefootertwo' ) ) { ?>
							<div class="footer-widget wow fadeInUp" data-wow-delay="0.3s">
								<?php dynamic_sidebar( 'buzzstorefootertwo' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'buzzstorefooterthree' ) ) { ?>
							<div class="footer-widget wow fadeInUp" data-wow-delay="0.3s">
								<?php dynamic_sidebar( 'buzzstorefooterthree' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'buzzstorefooterfour' ) ) { ?>
							<div class="footer-widget wow fadeInRight" data-wow-delay="0.3s">
								<?php dynamic_sidebar( 'buzzstorefooterfour' ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
	    <?php 
		}
	}
}
add_action( 'buzzstore_footer_widget', 'buzzstore_footer_widget_area', 10 );

/**
 * Top Footer Area
*/
if ( ! function_exists( 'buzzstore_button_footer_before' ) ) {
	function buzzstore_button_footer_before(){ 
		$footer_button_bg = esc_attr( get_theme_mod( 'buzzstore_footer_buttom_area_background_color','#333333' ) );
		?>
			<div class="footer-bottom" <?php if(!empty( $footer_button_bg )) { ?>style="background-color:<?php echo esc_attr( $footer_button_bg ); ?>;"<?php } ?>>
				<div class="buzz-container">
					<div class="copyright clearfix">
						<?php apply_filters( 'buzzstore_credit', 5 ); ?>
					</div>
					<div class="payment_card clearfix">
						<?php buzzstore_social_links(); ?>
					</div>
				</div>
			</div>
		<?php
	}
}
add_action( 'buzzstore_button_footer', 'buzzstore_button_footer_before', 15 );

/**
 * Footer Area After
*/
if ( ! function_exists( 'buzzstore_footer_after' ) ) {
	function buzzstore_footer_after(){ ?>
		</footer>
	<?php
	}
}
add_action( 'buzzstore_footer_after', 'buzzstore_footer_after', 25 );