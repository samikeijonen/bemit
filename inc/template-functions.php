<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Bemit
 */

/**
 * Sub pages navigation
 *
 * Show hierarchial pages of current page.
 *
 * @author    Aucor
 * @copyright Copyright (c) 2018, Aucor
 * @link      https://github.com/aucor/aucor-starter/blob/master/template-tags/navigation.php
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
function bemit_sub_pages_navigation() {
	global $post;
	global $pretend_id;

	if ( ! empty( $pretend_id ) && is_numeric( $pretend_id ) ) {
		$post = get_post( $pretend_id ); // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		setup_postdata( $post );
	}

	$hierarchy_pos = count( $post->ancestors );

	if ( $hierarchy_pos > 3 ) {
		$great_grand_parent = wp_get_post_parent_id( $post->post_parent );
		$grand_parent       = wp_get_post_parent_id( $great_grand_parent );
		$parent             = wp_get_post_parent_id( $grand_parent );
	} elseif ( 3 === $hierarchy_pos ) {
		$grand_parent = wp_get_post_parent_id( $post->post_parent );
		$parent       = wp_get_post_parent_id( $grand_parent );
	} elseif ( 2 === $hierarchy_pos ) {
		$parent = wp_get_post_parent_id( $post->post_parent );
	} elseif ( 0 === $hierarchy_pos ) {
		$parent = $post->ID;
	} else {
		$parent = $post->post_parent;
	}

	$list = wp_list_pages(
		array(
			'echo'        => 0,
			'child_of'    => $parent,
			'link_after'  => '',
			'title_li'    => '',
			'sort_column' => 'menu_order, post_title',
		)
	);
	if ( ! empty( $list ) ) :
	?>
		<section class="widget widget--sub-pages">
			<nav class="menu menu--sub-pages" aria-label="<?php echo esc_html__( 'Subpages', 'bemit' ); ?>">
				<ul class="menu__items menu__items--sub-pages">
					<?php echo wp_kses_post( $list ); ?>
				</ul>
			</nav>
		</section>
	<?php
	endif;

	if ( ! empty( $pretend_id ) ) {
		wp_reset_postdata();
	}
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bemit_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'bemit_pingback_header' );
