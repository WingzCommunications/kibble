<?php

/**
 * Walker for menus with little markup
 *
*/

class kibble_Menu_Walker extends Walker {
    function walk( $elements, $max_depth ) {
        $list = array ();
        foreach ( $elements as $item )
            $list[] = ": <a href='$item->url'>$item->title</a>";
        return join( "\n", $list );
    }
}

/**
 * Walker for pages with little markup
 *
*/
class kibble_Page_Walker extends Walker_page {
    function start_el(&$output, $page, $depth, $args, $current_page) {
            $output .= ': <a href="' . get_page_link($page->ID) . '" title="' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page->post_title, $page->ID ) ) ) . '">' . apply_filters( 'the_title', $page->post_title, $page->ID ) . '</a>';
        }
}

/**
 * Add home and search links to created menu
 *
*/
function kibble_add_home_nav_menu_items($items) {
	$homelink = '<a href="' . home_url( '/' ) . '">' . __('Home') . '</a> ' . "\n";
	$searchlink = ': <a id="search" href="#">' . __('Search') . '</a> ' . "\n";
	$items = $homelink . $searchlink . $items;
	return $items;
}

/**
 * Hooks for adding search and home
 *
*/

add_filter('wp_nav_menu_items', 'kibble_add_home_nav_menu_items' );
add_filter('wp_list_pages', 'kibble_add_home_nav_menu_items');

/**
 * Fallback for list pages
 *
*/
function kibble_custom_page_menu_fallback() {
	wp_list_pages(array('title_li' => '','walker' => new kibble_Page_Walker(),'post_type' => 'page','post_status'  => 'publish'));
}

