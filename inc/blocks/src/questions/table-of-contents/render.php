<?php
/**
 * Display the hierarchy of categories starting from the specified parent ID.
 *
 * @param int $parent_id the ID of the parent category
 */
function display_categories_hierarchy($parent_id = 0, $depth = 1) {
    $categories = get_categories(array(
        'type'         => 'theory-exam-question', 
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => 0,
        'parent'       => $parent_id,
        'exclude'      => 1,
    ));

    if (empty($categories)) {
        $posts = get_posts(array(
            'post_type'      => 'theory-exam-question',
            'category'       => $parent_id,
            'post_status' => 'publish',
            'fields' => 'ids',
            'posts_per_page' => -1,
        ));

        if (!empty($posts)) {
            echo '<ol class="wp-block-auto-table-of-contents__links">';
            foreach ($posts as $post_id) {
                $question_number = get_post_meta($post_id, '_question_number', true);

                printf(
                    '<li
                        class="wp-block-auto-table-of-contents__link"
                        data-question-number="%s"
                    >
                        %s
                    </li>',
                    $question_number,
                    $question_number . '. ' . get_the_title($post_id)
                );
            }
            echo '</ol>';
        }

        return;
    }
    echo '<ol class="wp-block-auto-table-of-contents__categories depth-' . $depth . '">';
    foreach ($categories as $category) {
        echo '<li class="wp-block-auto-table-of-contents__category open">
                <span class="wp-block-auto-table-of-contents__category-name">'
                    . $category->name
                . '</span>';
        echo display_categories_hierarchy($category->term_id, $depth + 1);
        echo '</li>';
    }
    echo '</ol>';
}

echo '<nav ' . get_block_wrapper_attributes() . '>';
display_categories_hierarchy();
echo '</nav>';
