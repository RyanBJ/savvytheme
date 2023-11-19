<?php
// Error Codes
// Certain HTTP Status Codes will go to a custom page that matches the theme

/**
 * Allow WordPress to search in the errors directory for the 404 template
 */
add_filter("404_template_hierarchy", function ($templates) {
	return array_map( function ( $template_name ) {
		return "errors/$template_name";
	}, $templates );
});

/**
 * Custom Error Pages
 * Return templates based on the status code
 *
 * @return void
 */
function custom_error_pages(): void {
	global $wp_query;

	if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
	{
		set_attributes( $wp_query );
		status_header(403);
		get_template_part('errors/403');
		exit;
	}

	if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
	{
		set_attributes( $wp_query );
		status_header(401);
		get_template_part('errors/401');
		exit;
	}

	if(isset($_REQUEST['status']) && $_REQUEST['status'] == 500)
	{
		set_attributes( $wp_query );
		status_header(500);
		get_template_part('errors/500');
		exit;
	}
}

/**
 * Set the wp_query attributes for each error page
 *
 * @param WP_Query $wp_query
 *
 * @return void
 */
function set_attributes( WP_Query $wp_query ): void {
	$wp_query->is_404      = false;
	$wp_query->is_page     = true;
	$wp_query->is_singular = false;
	$wp_query->is_single   = false;
	$wp_query->is_home     = false;
	$wp_query->is_archive  = false;
	$wp_query->is_category = false;
}

add_action('wp','custom_error_pages');

/**
 * Change the title depending on the status code
 *
 * @param string $title The blog title
 * @param string $sep The separator
 *
 * @return string
 */
function custom_error_title( string $title, string $sep=' — ' ) : string
{
	if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
		$title = "Forbidden " . $sep . get_bloginfo('name');

	if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
		$title = "Unauthorized " . $sep . get_bloginfo('name');

	if(isset($_REQUEST['status']) && $_REQUEST['status'] == 500)
		$title = "Unauthorized " . $sep . get_bloginfo('name');

	return $title;
}
add_filter( 'wp_title', 'custom_error_title', 10, 2);