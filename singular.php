<?php
/*
Template Name: Post and Page Template
*/
get_header();
?>

<body class="bg-dark">

    <?php get_nav_menu(); ?>

    <section id="single" class="container py-5">
        <div class="row">

            <?php while (have_posts()): the_post(); ?>

            <header id="post-header" class="col-sm-12">
                <h1 class="display-2 mb-3"><?php the_title(); ?></h1>

                <?php if (is_single()): ?>

                <p class="lead text-muted"><?php the_update_time(); ?> by <?php the_author(); ?></p>

                <?php endif; ?>

                <hr>
            </header>
        </div>
        <div class="row">
            <main id="post-body" class="col-lg-8">

                <?php if (has_post_thumbnail()): ?>

                    <?php
                    $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $image_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
                    ?>
                    <div id="post-featured-image">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_url($image_alt); ?>">
                    </div>

                <?php endif; ?>

                <?php the_content(); ?>

            </main>
            <aside id="post-sidebar" class="col-lg-4">
                <?php
                if (is_active_sidebar('sidebar')) {
                    dynamic_sidebar('sidebar');
                }
                ?>
            </aside>

            <section id="post-comments" class="col-12">

                <?php if (is_single()) comments_template(); ?>

            </section>

            <?php endwhile; ?>

        </div>
    </section>

    <?php get_footer(); ?>

</body>

</html>