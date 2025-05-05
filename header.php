<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package StereoLand_Theme
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
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'stereoland-theme' ); ?></a>
	<!-- .site-header__top -->
	<div class="site-header__top">
		<div class="site-header__top__inner">
			<?php
				$stereoland_theme_description = get_bloginfo( 'description', 'display' );
				if ( $stereoland_theme_description || is_customize_preview() ) : ?>
					<p class="site-header__description"><?php echo $stereoland_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
			<div class="site-header__top__utility">
				<nav id="secondary-navigation" class="site-header__top__navigation">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'top-menu',
								'menu_id'        => 'top-menu',
							)
						);
					?>
				</nav><!-- #secondary-navigation -->
				<?php get_search_form( ); ?>
			</div>
		</div><!-- .site-header__top__inner -->
	</div><!-- .site-header__top -->

	<!-- .site-header -->
	<header id="masthead" class="site-header">
		<div class="site-header__inner">
			<div class="site-header__site-branding">
				<?php
				// the_custom_logo();
				if ( is_front_page()) :
					?>
					<h1 class="site-header__title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php include get_theme_file_path( '/inc/logo-svg.php' ); ?>
						</a>
					</h1>
					<?php
				else :
					?>
					<p class="site-header__title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php include get_theme_file_path( '/inc/logo-svg.php' ); ?>
						</a>
					</p>
					<?php
				endif; ?>

				<ul class="site-header__contact">
					<li class="site-header__contact__item">
						<a href="tel:+19528299700" class="site-header__contact__link">
							<?php echo esc_html('952.829.9700' ); ?>
						</a>
					</li>
					<li class="site-header__contact__item">
						<a href="https://goo.gl/maps/fetc9zDmPzT2" class="site-header__contact__link">
							<?php echo esc_html( 'Bloomington, MN'); ?>
						</a>
					</li>
				</ul>
					
			</div><!-- .site-branding -->

			<nav id="site-header__navigation" class="site-header__navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Open Menu', 'stereoland-theme' ); ?></button>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'walker'         => new Depth_Walker_Nav_Menu(),
							'container_class' => 'main-navigation',
						)
					);

					// Custom Walker Class
					class Depth_Walker_Nav_Menu extends Walker_Nav_Menu {
						// Start Level
						public function start_lvl( &$output, $depth = 0, $args = null ) {
							$indent = str_repeat("\t", $depth);
							$classes = array('menu-item__submenu', 'menu-item__submenu-depth-' . ($depth + 1));
							$class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
							$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
							$output .= "\n$indent<ul$class_names>\n";
						}
					}
				?>
			</nav><!-- #site-navigation -->
			<!-- .site-header__top_navigation utility menu on mobile -->
			<nav id="secondary-navigation--mobile" class="site-header__top_navigation mobile-only">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'top-menu',
							'menu_id'        => 'top-menu',
						)
					);
				?>
			</nav><!-- #secondary-navigation -->
		</div><!-- .site-header__inner -->
	</header><!-- #masthead -->

<!-- .site-main -->
	<section class="site-main__wrapper">
		<div class="site-main__wrapper__inner">
			<main id="primary" class="site-main">
