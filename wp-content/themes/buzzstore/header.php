<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buzz_Store
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php buzzstore_html_tag_schema(); ?> >
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-scrolling-animations="true">

<div id="page" class="site">

	<?php
		/**
		 * @see  buzzstore_skip_links() - 5
		*/	
		do_action( 'buzzstore_header_before' ); 
	
		/**
		 * @see  buzzstore_top_header() - 15
		 * @see  buzzstore_main_header() - 20
		*/
		do_action( 'buzzstore_header' ); 
	
	 	do_action( 'buzzstore_header_after' ); 
	?>
	
	<nav class="buzz-menulink">
		<div class="buzz-container buzz-clearfix">
			<div class="buzz-toggle">
	            <div class="one"></div>
	            <div class="two"></div>
	            <div class="three"></div>
	        </div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</div>
	</nav>
