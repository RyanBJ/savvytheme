<?php

class Primary_Walker_Nav_Menu extends Walker_Nav_Menu
{

    // Check if list item is active
    function is_active_menu_item($item, $dropdown = false)
    {
        if ($dropdown == true) {
            if (array_search('current-menu-item', $item->classes) || array_search('current-page-parent', $item->classes)) {
                return ' active';
            }
        } elseif ($dropdown == false && array_search('current_menu_item', $item->classes)) {
            return ' active';
        } else {
            return '';
        }
    }

    // Container for dropdowns
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= "<div class=\"dropdown-menu\">";
    }

    // Create list items and links for the menu
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        // If the list item is a dropdown
        if (array_search('menu-item-has-children', $item->classes)) {
            $output .= '<li class="nav-item dropdown' . $this->is_active_menu_item($item, true) . '">'
                . '<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="' . $item->url . '">'
                . $item->title . '</a>';
        } // If the list item is a dropdown child
        elseif ($item->menu_item_parent != 0) {
            $output .= '<a class="dropdown-item" href="' . $item->url . '">'
                . $item->title . '</a>';
        } // If the list item is not a dropdown
        else {
            $output .= '<li class="nav-item' . $this->is_active_menu_item($item, false) . '">'
                . '<a class="nav-link" href="' . $item->url . '">'
                . $item->title . '</a>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        if ($item->menu_item_parent == 0) {
            $output .= "</li>";
        }
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= "</div>";
    }
}