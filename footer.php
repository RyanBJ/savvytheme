<?php
/*
Template Name: Footer Template
*/
?>
<footer>
    <div class="container text-center">
        <p>© <?php echo date('Y'); ?> Savvy Gaming. All rights reserved.
            <?php
            if ( ! is_user_logged_in() ) {
                echo login_link('Login');
            } else {
                echo logout_link('Logout');
            }
            ?>
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
