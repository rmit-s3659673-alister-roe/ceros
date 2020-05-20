<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Meridia
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

<div id="comments" class="entry-comments mt-30">

	<?php if ( have_comments() ) : ?>
		<div class="heading-lines mb-20">
			<h5 class="widget-title entry-comments__title mb-0">    
				<?php
					comments_number( esc_html__( 'no comments', 'meridia' ),
						esc_html__( '1 Comment', 'meridia' ),
						esc_html__( '% Comments', 'meridia' )
					);
				?>
			</h5>
		</div>

		<?php meridia_comments_pagination(); ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'             => 'ul',
					'short_ping'        => true,
					'avatar_size'       => 60,
					'per_page'          => '',
					'reverse_top_level' => true,
					'walker'            => new Meridia_Walker_Comment()
				) );
			?>
		</ul><!-- .comment-list -->

		<?php meridia_comments_pagination(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments mt-20"><?php esc_html_e( 'Comments are closed.', 'meridia' ); ?></p>
	<?php endif; ?>

	<?php
		$meridia_commenter = wp_get_current_commenter();
		$meridia_consent = empty( $meridia_commenter['comment_author_email'] ) ? '' : ' checked="checked"';

		$meridia_fields = array(
			'author' =>
			'<div class="row mb-10"><div class="col-lg-4"><input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'meridia' ) . '" class="form-control" value="' . esc_attr( $meridia_commenter['comment_author'] ) . '" required="required" /></div>',

			'email' =>
			'<div class="col-lg-4"><input id="email" name="email" class="form-control" type="text" placeholder="' . esc_attr__( 'Email', 'meridia' ) . '" value="' . esc_attr(  $meridia_commenter['comment_author_email'] ) . '" required="required" /></div>',

			'url' =>
			'<div class="col-lg-4"><input id="url" name="url" class="form-control" type="text" placeholder="' . esc_attr__( 'Website', 'meridia' ) . '" value="' . esc_attr( $meridia_commenter['comment_author_url'] ) . '" /></div></div>',

			'cookies' =>
			'<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $meridia_consent . ' />' .
      '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'meridia' ) . '</label></p>'

		);

		$meridia_args = array(
			'class_submit'  => 'btn btn-lg btn-color btn-button',
			'title_reply_before' => '<div class="heading-lines mb-20"><h5 class="widget-title comment-form__title mb-0">',
			'title_reply_after' => '</h5></div>',
			'comment_notes_before' => '',
			'comment_field' => '<textarea id="comment" class="form-control" placeholder="' . _x( 'Comment', 'noun', 'meridia' ) . '" name="comment" rows="6" required="required"></textarea>',
			'fields' => apply_filters( 'meridia_comment_form_default_fields', $meridia_fields ),
			'submit_field' => '<p class="form-submit">%1$s %2$s</p>',
		);

		comment_form( $meridia_args );

	?>
	
</div><!-- .entry-comments -->