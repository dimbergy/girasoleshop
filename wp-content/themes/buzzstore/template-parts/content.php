<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buzz_Store
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeInUp'); ?> data-wow-delay="0.3s" itemtype="http://schema.org/BlogPosting" itemtype="http://schema.org/BlogPosting">						
	<div class="buzz-news <?php if( ! has_post_thumbnail() ){ ?>nofeaturesimage<?php } ?>">        
        <?php if( has_post_thumbnail() ){ ?>
	        <div class="buzz-image">
                <a href="<?php the_permalink(); ?>">
    	        	<?php the_post_thumbnail(); ?>
                </a>
	        </div>
        <?php } ?>
        <div class="buzz-content">
        	<a href="<?php the_permalink(); ?>" class="buzz-title">
        		<?php the_title(); ?>
        	</a>

            <div class="buzz-metainfo">
            	<ul>
					<li><i class="fa fa-user"></i> <?php the_author(); ?></li>
					<li><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></li>
					<li><i class="fa fa-comment"></i> <?php comments_popup_link( esc_html__( '0 Comment', 'buzzstore' ),  esc_html__( '1 Comment', 'buzzstore' ), esc_html__( '% Comments', 'buzzstore' ), esc_html__( 'Comments are Closed', 'buzzstore' ) ); ?></li>
				</ul>
            </div>

            <div class="buzz-description">            	
                <?php the_excerpt(); ?>                
            </div>
            
        </div>

    </div>

</article><!-- #post-## -->