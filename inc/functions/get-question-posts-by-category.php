<?php

/**
 * Retrieves theory exam question posts based on a specified category ID and generates markup
 * for displaying the post content or summary.
 *
 * @param int $category_id The ID of the category for which to retrieve posts.
 * 
 * @return string Returns a markup string containing the HTML content of posts of a specific
 * category with the post type 'theory-exam-question'. The markup includes either a post summary
 * or post content based on the value of the '_has_post' custom field for each post.
 */
function get_question_posts_by_category_id($category_id)
{
    $args = array(
        'post_type'      => 'theory-exam-question',
        'posts_per_page' => -1,
        'cat'            => $category_id,
    );

    $query = new WP_Query($args);

    if (!$query->have_posts()) return;

    $posts = $query->get_posts();
    usort($posts, 'compare_question_numbers');

    $markup = '';
    foreach ($posts as $post) {
        $id = $post->ID;
        $has_post = get_post_meta($post->ID, '_has_post', true);

        ob_start();
        if ($has_post && $has_post !== 'false') {
            get_template_part('template-parts/questions/post-summary', null, array(
                'id'    => $id,
                'title' => '<h2 class="question__title">' . get_the_title($id) . '</h2>',
            ));
        } else {
            get_template_part('template-parts/questions/post-content', null, array(
                'id'    => $id,
                'title' => '<h2 class="question__title">' . get_the_title($id) . '</h2>',
            ));
        }
        $markup .= ob_get_clean();
    }
    wp_reset_postdata();

    return $markup;
}
