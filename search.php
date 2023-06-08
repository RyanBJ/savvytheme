<?php
/*
Template Name: Search Page
*/
get_header();
?>

<body class="bg-dark">

    <?php get_nav_menu(); ?>

    <section id="search-posts" class="py-5">
        <div class="container">

            <?php if (have_posts()) : ?>

                <h1 class="display-2 mb-3">Search results for "<?php echo get_search_query(); ?>"</h1>
                <hr>
                <?php get_post_loop() ?>

            <?php else : ?>

                <div id="search-calltoaction">
                <?php
                get_call_to_action(
                    "No results for \"" . get_search_query() . "\"",
                    "We couldn't find any posts containing this term. Try searching for something else.",
                    null,
                    get_home_url(),
                    "Go to Homepage",
                    true
                );
                ?>
                </div>

            <?php endif; ?>

        </div>
    </section>

    <?php get_footer(); ?>

</body>

</html>