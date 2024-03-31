<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Require the following PHP functions for the blocks
require_once __DIR__ . '/share/functions-php/index.php';

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function blocks_init() {
	register_block_type( __DIR__ . '/build/socials' );
	register_block_type( __DIR__ . '/build/questions/posts' );
	register_block_type( __DIR__ . '/build/questions/table-of-contents' );
	register_block_type( __DIR__ . '/build/questions/single-question' );
}
add_action( 'init', 'blocks_init' );
