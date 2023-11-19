<?php
// Custom Gutenberg Blocks for SavvyTheme
// Icon List: https://developer.wordpress.org/resource/dashicons/

/**
 * Rating Block
 *
 * A Custom HTML block for adding IGAVEA ratings to a post
 */
add_action('enqueue_block_editor_assets', function () {

	// Enqueue WordPress block editor scripts and dependencies
	wp_enqueue_script('wp-blocks');
	wp_enqueue_script('wp-element');
	wp_enqueue_script('wp-components');

	// Enqueue the Rating Block
	wp_enqueue_script(
		'rating-block',
		get_template_directory_uri() . '/assets/js/content-blocks/rating-block.js',
		array('wp-blocks', 'wp-element', 'wp-editor'),
		true
	);
	wp_enqueue_style(
		'rating-block-style',
		get_template_directory_uri() . '/assets/css/content-blocks/rating-block-editor.css',
	);
});