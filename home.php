<?php
/*
Template Name: Home Page
*/
get_header();
?>

<body class="bg-dark">

    <?php get_nav_menu(); ?>

    <section id="featured-posts">
        <div class="row justify-content-center">

            <?php
            // Get the featured article post id
            $featured_post_id = get_theme_mod('setting_st_featured_post');

            /* --------------------
             * If a post was selected in the customizer
             -------------------- */
            if ($featured_post_id != 0) :

                $featured_post = get_post($featured_post_id);
                $featured_post_image = wp_get_attachment_image_src(get_post_thumbnail_id($featured_post_id), 'single-post-thumbnail');
                ?>

                <div class="col-lg-2 position-relative" id="featured-post" style="background: url(<?php echo $featured_post_image[0]; ?>)center / cover no-repeat;">

                    <a class="stretched-link link-unstyled w-100" href="<?php echo the_permalink($featured_post_id); ?>">
                        <div>
                            <p><?php echo $featured_post->post_title ?></p>
                        </div>
                    </a>
                </div>

                <?php
                // If the featured video checkbox is unchecked
                if(get_theme_mod('setting_st_featured_hasvideo') == false) :
                ?>

                    <div class="col-lg-6" id="featured-calltoaction">
                        <?php get_call_to_action(
                                get_theme_mod('setting_st_featured_title', "Title Text"),
                                get_theme_mod('setting_st_featured_lead', "Leading Text"),
                                get_theme_mod('setting_st_featured_body', "Body Text"),
                                get_theme_mod('setting_st_featured_buttonlink', get_home_url()),
                                get_theme_mod('setting_st_featured_buttonvalue', "Click Me"),
                                get_theme_mod('setting_st_featured_hascat', true)
                        ); ?>
                    </div>

                <?php
                // If the featured video checkbox is checked
                else :
                ?>

                <div class="col-lg-6" id="featured-video">

                    <?php if(!empty(get_theme_mod('setting_st_featured_video')))
                        echo get_theme_mod('setting_st_featured_video'); ?>

                </div>

                <?php endif; ?>

            <?php

            /* --------------------
             * If a post was not selected in the customizer
            -------------------- */
            else :
            ?>

                <?php
                // If the featured video checkbox is unchecked
                if(get_theme_mod('setting_st_featured_hasvideo') == false) :
                    ?>

                    <div class="col-lg-8" id="featured-calltoaction">
                        <?php get_call_to_action(
                            get_theme_mod('setting_st_featured_title', "Title Text"),
                            get_theme_mod('setting_st_featured_lead', "Leading Text"),
                            get_theme_mod('setting_st_featured_body', "Body Text"),
                            get_theme_mod('setting_st_featured_buttonlink', get_home_url()),
                            get_theme_mod('setting_st_featured_buttonvalue', "Click Me"),
                            get_theme_mod('setting_st_featured_hascat', true)
                        ); ?>
                    </div>

                <?php
                // If the featured video checkbox is checked
                else :
                    ?>

                    <div class="col-lg-8" id="featured-video">

                        <?php if(!empty(get_theme_mod('setting_st_featured_video')))
                            echo get_theme_mod('setting_st_featured_video'); ?>

                    </div>

                <?php endif; ?>

            <?php endif; ?>

        </div>
    </section>
    <section id="top-picks">
        <h2><?php echo get_theme_mod('setting_st_tpicks_header', 'Top Picks'); ?></h2>
        <div id="top-picks-scrubbar">

            <div id="top-picks-leftscroll" class="top-picks-scrollbutton">
                <a class="link-unstyled" onclick="leftScroll();">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
            <div id="top-picks-rightscroll" class="top-picks-scrollbutton">
                <a class="link-unstyled" onclick="rightScroll();">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>

            <?php
            $sticky = get_option('sticky_posts');
            rsort($sticky);

            $args = array(
                    'post__in' => $sticky
            );

            $sticky_query = new WP_Query($args);

            $number_of_posts = (int)get_theme_mod('setting_st_tpicks_postnumber', 10);
            $post_counter = 0;
            ?>

            <?php while($sticky_query->have_posts() && $post_counter < $number_of_posts): $sticky_query->the_post(); ?>

                <article class="top-pick">
                    <a href="<?php the_permalink(); ?>">

                        <?php if (has_post_thumbnail()) : ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail'); ?>
                        <div class="article-img" style="background-image: url(<?php echo $image[0]; ?>);"></div>

                        <?php else : ?>

                            <div class="article-img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/no-image.png');"></div>

                        <?php endif; ?>
                    </a>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title();?>
                    </a>
                </article>
            <?php $post_counter++; ?>
            <?php endwhile; wp_reset_postdata(); ?>

        </div>
    </section>
    <section id="recent-posts" class="py-5">
        <div class="container">
            <h1 class="mb-3">Latest Articles</h1>

            <?php get_post_loop(false); ?>

        </div>
    </section>

    <?php get_footer(); ?>

</body>

</html>