<!DOCTYPE html>
<html class="bg-dark" lang="en">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <?php

    function enqueue_all_scripts(): void {
        // Bootstrap CSS
        wp_register_style( 'bootstrap', get_template_directory_uri().'/assets/bootstrap/css/bootstrap.min.css', false, null );
        wp_enqueue_style( 'bootstrap' );

        // Fontawesome
        wp_register_style( 'fontawesome', get_template_directory_uri().'/assets/fonts/fontawesome-all.min.css', false, null );
        wp_script_add_data( 'fontawesome', 'crossorigin', 'anonymous');
        wp_enqueue_style( 'fontawesome');

        // Bootstrap JS
        wp_register_script( 'bootstrap', get_template_directory_uri().'/assets/bootstrap/js/bootstrap.min.js', null, null, true );
        wp_enqueue_script( 'bootstrap' );

        // Theme Styles
        wp_enqueue_style( 'theme', get_template_directory_uri(). '/assets/css/theme.css' );

        // Theme Scripts
        wp_register_script( 'mobile-detection', get_template_directory_uri() . '/assets/js/mobile-detection.js', null, null, true );
        wp_register_script( 'scroll-buttons', get_template_directory_uri(). '/assets/js/scroll-buttons.js', array('jquery'), null, true );
        wp_register_script( 'comment-form', get_template_directory_uri(). '/assets/js/comment-form.js', null, null, true );
        if ( is_front_page() ) {
            wp_enqueue_script( 'mobile-detection' );
            wp_enqueue_script( 'scroll-buttons' );
        }
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-form' );
        }

        // Custom Styles
        wp_enqueue_style( 'style', get_stylesheet_uri() );
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_all_scripts' );
    ?>

    <?php wp_head(); ?>
</head>

