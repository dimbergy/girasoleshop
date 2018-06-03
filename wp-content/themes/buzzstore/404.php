<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Buzz_Store
 */

get_header(); ?>

<div class="buzz-container buzz-clearfix">
	<main id="main" class="site-main" role="main">

		<section class="error-404 not-found">
			
			<header class="page-header">
				<h1><?php esc_html_e('404','buzzstore'); ?></h1>
				<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'buzzstore' ); ?></h2>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'buzzstore' ); ?></p>							
			</div><!-- .page-content -->

			<div class="buzz-backhome">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" type="button">
					<span><?php esc_html_e('Back To Home','buzzstore'); ?></span>
				</a>
			</div><!-- .page-content -->

		</section><!-- .error-404 -->

	</main><!-- #main -->
</div>

<?php get_footer();