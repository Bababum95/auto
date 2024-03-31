<?php
/**
 * Render the post content.
 *
 * This script renders the content for a single question post within a specified post type.
 * It retrieves the post ID from the provided attributes and generates HTML markup for the
 * post title and navigation links to the previous and next questions within the same post type.
 *
 * @param array $attributes An array of attributes containing the post ID.
 *
 * @return void This function echoes HTML markup for the post content, including the title and navigation links.
 */
$id = $attributes['postId'];

if (!empty($id)) {
    echo '<div ' . get_block_wrapper_attributes() . '>';
    get_template_part(
        'template-parts/questions/post-content',
        null,
        array(
            'id'    => $id,
            'title' => '<h1 class="question__title">' . get_the_title($id) . '</h1>',
        )
    );
    echo get_post_navigation_links($id);
    echo '</div>';
}
?>