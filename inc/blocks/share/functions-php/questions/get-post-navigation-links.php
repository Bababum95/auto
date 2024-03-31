<?php
/**
 * Retrieve navigation links for the current question post.
 *
 * This function generates navigation links to the previous and next questions within the same
 * post type ('theory-exam-question') based on the provided question ID.
 *
 * @param int $id The ID of the current question post.
 *
 * @return string HTML markup for the navigation links to the previous and next questions, if available.
 */
function get_post_navigation_links($id) {
    $next = '';
    $prev = '';

    // Retrieve all posts in the specified post type ('theory-exam-question')
    $posts_in_category = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'theory-exam-question',
        'post_status' => 'publish',
        'fields' => 'ids',
    ));

    if (empty($posts_in_category)) return '';

    // Sort the posts by question number
    usort($posts_in_category, 'compare_question_numbers');
    $current_index = array_search($id, $posts_in_category);

    // Get the index of the next and previous posts
    if (isset($posts_in_category[$current_index + 1])) {
        $next = get_question_post_url($posts_in_category[$current_index + 1]);
    }
    if (isset($posts_in_category[$current_index - 1])) {
        $prev = get_question_post_url($posts_in_category[$current_index - 1]);
    }

    if (!empty($next)) {
        $next = sprintf('
            <a class="wp-block-auto-single-question__next" href="%s">
                %s
                <svg width="8" height="12">
                    <use xlink:href="#right-arrow"></use>
                </svg>
            </a>',
            esc_url($next),
            __('Nächste Frage', 'auto')
        );
    }

    if (!empty($prev)) {
        $prev = sprintf('
            <a class="wp-block-auto-single-question__prev" href="%s">
                <svg width="8" height="12" style="transform: rotate(180deg)">
                    <use xlink:href="#right-arrow"></use>
                </svg>
                %s
            </a>',
            esc_url($prev),
            __('Vorige Frage', 'auto')
        );
    }

    return sprintf('
        <nav class="wp-block-auto-single-question__navigations">%s %s</nav>%s',
        $prev,
        $next,
        generate_svg_sprite(['right-arrow'])
    );
}
