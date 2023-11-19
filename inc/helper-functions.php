<?php

/**
 * HTML Tags
 * These are all the w3 standard HTML elements for comparing string parameters against
 */
$htmlTags = ["a", "abbr", "acronym", "address", "applet", "area", "article", "aside", "audio", "b", "base",
	"basefont", "bdi", "bdo", "bgsound", "big", "blink", "blockquote", "body", "br", "button", "canvas", "caption",
	"center", "cite", "code", "col", "colgroup", "content", "data", "datalist", "dd", "decorator", "del", "details",
	"dfn", "dir", "div", "dl", "dt", "element", "em", "embed", "fieldset", "figcaption", "figure", "font", "footer",
	"form", "frame", "frameset", "h1", "h2", "h3", "h4", "h5", "h6", "head", "header", "hgroup", "hr", "html", "i",
	"iframe", "img", "input", "ins", "isindex", "kbd", "keygen", "label", "legend", "li", "link", "listing", "main",
	"map", "mark", "marquee", "menu", "menuitem", "meta", "meter", "nav", "nobr", "noframes", "noscript", "object",
	"ol", "optgroup", "option", "output", "p", "param", "plaintext", "pre", "progress", "q", "rp", "rt", "ruby", "s",
	"samp", "script", "section", "select", "shadow", "small", "source", "spacer", "span", "strike", "strong", "style",
	"sub", "summary", "sup", "table", "tbody", "td", "template", "textarea", "tfoot", "th", "thead", "time", "title",
	"tr", "track", "tt", "u", "ul", "var", "video", "wbr", "xmp"];

$statusCodes = ["100", "101", "102", "200", "201", "202", "203", "204", "205", "206", "207", "208", "226", "300", "301",
    "301", "302", "303", "304", "305", "306", "307", "308", "400", "401", "402", "403", "404", "405", "406", "407",
    "408", "409", "410", "411", "412", "413", "414", "415", "416", "417", "418", "420", "422", "423", "424", "425",
    "426", "428", "429", "431", "444", "449", "450", "451", "499", "500", "501", "502", "503", "504", "505", "506",
    "507", "508", "509", "510", "511", "598", "599"];

/**
 * Is Status Code
 * Determines if the passed string could be parsed as an HTTP Status Code
 *
 * @param string $code The potential status code
 * @return bool
 */
function is_status_code(string $code): bool {
    global $statusCodes;
    if (in_array($code, $statusCodes)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Is HTML Tag
 * Determines if the passed string could be parsed as an HTML tag
 *
 * @param string $tag The potential tag type
 * @return bool
 */
function is_html_tag(string $tag): bool {
	global $htmlTags;
	if (in_array($tag, $htmlTags)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Call to Action Block
 *
 * A call to action block is a formatted group of text paired with a button. The text usually encourages the user to
 * click the button, which in this case, will navigate the user to the specified url.
 *
 * @param string|null $header string Title text at the top of section. (If number, the block will be formatted for error pages)
 * @param string|null $lead string Smaller italicised text that leads the body text.
 * @param string|null $body string Large block of small text.
 * @param string|null $button_link string The target location for the button.
 * @param string|null $button_value string Text inside the button.
 * @param $img boolean Is there a Savvy Fox image behind the text. (Error pages will always have the helmeted version)
 *
 * @return void
 */
function call_to_action(?string $header,
        ?string $lead,
        ?string $body,
        ?string $button_link,
        ?string $button_value,
        bool $img): void {

    // If call to action is for an error page
    if (is_status_code($header)) {
        echo '<div class="col-lg-4">'
            . '<img src="' . get_template_directory_uri() . '/assets/img/savvy-fox-hardhat.png' . '" alt="Savvy Fox" />'
            . '</div>'
            . '<div class="col-lg-8">'
            . '<h1 class="display-2">' . $header . '</h1>'
            . ($lead ? '<p class="lead"><em>' . $lead . '</em></p>' : '')
            . ($body ? '<p>' . $body . '</p>' : '');

    } else {

		echo ($img ? '<img src="' . get_template_directory_uri() . '/assets/img/savvy-fox.png' . '" alt="Savvy Fox">' : '')
            . ($header ? '<h1 class="display-2">' . $header . '</h1>' : '')
            . ($lead ? '<p class="lead"><em>' . $lead . '</em></p>' : '')
            . ($body ? '<p>' . $body . '</p>' : '');

    }
	if ( ! empty($button_link) && ! empty($button_value)) {
        echo '<a href="' . $button_link . '" class="btn btn-lg btn-orange">' . $button_value . '</a>';
    }
}

/**
 * The Update Time
 *
 * Get the publish-time or update-time depending on if the post was updated or not
 */
function the_update_time(): void {
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
function sc_capture_before_login_page_url(): void {
    if( !is_user_logged_in() && !is_login_page()):
        $_SESSION['referer_url'] = wp_get_referer();
    endif;
}

function redirect_to_last_page($redirect_to, $request, $user) {

    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( isset($_SESSION['referer_url']) ):
            $redirect_to  = $_SESSION['referer_url'];
            unset($_SESSION['referer_url']);
        endif;

        if (session_status() === PHP_SESSION_NONE) {
            session_write_close();
        }
    }

    return $redirect_to;
}
add_filter('login_redirect', 'redirect_to_last_page', 10, 3);

function login_link($label): string {
    return '<a href="' . wp_login_url() . '">' . $label . '</a>';
}

/**
 * Log Out Redirection
 *
 * The following functions are for redirecting the user to the last visited page after logout
 */
function logout_and_stay(): void {
    if (isset($_GET['logout'] ) && $_GET['logout'] == 1) {
        if ( is_user_logged_in()) {
            wp_logout();
            wp_safe_redirect($_SERVER['REQUEST_URI']);
            exit;
        }
    }
}
add_action('init', 'logout_and_stay');

function logout_link($label): string {
    return '<a href="' . add_query_arg('logout', '1') . '">' . $label . '</a>';
}