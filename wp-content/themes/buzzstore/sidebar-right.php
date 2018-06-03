<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buzz_Store
 */

if ( is_active_sidebar( 'buzzsidebarone' ) ) : ?>

	<section id="secondaryright" class="widget-area" role="complementary">

		<?php dynamic_sidebar( 'buzzsidebarone' ); ?>

	</section><!-- #secondary -->
	
<?php endif;
