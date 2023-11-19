<?php
/**
 * Savvy Theme functions and definitions
 */
if ( ! function_exists( 'savvytheme_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function savvytheme_setup(): void {

        // Allow WordPress to control page titles
        add_theme_support( 'title-tag' );

        // Enable Featured Images
        add_theme_support('post-thumbnails');

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Activate HTML5 Features
        add_theme_support('html5',
            array(
                'comment-list',
                'comment-form',
                'search-form',
                'script',
                'style'
            )
        );

        // Register the menu(s) through WordPress
        register_nav_menus(
            array(
                'primary_menu' => __('Main Menu'),
                'social_menu' => __('Social Icons')
            )
        );
    }
}
add_action( 'after_setup_theme', 'savvytheme_setup' );

/**
 * Custom Navigation Walker template for primary Nav Menu
 */
require get_template_directory() . '/classes/class-savvytheme-primary-walker-nav-menu.php';

/**
 * Custom Navigation Walker template for Social Icon Menu
 */
require get_template_directory() . '/classes/class-savvytheme-social-walker-nav-menu.php';

/**
 * Custom Comment Walker for post comments
 */
require get_template_directory() . '/classes/class-savvytheme-comment-walker.php';

/**
 * Post Selector for Customizer
 */
require get_template_directory() . '/classes/class-savvytheme-dropdown-post-control.php';

/**
 * Theme Customizer Controls
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Navigation Menu Component
 */
require get_template_directory() . '/inc/nav-menu.php';

/**
 * Post Loop Component
 */
require get_template_directory() . '/inc/post-loop.php';

/**
 * Sidebar Component
 */
require get_template_directory() . '/inc/sidebar.php';

/**
 * Comment Section Filters
 */
require get_template_directory() . '/inc/comment-section.php';

/**
 * Modify Core Blocks from Gutenberg Editor
 */
require get_template_directory() . '/inc/core-blocks.php';

/**
 * Theme Content Blocks for Gutenberg Editor
 */
require get_template_directory() . '/inc/content-blocks.php';

/**
 * Custom Error Pages
 */
require get_template_directory() . '/inc/error-codes.php';

/**
 * Helper Functions and Filters
 */
require get_template_directory() . '/inc/helper-functions.php';
