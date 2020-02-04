<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package adamant
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

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$adamant_comment_count = get_comments_number();
			if ( '1' === $adamant_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'Komentáře na &ldquo;%1$s&rdquo;', 'adamant' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s komentáře na &ldquo;%2$s&rdquo;', '%1$s komentáře na &ldquo;%2$s&rdquo;', $adamant_comment_count, 'comments title', 'adamant' ) ),
					number_format_i18n( $adamant_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Komentáře jsou uzavřeny.', 'adamant' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

    $comments_args = array(
    'comment_notes_after' => '',
    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
    );
	comment_form( $comments_args );
	?>

</div><!-- #comments -->
