<?php
/*
Template Name: 401 Page
*/
get_header();
?>

	<body class="bg-dark">

<?php get_nav_menu(); ?>

	<div class="container full-height-centered">
        <main id="error-calltoaction" class="row">

            <?php

            call_to_action(
                401,
                'Oops! Looks like you are not invited to the fox hole.',
                'It seems like you are not authorized to view this page. '
                . 'This is happening because you are missing the required credentials to enter. '
                . 'If you believe that you should have access to this page, please contact <a href="mailto:savvygamingnetworking@gmail.com">savvygamingnetworking@gmail.com</a>.',
                get_site_url(),
                'Go back to Homepage',
                true
            );

            ?>

        </main>
	</div>

<?php get_footer(); ?>

	</body><?php
