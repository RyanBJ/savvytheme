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
            <?php if (is_author()): ?>

                <?php $author = get_queried_object(); ?>

                <h1 class="display-2 mb-3">
                    <?php
                    $user_id = get_the_author_meta('ID');
                    if (get_option('show_avatars') && get_avatar_data($user_id)['found_avatar']) {
                        echo '<i class="author-avatar">' . get_avatar($user_id, 128) . '</i>';
                    }
                    echo esc_html($author->display_name);
                    ?>
                </h1>
                <p class="lead m"><?php echo esc_html($author->user_description); ?></p>

            <?php elseif (is_category()): ?>

                <h1 class="display-2 mb-3"><?php echo single_cat_title('', false); ?></h1>
                <p class="lead"><?php echo strip_tags(category_description()); ?></p>

            <?php elseif (is_tag()): ?>

                <h1 class="display-2 mb-3"><?php echo single_tag_title('', false); ?></h1>
                <p class="lead"><?php echo strip_tags(tag_description()); ?></p>

            <?php endif; ?>
            <hr>

            <?php get_post_loop(true) ?>

        </div>
    </section>

    <?php get_footer(); ?>

</body>

</html>