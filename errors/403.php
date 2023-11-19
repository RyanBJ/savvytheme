<?php
/*
Template Name: 403 Page
*/
get_header();
?>

<body class="bg-dark">

<?php get_nav_menu(); ?>

<div class="container full-height-centered">
    <main id="error-calltoaction" class="row">

        <?php

        call_to_action(
            403,
            'Oops! Looks like the foxes locked you out.',
            'It seems like you may have rights to view this page, but you are denied access to it. '
            . 'This could be from a ban or from misconfigurations on our end. '
            . 'If you believe that you should have access to this page, please contact <a href="mailto:savvygamingnetwork@gmail.com">savvygamingnetwork@gmail.com</a>.',
            get_site_url(),
            'Go back to Homepage',
            true
        );

        ?>

    </main>
</div>

<?php get_footer(); ?>

</body>