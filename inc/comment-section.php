<?php

/**
 * Callback function for the `comment_form_fields` filter hook
 *
 * @param Array $fields Fields.
 * @return Array        Fields modified.
 */
function comment_form_filter(array $fields): array
{
    // Unset fields from displaying by default
    unset($fields['comment']);
    unset($fields['cookies']);
    unset($fields['url']);

    // Restyle fields to match theme
    $fields['author'] = '<input id="author" name="author" type="text" class="form-control form-control-orange" placeholder="Full Name" aria-label=".form-control" required>';
    $fields['email'] = '<input id="email" name="email" type="text" class="form-control form-control-orange" placeholder="Email" aria-label=".form-control" required>';
    $fields['comment'] = '<textarea id="comment" name="comment" class="form-control form-control-orange" placeholder="Comment" required></textarea>';
    $fields['cookies'] = '<div class="form-check"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" class="form-check-input form-check-orange" value="yes">'
        . '<label for="wp-comment-cookies-consent" class="form-check-label">Save my name and email to my browser for the next time I comment here.</label></div>';

    return $fields;
}
add_filter('comment_form_fields', 'comment_form_filter');

/**
 * Callback function for the `comment_form_field_comment` filter hook
 *
 * @param String $field  Field.
 * @return String        Field modified.
 */
function add_form_check_inline_class( String $field ): string {
    if (str_contains($field, 'wp-comment-cookies-consent')) {
        // Wrap the checkbox and label in a div with class 'form-check-inline'
        $field = '<div class="form-check-inline">' . $field . '</div>';
    }
    return $field;
}
add_filter( 'comment_form_field_comment', 'add_form_check_inline_class' );

/**
 * Callback function for the `comment_form_defaults` filter hook
 *
 * @param Array $defaults Defaults.
 * @return Array          Defaults modified.
 */
function modify_comment_form_defaults(array $defaults ): array
{
    // If user is logged in, remove logged_in_as text
    if ( is_user_logged_in() ) {
        $defaults['logged_in_as'] = '';
    }

    // Change comment form fields to match theme
    $defaults['submit_field'] = '<p class="form-submit">%1$s %2$s</p>';
    $defaults['submit_button'] = '<input name="%1$s" type="submit" id="%2$s" class="btn btn-orange" value="%4$s" />';
    $defaults['fields']['cookies'] = '<p class="comment-form-cookies-consent">%s</p>';
    $defaults['hidden_fields']['comment_post_ID'] = '<input id="comment_post_ID" name="comment_post_ID" type="hidden" value="' . get_the_ID() . '" />';
    $defaults['hidden_fields']['comment_parent'] = '<input id="comment_parent" name="comment_parent" type="hidden" value="0" />';
    return $defaults;
}
add_filter( 'comment_form_defaults', 'modify_comment_form_defaults' );