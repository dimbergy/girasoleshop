<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Buzz_Store
 */

get_header(); ?>

<?php do_action( 'buzzstore-breadcrumb-page' ); ?>

<div class="buzz-container buzz-clearfix">
	<div class="buzz-row buzz-clearfix">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : 
					
						while ( have_posts() ) : the_post(); 

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							*/
							get_template_part( 'template-parts/content', 'search' );
						
						endwhile; 
					
							the_posts_pagination( 
			            		array(
								    'prev_text' => esc_html__( 'Prev', 'buzzstore' ),
								    'next_text' => esc_html__( 'Next', 'buzzstore' ),
								)
				            );

					 	else : 
						
						 	get_template_part( 'template-parts/content', 'none' ); 

						endif; 
					?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar('right'); ?>
			
		</div>

	</div>
</div>

<?php get_footer();