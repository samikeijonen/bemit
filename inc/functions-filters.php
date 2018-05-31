<?php
/**
 * Filter functions.
 *
 * This file holds functions that are used for filtering.
 *
 * @package Bemit
 */

/**
 * Filters the WP nav menu link attributes.
 *
 * @param array    $atts {
 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $title  Title attribute.
 *     @type string $target Target attribute.
 *     @type string $rel    The rel attribute.
 *     @type string $href   The href attribute.
 * }
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return string  $attr
 */
function bemit_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	$theme_location = $args->theme_location ? $args->theme_location : 'default';

	$atts['class'] = 'menu__anchor menu__anchor--' . $theme_location;

	if ( in_array( 'current-menu-item', $item->classes, true ) ) {
		$atts['class'] .= ' is-active';
	}

	if ( in_array( 'button', $item->classes, true ) ) {
		$atts['class'] .= ' menu__anchor--button';
	}

	if ( 0 === $depth ) {
		$atts['class'] .= ' is-top-level';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'bemit_nav_menu_link_attributes', 10, 4 );

/**
 * Filters the HTML attributes applied to a page menu item's anchor element.
 *
 * @param array   $atts {
 *       The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $href The href attribute.
 * }
 * @param WP_Post $page         Page data object.
 * @param int     $depth        Depth of page, used for padding.
 * @param array   $args         An array of arguments.
 * @param int     $current_page ID of the current page.
 */
function bemit_page_menu_link_attributes( $atts, $page, $depth, $args, $current_page ) {
	$atts['class'] = 'menu__anchor menu__anchor--sub-menu';

	if ( $current_page === $page->ID ) {
		$atts['class'] .= ' is-active';
	}

	if ( $args['has_children'] ) {
		$atts['class'] .= ' has-children';
	}

	if ( 0 === $depth ) {
		$atts['class'] .= ' is-top-level';
	}

	return $atts;
}
add_filter( 'page_menu_link_attributes', 'bemit_page_menu_link_attributes', 10, 5 );

/**
 * Filters the CSS classes applied to a menu item's list item element.
 *
 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 * @param int      $depth   Depth of menu item. Used for padding.
 */
function bemit_nav_menu_css_class( $classes, $item, $args, $depth ) {
	$theme_location = $args->theme_location ? $args->theme_location : 'default';

	$_classes = [ 'menu__item' ];

	// Add theme location class.
	$_classes[] = 'menu__item--' . $theme_location;

	if ( 0 === $depth ) {
		$_classes[] = 'is-top-level';
	}

	// Add a class if the menu item has children.
	if ( in_array( 'menu-item-has-children', $classes, true ) ) {
		$_classes[] = 'has-children';
	}

	return $_classes;
}
add_filter( 'nav_menu_css_class', 'bemit_nav_menu_css_class', 10, 4 );

/**
 * Filters the list of CSS classes to include with each page item in the list.
 *
 * @see wp_list_pages()
 *
 * @param string[] $css_class    An array of CSS classes to be applied to each list item.
 * @param WP_Post  $page         Page data object.
 * @param int      $depth        Depth of page, used for padding.
 * @param array    $args         An array of arguments.
 * @param int      $current_page ID of the current page.
 */
function bemit_page_css_class( $css_class, $page, $depth, $args, $current_page ) {
	$css_class['class'] = 'menu__item menu__item--sub-menu';

	if ( in_array( 'page_item_has_children', $css_class, true ) ) {
		$css_class['class'] .= ' has-children';
	}

	if ( in_array( 'current_page_ancestor', $css_class, true ) ) {
		$css_class['class'] .= ' menu__item--ancestor';
	}

	if ( 0 === $depth ) {
		$css_class['class'] .= ' is-top-level';
	}

	return $css_class;
}
add_filter( 'page_css_class', 'bemit_page_css_class', 10, 5 );

/**
 * Adds a custom class to the submenus in nav menus.
 *
 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
 * @param int      $depth   Depth of menu item. Used for padding.
 */
function bemit_nav_menu_submenu_css_class( $classes, $args, $depth ) {
	$classes = [ 'menu__sub-menu' ];

	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'bemit_nav_menu_submenu_css_class', 10, 3 );

/**
 * Remove hentry and add entry at the same time.
 *
 * @param string[] $classes An array of post class names.
 */
function bemit_entry_classes( $classes ) {
	// Remove .hentry class.
	$classes = array_diff( $classes, [ 'hentry' ] );

	// Add .entry class.
	$classes[] = 'entry';

	return $classes;
}
add_filter( 'post_class', 'bemit_entry_classes' );
