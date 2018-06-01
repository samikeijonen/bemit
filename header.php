<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bemit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="site max-width-2 mx-auto bg-white">
	<header class="site-header">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bemit' ); ?></a>

		<div class="site-header__branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-header__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-header__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$bemit_description = get_bloginfo( 'description', 'display' );
			if ( $bemit_description || is_customize_preview() ) :
				?>
				<p class="site-header__description"><?php echo $bemit_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-header__branding -->

		<nav class="menu menu--primary" aria-label="<?php echo esc_html__( 'Top', 'bemit' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => '',
				'menu_class'     => 'menu__items menu__items--primary',
				'menu_id'        => '',
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			) );
			?>
		</nav><!-- .menu -->
	</header><!-- .site-header -->
