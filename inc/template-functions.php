<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package StereoLand_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function stereoland_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'stereoland_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function stereoland_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'stereoland_theme_pingback_header' );

/**
 * Register a custom navigation menu.
 */
function stereoland_theme_top_menu() {
	register_nav_menus(
			array(
					'top-menu' => _( 'Top Menu' ),
			)
	);
}
add_action( 'init', 'stereoland_theme_top_menu' );



/**
 * Wrap WP Core Blocks in a custom div.
 */

 function stereoland_theme_wrap_text_block( $block_content, $block ) {
	if ( $block['blockName'] === 'core/paragraph' || $block['blockName'] === 'core/heading' || $block['blockName'] === 'core/list'  || $block['blockName'] === 'core/quote' ) {
		return '<div class="wp-core-block-type">' . $block_content . '</div>';
	}
	return $block_content;
}
add_filter( 'render_block', 'stereoland_theme_wrap_text_block', 10, 2 );

/**
 * Only allow certain blocks in the editor.
 * @param array $allowed_blocks
 * @param WP_Post $post
 * @return array
 */
function stereoland_theme_allowed_post_type_blocks( $allowed_block_types, $editor_context ) {

	if ( isset( $editor_context->post ) && 'post' === $editor_context->post->post_type ) {
		return array(
			'core/paragraph',
			'core/image',
			'core/heading',
			'core/list',
			'core/quote',
			'create-block/cta-block'
		);
	}
	
	if ( isset( $editor_context->post ) && 'page' === $editor_context->post->post_type ) {
		return array(
			'core/paragraph',
	 		'core/image',
			'core/heading',
			'core/list',
			'core/quote',
			'create-block/cta-block'
		);
	}
	
	return $allowed_block_types;
	}
	
	add_filter( 'allowed_block_types_all', 'stereoland_theme_allowed_post_type_blocks', 10, 2 );


	/**
 * Add a button element to menu items with children.
 *
 * @param string $item_output The menu item's starting HTML output.
 * @param WP_Post $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param array $args An array of wp_nav_menu() arguments.
 * @param int $id Current item ID.
 * @return string
 */
function stereoland_theme_add_submenu_button( $item_output, $item, $depth, $args ) {
	if ( is_object( $args ) && isset( $args->menu_id ) && $args->menu_id === 'primary-menu' && $depth === 0 && in_array( 'menu-item-has-children', $item->classes ) ) {
		$buttonContent = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>';
		$button = '<button class="menu-item__submenu-toggle" aria-expanded="false" data-menu-depth="' . $depth . '" aria-label="' . $item->title . ' submenu">' . __($buttonContent, 'stereoland_theme' ) . '</button>';
		$item_output = str_replace( '</a>', '</a>' . $button, $item_output );
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'stereoland_theme_add_submenu_button', 10, 4 );

function stereoland_theme_submenu_class( $classes, $depth ) {
	if ( is_numeric( $depth ) && (int) $depth > 0 ) {
		$classes[] = 'menu-item__submenu';
	}
	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'stereoland_theme_submenu_class', 10, 4 );
