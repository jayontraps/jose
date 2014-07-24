<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package jose
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function jose_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'jose_jetpack_setup' );
