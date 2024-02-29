<?php
/**
 * Defines a custom category base for the WordPress permalinks.
 */
function custom_category_base() {
    global $wp_rewrite;
    $wp_rewrite->extra_permastructs['category']['struct'] = '%category%';
}

/**
 * Generates a category link based on the given category ID.
 *
 * @param string $catlink The category link to be generated or modified.
 * @param int $category_id The ID of the category.
 * @return string The generated category link.
 */
function wpse7807_category_link( $catlink, $category_id ) {
    global $wp_rewrite;
    $catlink = $wp_rewrite->get_category_permastruct();

    if ( empty( $catlink ) ) {
        $catlink = home_url('?cat=' . $category_id);
    } else {
        $category = &get_category( $category_id );
        $category_nicename = $category->slug;

        $catlink = str_replace( '%category%', $category_nicename, $catlink );
        $catlink = home_url( user_trailingslashit( $catlink, 'category' ) );
    }
    return $catlink;
}

add_action('init', 'custom_category_base');
add_filter( 'category_link', 'wpse7807_category_link', 10, 2 );

