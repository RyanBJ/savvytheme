<?php
/*
Template Name: Category and Tag Page
*/
get_header();
?>

<body class="bg-dark">

    <?php get_nav_menu(); ?>

    <section id="category-posts" class="py-5">
        <div class="container">
            <h1 class="display-2 mb-3"><?php echo single_cat_title(); ?></h1>
            <p class="lead"><?php echo strip_tags(category_description()); ?></p>
            <hr>

            <?php get_post_loop(true) ?>

        </div>
    </section>

    <?php get_footer(); ?>

</body>

</html>