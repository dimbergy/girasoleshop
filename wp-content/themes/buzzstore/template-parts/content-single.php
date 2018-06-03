<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buzz_Store
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s" itemtype="http://schema.org/BlogPosting" itemtype="http://schema.org/BlogPosting">						
	<div class="buzz-news-details">
        <?php 
        	if( has_post_thumbnail() ){
        	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'buzzstore-news-details-image', true);
        ?>
            <div class="buzz-image">
            	<img src="<?php echo esc_url( $image[0] ); ?>" alt="" class="img-responsive">
            </div>
        <?php } ?>

        <header class="entry-header">
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        </header><!-- .entry-header -->

        <div class="buzz-metainfo">
        	<ul>
    			<li><i class="fa fa-user"></i> <?php the_author(); ?></li>
    			<li><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></li>
    			<li><i class="fa fa-comment"></i> <?php comments_popup_link( esc_html__( '0 Comment', 'buzzstore' ),  esc_html__( '1 Comment', 'buzzstore' ), esc_html__( '% Comments', 'buzzstore' ), esc_html__( 'Comments are Closed', 'buzzstore' ) ); ?></li>
                <li><i class="fa fa-folder-open"></i> <?php the_category( ', ' ); ?></li>
    		</ul>
        </div>

        <div class="entry-content">
            <?php
    			the_content( sprintf(
    				/* translators: %s: Name of current post. */
    				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'buzzstore' ), array( 'span' => array( 'class' => array() ) ) ),
    				the_title( '<span class="screen-reader-text">"', '"</span>', false )
    			) );

    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buzzstore' ),
    				'after'  => '</div>',
    			) );
    		?>
        </div><!-- .entry-content -->

        <div class="buzz-news-tag">        
            <?php the_tags( '<ul><li><i class="fa fa-tag"></i></li><li>', '</li><li>', '</li></ul>' ); ?>
        </div>
    </div>

</article><!-- #post-## -->