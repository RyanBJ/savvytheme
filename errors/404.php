<?php
/*
Template Name: 404 Page
*/
get_header();
?>

<body class="bg-dark">

    <?php get_nav_menu(); ?>

    <div class="container full-height-centered">
        <main id="error-calltoaction" class="row">

            <?php

            call_to_action(
                '404',
                'Oops! Looks like you went down the wrong fox hole.',
                'This page is missing. Try checking the address in the URL to see if it is correct. '
                . 'If you got here from a link, it may be that the page was moved or renamed. '
                . 'Try searching for it using our search engine at the top or click the link below to go back to the homepage.',
                get_site_url(),
                'Go back to Homepage',
                true
            );

            ?>

        </main>
    </div>

    <?php get_footer(); ?>

</body>
