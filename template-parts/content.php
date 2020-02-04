<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package adamant
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
	<?php adamant_post_thumbnail(); ?>
	<div class="entry-heading">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				adamant_posted_on();
				adamant_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
    	<div class="entry-footer">
    		<?php adamant_entry_footer(); ?>
    	</div><!-- .entry-footer -->
	</div>
	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
