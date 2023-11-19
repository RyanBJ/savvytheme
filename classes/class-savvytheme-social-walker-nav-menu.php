<?php

class Social_Walker_Nav_Menu extends Walker_Nav_Menu
{
    // Create list items and links for the menu
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 1)
    {
        // List of social icons by name
        $social_icons = array(
	        'discord' => '<i class="fab fa-discord"></i>',
            'email' => '<i class="far fa-envelope"></i>',
	        'etsy' => '<i class="fab fa-etsy"></i>',
	        'facebook' => '<i class="fab fa-facebook-f"></i>',
            'instagram' => '<i class="fab fa-instagram"></i>',
	        'kickstarter' => '<i class="fab fa-kickstarter-k"></i>',
	        'kindle' => '<i class="fab fa-amazon"></i>',
            'patreon' => '<i class="fab fa-patreon"></i>',
	        'playstation' => '<i class="fab fa-playstation"></i>',
	        'reddit' => '<i class="fab fa-reddit"></i>',
	        'slack' => '<i class="fab fa-slack"></i>',
            'soundcloud' => '<i class="fab fa-soundcloud"></i>',
			'spotify' => '<i class="fab fa-spotify"></i>',
	        'steam' => '<i class="fab fa-steam"></i>',
	        'tiktok' => '<i class="fab fa-tiktok"></i>',
			'tumblr' => '<i class="fab fa-tumblr"></i>',
	        'twitch' => '<i class="fab fa-twitch"></i>',
            'twitter' => '<i class="fab fa-twitter"></i>',
            'vimeo' => '<i class="fab fa-vimeo-v"></i>',
	        'xbox' => '<i class="fab fa-xbox"></i>',
            'youtube' => '<i class="fab fa-youtube"></i>'
        );

        // Start the list item tag
        $output .= '<li class="list-inline-item m-0">';

        // Link attributes
        $attributes  = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
        $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';

        // Create anchor tag
        $output .= '<a class="btn"' . $attributes . '">';

        // Switch title for an icon if it matches an icon string
        $item_icon = '';
        foreach($social_icons as $social_name => $social_icon) {
            if (strtolower($item->title) === $social_name) {
                $item_icon = $social_icon;
            }
        }
        if (!empty($item_icon)) {
            $output .= $item_icon;
        } else {
            $output .= $item->title;
        }

        // End the list item
        $output .= '</a>';
    }

    function end_el(&$output, $data_object, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}