<?php

function get_question_post_url($id) {
    $has_post = get_post_meta($id, '_has_post', true);
    if( $has_post && $has_post !== 'false' ) {
        $link = get_post_meta($id, '_post_link', true);
        return $link;
    } else {
        $categories = get_the_category($id);

        if (empty($categories)) return '';
        $parent_category_id = $categories[0]->term_id;
        $parent_category_link = get_category_link($parent_category_id);
        $question_number = get_post_meta($id, '_question_number', true);
        return $parent_category_link . '#question-' . $question_number;
    }
}