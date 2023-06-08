<?php
/*
Template Name: Post and Page Template
*/
get_header();
?>

<body class="bg-dark">

    <?php get_nav_menu(); ?>

    <section id="single" class="py-5">
        <div class="container">

            <?php while (have_posts()): the_post(); ?>

                <h1 class="display-2 mb-3"><?php the_title(); ?></h1>

                <?php if (is_single()): ?>

                <p class="lead text-muted"><?php the_update_time(); ?> by <?php the_author(); ?></p>

                <?php endif; ?>

                <hr>

                <?php if (has_post_thumbnail()): ?>

                    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                    <div id="post-featured-image" style="background-image:url(<?php echo $image[0]; ?>)"></div>

                <?php endif; ?>

                <main id="post-body">
                    <?php the_content(); ?>

                    <?php if (is_single() && (comments_open() || get_comments_number())) {
                        comments_template();
                    } ?>
                </main>

            <?php endwhile; ?>

        </div>
    </section>

    <?php get_footer(); ?>

</body>

</html>