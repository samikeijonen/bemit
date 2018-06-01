<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bemit
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry__header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry__title">', '</h1>' );
		else :
			the_title( '<h2 class="entry__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry__meta">
				<?php
				bemit_posted_on();
				bemit_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php bemit_post_thumbnail(); ?>

	<div class="entry__content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bemit' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bemit' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry__content -->

	<footer class="entry__footer">
		<?php bemit_entry_footer(); ?>
	</footer><!-- .entry__footer -->
</article><!-- #post-<?php the_ID(); ?> -->
