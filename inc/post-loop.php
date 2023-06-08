<?php

/**
 * Log In Redirection
 *
 * The following functions are for redirecting the user to the last visited page after login
 *
 * @param bool $pagination Does the post list require a pagination control
 */
function get_post_loop(bool $pagination = true)
{
    ?>
    <?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php
        $content = get_post_field('post_content', null, 'raw');
        if (!$content) {
            continue;
        }
        $content = apply_filters('the_content', $content);
        $tags = get_the_tags();
        ?>

        <article>
            <div class="row">
                <div class="col-lg-3">
                    <a href="<?php the_permalink(); ?>">

                        <?php if (has_post_thumbnail()) : ?>

                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail'); ?>
                            <div class="article-img" style="background-image: url(<?php echo $image[0]; ?>);"></div>

                        <?php else : ?>

                            <div class="article-img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/no-image.png');"></div>

                        <?php endif; ?>
                    </a>
                </div>
                <div class="col position-relative">

                    <?php if (is_sticky()) : ?>
                        <img class="featured-banner" src="<?php echo get_template_directory_uri() . '/assets/img/featured-banner.png'?>" alt="featured-banner">
                    <?php endif; ?>

                    <a class="link-unstyled p-0" href="<?php the_permalink(); ?>">
                        <h4 class="article-title"><?php the_title(); ?></h4>
                    </a>

                    <p class="article-date text-muted"><?php the_date(); ?>
                        <?php if (has_category()) : ?>
                            <?php echo " -" ?>
                            <?php $categories = get_the_category(); ?>
                            <?php foreach($categories as $category) : ?>
                                <a href="<?php echo get_category_link($category->cat_ID); ?>">
                                    <span class="text-muted"> <u><?php echo $category->cat_name; ?></u></span>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </p>

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

    <hr>
    <?php if ($pagination) get_pagination(); ?>

<?php endif; ?>

    <?php
}

// Disable the "sticky" part of sticky posts so that they do not stay at the top of the post loop
function ignore_sticky_posts_on_home($query) {
    if (is_home() && $query->is_main_query()) {
        $query->set('ignore_sticky_posts', true);
    }
}
add_action('pre_get_posts', 'ignore_sticky_posts_on_home');

/**
 * Get Pagination
 *
 * Generate a pagination control based on the query of posts
 *
 * @param WP_Query|null $wp_query The post query returned by WordPress
 */
function get_pagination(\WP_Query $wp_query = null) {
    if ( null === $wp_query ) {
        global $wp_query;
    }

    $big = 999999999; // need an unlikely integer

    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'type'  => 'array',
            'prev_next'   => true,
            'prev_text'    => '<i class="fas fa-arrow-left"></i> Previous',
            'next_text'    => 'Next <i class="fas fa-arrow-right"></i>',
        )
    );

    if( is_array( $pages ) ) {
        $pagination = '<nav aria-label="Page navigation"><ul class="pagination pagination-lg justify-content-center">';

        foreach ( $pages as $page ) {
            $pagination .= '<li class="page-item' . (str_contains($page, 'current') ? ' active' : '') . '"> '
                . str_replace('page-numbers', 'page-link', $page) . '</li>';
        }

        $pagination .= '</ul></nav>';
        echo $pagination;
    }
}