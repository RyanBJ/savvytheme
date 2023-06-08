<?php
/*
Template Name: Comments Template
*/
if ( post_password_required() ) {
	return;
} ?>

<?php if (have_comments()) : ?>

    <h1 class="display-2">Comments</h1>
    <hr>
    <ol class="list-unstyled comment-list">
        <?php wp_list_comments(array(
            'walker' => new SavvyTheme_Walker_Comment(),
            'short_ping' => true,
            'style' => 'ol'
        )); ?>

        <?php
        if ( comments_open() && 'asc' === strtolower( get_option( 'comment_order', 'asc' ) ) ) {
            comment_form(array('title_reply' => 'Join the discussion!', 'comment_notes_before' => ''));
        }

        if ( !comments_open() ) : ?>
            <p class="lead"><?php _e('Comments are closed.', 'savvytheme'); ?></p>
        <?php endif; ?>
    </ol>

<?php endif; ?>
