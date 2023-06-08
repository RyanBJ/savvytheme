<?php
/*
Template Name: Search Form
*/
get_header();
?>
<form id="search-form" role="search" action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
    <div id="navbar-search" class="input-group">
        <div><label class="screen-reader-text" for="s"><?php echo __('Search for:') ?></label></div>
        <input type="hidden" value="post" name="post_type" id="post_type">
        <input id="s" class="form-control" name="s" type="search" placeholder="Search"
               aria-label="Search" value="<?php esc_attr(get_search_query()); ?>">
        <button class="btn btn-outline-light" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
