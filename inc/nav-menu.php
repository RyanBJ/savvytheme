<?php

/**
 * Get Nav Menu
 *
 * Generate a navigation menu depending on the nav location
 */
function get_nav_menu()
{
    ?>
    <nav class="navbar navbar-expand-lg" id="site-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo site_url() ?>">
                <img id="navbar-logo" alt="Site Logo" src="<?php echo get_template_directory_uri().'/assets/img/logo.png'; ?>">
            </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
                <span class="visually-hidden">Toggle navigation</span>
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <?php

                // Primary Menu
                if (has_nav_menu('primary_menu')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary_menu',
                            'menu_class' => 'navbar-nav mr-auto',
                            'depth' => 2,
                            'container' => false,
                            'walker' => new Primary_Walker_Nav_Menu()
                        )
                    );
                }

                // Social Menu and Search Bar
                ?>
                <div class="d-flex ms-auto">
                    <?php if (has_nav_menu('social_menu')) :
                        wp_nav_menu(
                            array(
                                'theme_location' => 'social_menu',
                                'menu_class' => 'list-unstyled list-inline m-0',
                                'container_id' => 'navbar-social',
                                'container_class' => 'input-group me-3',
                                'depth' => 1,
                                'walker' => new Social_Walker_Nav_Menu()
                            )
                        );
                    endif; ?>
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </nav>
    <?php
}