<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bemit
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry__header">
		<?php the_title( '<h1 class="entry__title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php bemit_post_thumbnail(); ?>

	<div class="entry__content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bemit' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry__content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry__footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'bemit' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry__footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
