<?php get_header(); ?><?php
/*
Template Name: All Posts Page
*/
get_header();
?>
<body class="bg-dark">

    <?php get_nav_menu(); ?>

    <section id="category-posts" class="py-5">
        <div class="container">
            <h1 class="display-2 mb-3">All Posts</h1>
            <hr>

            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    $content = get_post_field('post_content', null, 'raw');
                    if (!$content) {
                        continue;
                    }
                    $content = apply_filters('the_content', $content);
                    $tags = get_the_tags($post->ID);
                    ?>

                    <article>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="<?php the_permalink(); ?>">

                                <?php if (has_post_thumbnail($post->ID)) : ?>

                                    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                                    <div class="article-img" style="background-image: url(<?php echo $image[0]; ?>);"></div>

                                <?php else : ?>

                                    <div class="article-img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/no-image.png');"></div>

                                <?php endif; ?>
                                </a>
                            </div>
                            <div class="col">
                                <a class="link-unstyled p-0" href="<?php the_permalink(); ?>">
                                    <h4 class="article-title"><?php the_title(); ?></h4>
                                </a>
                                <p class="article-date text-muted"><?php the_date(); ?></p>
                                <p class="article-description"><?php echo substr(strip_tags(do_shortcode($content)), 0, 300) . '...'; ?></p>
                                <span class="article-author" href=""><i class="far fa-user-circle"></i> <?php the_author(); ?></span>

                                <?php if (has_tag()) : ?>

                                <span class="article-tags-title text-muted">Tags:</span>
                                <ul class="list-inline d-inline">
                                    
                                    <?php foreach($tags as $tag) : ?>
                                    
                                    <li class="list-inline-item article-tag">
                                        <a href="<?php echo get_tag_link($tag) ?>"><?php echo $tag->name ?></a>
                                    </li>
                                    
                                    <?php endforeach; ?>
                                    
                                </ul>

                                <?php endif; ?>

                            </div>
                        </div>
                    </article>

                <?php endwhile; ?>

            <?php endif; ?>

        </div>
    </section>

    <?php get_footer(); ?>

</body>

</html>