<?php

/**
 * Call to Action Block
 *
 * A call to action block is a formatted group of text paired with a button. The text usually encourages the user to
 * click the button, which in this case, will navigate the user to the specified url.
 *
 * @param $header string Title text at the top of section.
 * @param $lead string Smaller italicised text that leads the body text.
 * @param $body string Large block of small text.
 * @param $button_link string The target location for the button.
 * @param $button_value string Text inside the button.
 * @param $img boolean Is there a Savvy Fox image above the header?
 */
function get_call_to_action(string $header,
        string $lead,
        string $body,
        string $button_link,
        string $button_value,
        bool $img) {
    ?>

    <?php if ($img) : ?>
        <img src="<?php echo get_template_directory_uri().'/assets/img/sgn-cat.png' ?>" alt="savvy gaming cat">
    <?php endif; ?>

    <?php if ($header) echo "<h1 class=\"display-2\">" . $header . "</h1>"; ?>
    <?php if ($lead) echo "<p class=\"lead\"><em>" . $lead . "</em></p>"; ?>
    <?php if ($body) echo "<p>" . $body . "</p>"; ?>

    <?php if ($button_link) : ?>

        <?php if (is_int($button_link)) : ?>
            <a href="<?php echo the_permalink($button_link); ?>" class="btn btn-lg btn-primary"><?php echo $button_value ?></a>
        <?php else : ?>
            <a href="<?php echo $button_link ?>" class="btn btn-lg btn-primary"><?php echo $button_value ?></a>
        <?php endif; ?>

    <?php endif; ?>

    <?php
}

/**
 * The Update Time
 *
 * Get the publish-time or update-time depending on if the post was updated or not
 */
function the_update_time() {
    $u_time = get_the_time('U');
    $u_modified_time = get_the_modified_time('U');
    if ($u_modified_time >= $u_time + 86400) {
        echo "Updated on ";
        the_modified_time('F jS, Y');
        echo " at ";
        the_modified_time();
    } else {
        echo "Published on " . get_the_date() . " at " . get_the_time();
    }
}

/**
 * Log In Redirection
 *
 * The following functions are for redirecting the user to the last visited page after login
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_login_page(): bool
{
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

add_action( 'wp', 'sc_capture_before_login_page_url' );
function sc_capture_before_login_page_url(){
    if( !is_user_logged_in() && !is_login_page()):
        $_SESSION['referer_url'] = wp_get_referer();
    endif;
}

function redirect_to_last_page($redirect_to, $request, $user) {

    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( isset($_SESSION['referer_url']) ):
            $redirect_to  = $_SESSION['referer_url'];
            unset( $_SESSION['referer_url'] );
        endif;

        if (session_status() === PHP_SESSION_NONE) {
            session_write_close();
        }
    }

    return $redirect_to;
}
add_filter('login_redirect', 'redirect_to_last_page', 10, 3);

function login_link( $label ): string {
    return '<a href="' . wp_login_url() . '">' . $label . '</a>';
}

/**
 * Log Out Redirection
 *
 * The following functions are for redirecting the user to the last visited page after logout
 */
function logout_and_stay() {
    if ( isset( $_GET['logout'] ) && $_GET['logout'] == 1 ) {
        if ( is_user_logged_in() ) {
            wp_logout();
            wp_safe_redirect( $_SERVER['REQUEST_URI'] );
            exit;
        }
    }
}
add_action( 'init', 'logout_and_stay' );

function logout_link( $label ): string {
    return '<a href="' . add_query_arg( 'logout', '1' ) . '">' . $label . '</a>';
}