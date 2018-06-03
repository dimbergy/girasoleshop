<?php
/**
 * Template Name: Front Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buzz_Store
 */

get_header(); 

$slider_options = esc_attr( get_theme_mod('buzzstore_slider_section','enable') );

if($slider_options == 'enable'){ ?>
	<section id="main-slider">
		<div id="owl-main-slider" class="enable-owl-carousel owl-main-slider owl-carousel owl-theme" data-navigation="true" data-pagination="false" data-single-item="true" data-auto-play="7000" data-transition-style="fadeUp" data-main-text-animation="true" data-after-init-delay="4000" data-after-move-delay="500" data-stop-on-hover="true">
			<?php
			    $slider_cat_id = intval( get_theme_mod( 'buzzstore_slider_team_id', '0' ));
			    if( !empty( $slider_cat_id ) ) {
			    $slider_args = array(
			        'post_type' => 'post',
			        'tax_query' => array(
			            array(
			                'taxonomy'  => 'category',
			                'field'     => 'id', 
			                'terms'     => $slider_cat_id                                                                 
			            )),
			        'posts_per_page' => 8
			    );

			    $slider_query = new WP_Query( $slider_args );
			    if( $slider_query->have_posts() ) { while( $slider_query->have_posts() ) { $slider_query->the_post();
			    $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'buzzstore-banner-image', true );                           
				$i=0;
			?>
			<div class="item slide<?php echo intval( $i ); ?>">
				<div class="buzz-overlay"></div>
				<img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php the_title(); ?>">
				<div class="main-slider_content">
					<h3 class="main-slider_title main-slider_fadeInLeft animated">
						<?php the_title(); ?>
					</h3>
					<div class="main-slider_row">
						<div class="starSeparator main-slider_zoomIn animated">
							<span aria-hidden="true" class="icon-star"></span>
						</div>
					</div>
					<span class="main-slider_desc main-slider_fadeInRight animated">
						<?php the_content(); ?>
					</span>
				</div>
			</div>
			<?php $i++; } } wp_reset_postdata();  } ?>
		</div>
	</section>
<?php } ?>

<?php
	/**
	 * Main Widget Area
	*/ 
	if( is_active_sidebar('buzzstorehomearea')){ 

		dynamic_sidebar( 'buzzstorehomearea' ); 
		 
	} 

	/**
	 * Services Area
	*/ 
	do_action( 'buzzstore-services-area' ); 

get_footer();