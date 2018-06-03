<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buzz_Store
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="buzz-comments" class="buzz-comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<div class="buzz-comment-content">
		    <div class="buzz-comments-wrapper">
		      <h3><?php esc_html_e( 'Comments','buzzstore' ); ?> </h3>
		      <ul class="buzz-commentlist">
			      <?php
			      	wp_list_comments('type=comment&callback=buzzstore_comment');
			      ?>
			  </ul>
		    </div>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="buzz-comment-nav-above" class="buzz-navigation buzz-comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'buzzstore' ); ?></h2>
			<div class="buzz-nav-links">
				<div class="buzz-nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'buzzstore' ) ); ?></div>
				<div class="buzz-nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'buzzstore' ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>		

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="buzz-comment-nav-below" class="buzz-navigation buzz-comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'buzzstore' ); ?></h2>
			<div class="buzz-nav-links">
				<div class="buzz-nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'buzzstore' ) ); ?></div>
				<div class="buzz-nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'buzzstore' ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="buzz-no-comments"><?php esc_html_e( 'Comments are closed.', 'buzzstore' ); ?></p>
	<?php
	endif;

		$args = array(
				'fields' => apply_filters(        
				'comment_form_default_fields', array(
				'author' =>'<div class="buzz-cmm-box-left"><div class="buzz-control-group"><div class="buzz-controls">'. '<input id="buzz-author" placeholder="'.esc_html__( 'Name *', 'buzzstore' ).'" name="author" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />'.
				'</div></div>',

				'email'  => '<div class="buzz-control-group"><div class="buzz-controls">' . '<input id="buzz-email" placeholder="'.esc_html__( 'Email Address *', 'buzzstore' ).'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" aria-required="true" />'  .
				'</div></div>'
				)
			),

			'comment_field' => '<div class="buzz-cmm-box-right"><div class="buzz-control-group"><div class="buzz-controls">' .
			'<textarea id="comment" name="comment" placeholder="'.esc_html__( 'Comment *', 'buzzstore' ).'" cols="45" rows="8" aria-required="true"></textarea>' .
			'</div></div></div>',
			'comment_notes_after' => '',
			'label_submit' =>esc_html__( 'ADD COMMENT', 'buzzstore' ),
			'comment_notes_before' => '',
		);
		       
		comment_form($args);
	?>

</div><!-- #comments -->
