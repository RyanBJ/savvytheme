<?php
/**
 * Register a Sidebar
 *
 * Register the main sidebar for the theme
 */

add_action('widgets_init', function() {
	register_sidebar(array(
		'name' => __('Sidebar', 'savvytheme'),
		'id' => 'sidebar',
		'description' => __('Widgets in this area will be shown in the sidebar.', 'savvytheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
});