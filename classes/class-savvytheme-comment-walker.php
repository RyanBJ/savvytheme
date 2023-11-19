<?php
/**
 * Custom comment walker for this theme
 *
 * @package WordPress
 * @subpackage Savvy_Theme
**/
class SavvyTheme_Walker_Comment extends Walker_Comment
{
    /**
     * Starts the list before the elements are added.
     *
     * @global int $comment_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of the current comment. Default 0.
     * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '<ol class="list-unstyled children">' . "\n";
    }

    /**
     * Outputs a comment.
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment($comment, $depth, $args) {

        // Author Info
        $comment_author = get_comment_author( $comment );

        // Comment Timestamp
        $comment_timestamp = sprintf( __( '%1$s at %2$s', 'savvytheme' ), get_comment_date( '', $comment ), get_comment_time() );

        ?>

        <li>
            <article id="comment-<?php comment_ID(); ?>" class="post-comment">
                <h5 class="comment-title"><?php echo $comment_author; ?>
                    <span class="comment-date text-muted"> - <?php echo $comment_timestamp ?></span>
                </h5>
                <?php
                // Comment Text
                if ( '0' == $comment->comment_approved ) {
                    echo '<p>'
                        . get_comment_text()
                        . '<span class="text-muted"> - '
                        . __( 'Your comment is awaiting moderation.', 'savvytheme' )
                        . '</span></p>';
                } else {
                    comment_text();
                }

                // Reply Link
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => 'comment-body',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                        )
                    )
                );
                if (current_user_can( 'edit_comments' )) {
                    echo '| ';
                    edit_comment_link( __( 'Edit' ), ' <span class="edit-link">', '</span>' );
                }
                ?>

            </article>
        </li>

    <?php
    }
}