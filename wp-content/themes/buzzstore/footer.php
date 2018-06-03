<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buzz_Store
 */
?>
	<?php

		do_action( 'buzzstore_footer_before');

			/**
			 * @see  buzzstore_footer_widget_area() - 10
			*/
			do_action( 'buzzstore_footer_widget');

	    	/**
	    	 * Button Footer Area
	    	 * Two different filters
	    	   * @see  buzzstore_credit() - 5
	    	*/
	    	do_action( 'buzzstore_button_footer'); 
	    
	    do_action( 'buzzstore_footer_after');
	?>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
