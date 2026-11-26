<?php
/**
 * Register ACF blocks from /blocks/*/
function joulestowatts_register_blocks() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return; // ACF PRO not active
	}
	foreach ( glob( get_template_directory() . '/blocks/*/block.json' ) as $block_json ) {
		register_block_type( dirname( $block_json ) );
	}
}
add_action( 'init', 'joulestowatts_register_blocks' );

// Optional: own category in the inserter
function joulestowatts_block_category( $categories ) {
	return array_merge(
		array( array( 'slug' => 'joulestowatts', 'title' => 'Joules to Watts' ) ),
		$categories
	);
}
add_filter( 'block_categories_all', 'joulestowatts_block_category' );